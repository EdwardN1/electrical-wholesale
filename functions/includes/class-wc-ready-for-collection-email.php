<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * A custom Ready For Collection WooCommerce Email class
 *
 * @since 0.1
 * @extends \WC_Email
 */
class WC_Ready_For_Collection_Email extends WC_Email {

    /**
     * Set email defaults
     *
     * @since 0.1
     */
    public function __construct() {

        error_log('Construction');
        // set ID, this simply needs to be a unique name
        $this->id = 'wc_ready_for_collection';

        // this is the title in WooCommerce Email settings
        $this->title = 'Ready for Collection';

        // this is the description in WooCommerce email settings
        $this->description = 'Ready for Collection Notification emails are sent when an order status is set to Ready for Collection';

        // these are the default heading and subject lines that can be overridden using the settings
        $this->heading = 'Your order is ready for collection';
        $this->subject = 'Your order is ready for collection';

        // these define the locations of the templates that this email should use, we'll just use the new order template since this email is similar
        $this->template_html  = 'emails/customer-processing-order.php';
        $this->template_plain = 'emails/plain/customer-processing-order.php';

        // Trigger on new paid orders
        //add_action( 'woocommerce_order_status_pending_to_processing_notification', array( $this, 'trigger' ) );
        //add_action( 'woocommerce_order_status_failed_to_processing_notification',  array( $this, 'trigger' ) );

        // Call parent constructor to load any other defaults not explicity defined here
        parent::__construct();

        // this sets the recipient to the settings defined below in init_form_fields()
        //$this->recipient = $this->get_option( 'recipient' );
        //$this->recipient = 'Customer';

        // if none was entered, just use the WP admin email as a fallback
        /*if ( ! $this->recipient )
            $this->recipient = get_option( 'admin_email' );*/
    }

    /**
     * Determine if the email should actually be sent and setup email merge variables
     *
     * @since 0.1
     * @param int $order_id
     */
    public function trigger( $order_id ) {

        // bail if no order ID is present
        if ( ! $order_id )
            return;

        // setup order object
        $this->object = new WC_Order( $order_id );

        // bail if shipping method is not expedited
        //if ( ! in_array( $this->object->get_shipping_method(), array( 'Three Day Shipping', 'Next Day Shipping' ) ) )
          //  return;

        // replace variables in the subject/headings
        $this->find[] = '{order_date}';
        $this->replace[] = date_i18n( woocommerce_date_format(), strtotime( $this->object->order_date ) );

        $this->find[] = '{order_number}';
        $this->replace[] = $this->object->get_order_number();

        $this->recipient = $this->object->get_billing_email();

        if ( ! $this->is_enabled() || ! $this->get_recipient() )
            return;

        // woohoo, send the email!
        $this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
    }

} // end \WC_Expedited_Order_Email class