<?php

function dynamic_css() {
    require(get_template_directory().'/assets/styles/dynamic-css.php');
    exit;
}

//add_action('wp_ajax_dynamic_css', 'dynamic_css');
//add_action('wp_ajax_nopriv_dynamic_css', 'dynamic_css');