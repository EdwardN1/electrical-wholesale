<?php
// register a custom post status 'awaiting-delivery' for Orders
add_action('init', 'register_custom_post_status', 20);
function register_custom_post_status()
{
    register_post_status('wc-awaiting-delivery', array(
        'label' => _x('Awaiting delivery', 'Order status', 'woocommerce'),
        'public' => true,
        'exclude_from_search' => false,
        'show_in_admin_all_list' => true,
        'show_in_admin_status_list' => true,
        'label_count' => _n_noop('Awaiting delivery <span class="count">(%s)</span>', 'Awaiting delivery <span class="count">(%s)</span>', 'woocommerce')
    ));
}

// Adding custom status 'awaiting-delivery' to order edit pages dropdown
add_filter('wc_order_statuses', 'custom_wc_order_statuses', 20, 1);
function custom_wc_order_statuses($order_statuses)
{
    $order_statuses['wc-awaiting-delivery'] = _x('Awaiting delivery', 'Order status', 'woocommerce');
    return $order_statuses;
}

// Adding custom status 'awaiting-delivery' to admin order list bulk dropdown
add_filter('bulk_actions-edit-shop_order', 'custom_dropdown_bulk_actions_shop_order', 20, 1);
function custom_dropdown_bulk_actions_shop_order($actions)
{
    $actions['mark_awaiting-delivery'] = __('Mark Awaiting delivery', 'woocommerce');
    return $actions;
}

// Adding action for 'awaiting-delivery'
add_filter('woocommerce_email_actions', 'custom_email_actions', 20, 1);
function custom_email_actions($action)
{
    $actions[] = 'woocommerce_order_status_wc-awaiting-delivery';
    return $actions;
}

add_action('woocommerce_order_status_wc-awaiting-delivery', array(WC(), 'send_transactional_email'), 10, 1);

// Sending an email notification when order get 'awaiting-delivery' status
add_action('woocommerce_order_status_awaiting-delivery', 'backorder_status_custom_notification', 20, 2);
function backorder_status_custom_notification($order_id, $order)
{
    // HERE below your settings
    $heading = __('Your Awaiting delivery order', 'woocommerce');
    $subject = '[{site_title}] Awaiting delivery order ({order_number}) - {order_date}';

    // Getting all WC_emails objects
    $mailer = WC()->mailer()->get_emails();

    // Customizing Heading and subject In the WC_email processing Order object
    $mailer['WC_Email_Customer_Processing_Order']->heading = $heading;
    $mailer['WC_Email_Customer_Processing_Order']->subject = $subject;

    // Sending the customized email
    $mailer['WC_Email_Customer_Processing_Order']->trigger($order_id);
}