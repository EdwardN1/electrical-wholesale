<?php
// register a custom post status 'r-f-c' for Orders
add_action('init', 'rfc_register_custom_post_status', 20);
function rfc_register_custom_post_status()
{
    register_post_status('wc-r-f-c', array(
        'label' => _x('Ready for collection', 'Order status', 'woocommerce'),
        'public' => true,
        'exclude_from_search' => false,
        'show_in_admin_all_list' => true,
        'show_in_admin_status_list' => true,
        'label_count' => _n_noop('Ready for collection <span class="count">(%s)</span>', 'Ready for collection <span class="count">(%s)</span>', 'woocommerce')
    ));
}

// Adding custom status 'r-f-c' to order edit pages dropdown
add_filter('wc_order_statuses', 'rfc_custom_wc_order_statuses', 20, 1);
function rfc_custom_wc_order_statuses($order_statuses)
{
    $new_order_statuses = array();
    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;

        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-r-f-c'] = _x('Ready for collection', 'Order status', 'woocommerce');
        }
    }

    return $new_order_statuses;
}

// Adding custom status 'r-f-c' to admin order list bulk dropdown
add_filter('bulk_actions-edit-shop_order', 'rfc_custom_dropdown_bulk_actions_shop_order', 20, 1);
function rfc_custom_dropdown_bulk_actions_shop_order($actions)
{
    $actions['mark_r-f-c'] = __('Mark Ready for collection', 'woocommerce');
    return $actions;
}

// Adding action for 'r-f-c'
add_filter('woocommerce_email_actions', 'rfc_custom_email_actions', 20, 1);
function rfc_custom_email_actions($action)
{
    $action[] = 'woocommerce_order_status_wc-r-f-c';
    return $action;
}

add_action('woocommerce_order_status_wc-r-f-c', array(WC(), 'send_transactional_email'), 10, 1);

// Sending an email notification when order get 'r-f-c' status
add_action('woocommerce_order_status_r-f-c', 'rfc_backorder_status_custom_notification', 20, 2);
function rfc_backorder_status_custom_notification($order_id, $order)
{
    // HERE below your settings
    //error_log('rfc_backorder_status_custom_notification');
    $heading = __('Your order is ready for collection ', 'woocommerce');
    $subject = '[{site_title}] order ({order_number}) - {order_date} is ready for collection';

    // Getting all WC_emails objects
    $mailer = WC()->mailer()->get_emails();

    // Customizing Heading and subject In the WC_email processing Order object
    $mailer['WC_Email_Order_Ready_For_Collection']->heading = $heading;
    $mailer['WC_Email_Order_Ready_For_Collection']->subject = $subject;

    // Sending the customized email
    $mailer['WC_Email_Order_Ready_For_Collection']->trigger($order_id);
}

/**
 *  Add a custom email to the list of emails WooCommerce should load
 *
 * @since 0.1
 * @param array $email_classes available email classes
 * @return array filtered available email classes
 */
function add_order_ready_for_collection_woocommerce_email( $email_classes ) {

    // include our custom email class
    require( 'class-wc-ready-for-collection-email.php' );

    // add the email class to the list of email classes that WooCommerce loads
    $email_classes['WC_Email_Order_Ready_For_Collection'] = new WC_Email_Order_Ready_For_Collection();

    return $email_classes;

}
add_filter( 'woocommerce_email_classes', 'add_order_ready_for_collection_woocommerce_email' );