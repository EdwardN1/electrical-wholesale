<?php
function site_scripts()
{
    global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

    // Adding scripts file in the footer
    wp_enqueue_script('site-js', get_template_directory_uri() . '/assets/scripts/scripts.js', array('jquery'), filemtime(get_template_directory() . '/assets/scripts/js'), true);

    // Register fonts
    wp_enqueue_style('font-css', get_template_directory_uri() . '/assets/styles/scss/fonts/style.css', array(), 1.0, 'all');

    // Register main stylesheet

    wp_enqueue_style('site-css', get_template_directory_uri() . '/assets/styles/server/scss/style.css', 'font-css', filemtime(get_template_directory() . '/assets/styles/server/'), 'all');


    // Register dynamic stylesheet
    wp_enqueue_style('dynamic-css', admin_url('admin-ajax.php') . '?action=dynamic_css', 'site-css', '1.0', 'all');
    //wp_enqueue_style('dynamic-css', get_template_directory_uri().'/assets/styles/dynamic-css.php', 'site-css',  '1.0', 'all');
    // Comment reply script for threaded comments
    if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'site_scripts', 999);