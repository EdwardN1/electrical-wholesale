<?php
// register a custom post status 'ready-for-collection' for Orders
add_action( 'init', 'register_custom_post_status', 20 );
function register_custom_post_status() {
    register_post_status( 'wc-ready-for-collection', array(
        'label'                     => _x( 'Ready For Collection', 'Order status', 'woocommerce' ),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Ready for Collection <span class="count">(%s)</span>', 'Ready for Collection <span class="count">(%s)</span>', 'woocommerce' )
    ) );
}

// Adding custom status 'ready-for-collection' to order edit pages dropdown
add_filter( 'wc_order_statuses', 'custom_wc_order_statuses', 20, 1 );
function custom_wc_order_statuses( $order_statuses ) {
    $order_statuses['wc-ready-for-collection'] = _x( 'Ready for Collection', 'Order status', 'woocommerce' );
    return $order_statuses;
}

// Adding custom status 'ready-for-collection' to admin order list bulk dropdown
add_filter( 'bulk_actions-edit-shop_order', 'custom_dropdown_bulk_actions_shop_order', 20, 1 );
function custom_dropdown_bulk_actions_shop_order( $actions ) {
    $actions['mark_ready-for-collection'] = __( 'Mark Ready for Collection', 'woocommerce' );
    return $actions;
}

// Adding action for 'ready-for-collection'
add_filter( 'woocommerce_email_actions', 'custom_email_actions', 20, 1 );
function custom_email_actions( $action ) {
    $actions[] = 'woocommerce_order_status_wc-ready-for-collection';
    return $actions;
}

//add_action( 'woocommerce_order_status_wc-ready-for-collection', array( WC(), 'send_transactional_email' ), 10, 1 );

// Sending an email notification when order get 'ready-for-collection' status
//add_action('woocommerce_order_status_ready-for-collection', 'backorder_status_custom_notification', 20, 2);
function backorder_status_custom_notification( $order_id, $order ) {
    // HERE below your settings
    $heading   = __('Your order is Ready for Collection','woocommerce');
    $subject   = '[{site_title}] order Ready for Collection ({order_number}) - {order_date}';

    // Getting all WC_emails objects
    $mailer = WC()->mailer()->get_emails();

    // Customizing Heading and subject In the WC_email processing Order object
    $mailer['WC_Ready_For_Collection_Email']->heading = $heading;
    $mailer['WC_Ready_For_Collection_Email']->subject = $subject;

    // Sending the customized email
    $mailer['WC_Ready_For_Collection_Email']->trigger( $order_id );
}

/**
 *  Add a custom email to the list of emails WooCommerce should load
 *
 * @since 0.1
 * @param array $email_classes available email classes
 * @return array filtered available email classes
 */
function add_ready_for_collection_woocommerce_email( $email_classes ) {

    // include our custom email class
    require( 'class-wc-ready-for-collection-email.php' );


    // add the email class to the list of email classes that WooCommerce loads
    $email_classes['WC_Ready_For_Collection_Email'] = new WC_Ready_For_Collection_Email();

    return $email_classes;

}
//add_filter( 'woocommerce_email_classes', 'add_ready_for_collection_woocommerce_email' );

