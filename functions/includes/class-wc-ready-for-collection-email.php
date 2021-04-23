<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 *  Order Ready for Collection Email
 *
 * An email sent to the admin when a new order is received/paid for.
 *
 * @class 		WC_Email_Order_Ready_For_Collection
 * @version		2.0.0
 * @package		WooCommerce/Classes/Emails
 * @author 		WooThemes
 * @extends 	WC_Email
 */
class WC_Email_Order_Ready_For_Collection extends WC_Email {

    /**
     * Constructor
     */
    function __construct() {

        $this->id 				= 'customer_order_ready_for_collection';
        $this->title 			= __( 'Order ready for collection', 'woocommerce' );
        $this->description		= __( 'This is an order notification sent to the customer the order is ready for collection.', 'woocommerce' );

        $this->heading 			= __( 'Your order is ready for collection', 'woocommerce' );
        $this->subject      	= __( 'Your {blogname} order placed on {order_date} is now ready for collection', 'woocommerce' );

        $this->template_html 	= 'emails/customer-order-ready-for-collection.php';
        $this->template_plain 	= 'emails/plain/customer-order-ready-for-collection.php';

        // Triggers for this email
        add_action( 'woocommerce_order_status_processing_to_ready_for_collection_notification', array( $this, 'trigger' ) );
        //add_action( 'woocommerce_order_status_pending_to_on-hold_notification', array( $this, 'trigger' ) );

        // Call parent constructor
        parent::__construct();
    }

    /**
     * trigger function.
     *
     * @access public
     * @return void
     */
    function trigger( $order_id ) {
        global $woocommerce;

        if ( $order_id ) {
            $this->object 		= new WC_Order( $order_id );
            $this->recipient	= $this->object->billing_email;

            $this->find[] = '{order_date}';
            $this->replace[] = date_i18n( woocommerce_date_format(), strtotime( $this->object->order_date ) );

            $this->find[] = '{order_number}';
            $this->replace[] = $this->object->get_order_number();
        }

        if ( ! $this->is_enabled() || ! $this->get_recipient() )
            return;

        $this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
        //twilio_sms_notifications_woocommerce_send_customer_order_notification($order_id);
        //for customers we need to do some logic to make sure the phone number is twilio friendly
        $goodPhoneNumber = twilio_sms_notifications_woocommerce_make_number_sendable($this->object->get_billing_phone(),$order_id);
        twilio_sms_notifications_woocommerce_send_sms($goodPhoneNumber,'Your '.get_bloginfo(). ' order placed on '.date_format($this->object->get_date_created(), 'd/m/Y').' is ready for collection.');
    }

    /**
     * get_content_html function.
     *
     * @access public
     * @return string
     */
    function get_content_html() {
        ob_start();
        woocommerce_get_template( $this->template_html, array(
            'order' 		=> $this->object,
            'email_heading' => $this->get_heading()
        ) );
        return ob_get_clean();
    }

    /**
     * get_content_plain function.
     *
     * @access public
     * @return string
     */
    function get_content_plain() {
        ob_start();
        woocommerce_get_template( $this->template_plain, array(
            'order' 		=> $this->object,
            'email_heading' => $this->get_heading()
        ) );
        return ob_get_clean();
    }
}