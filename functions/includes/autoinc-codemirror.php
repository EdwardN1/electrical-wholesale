<?php

add_action('admin_enqueue_scripts', 'codemirror_enqueue_scripts');

function codemirror_enqueue_scripts($hook) {
    if(isDeveloper()) {
        $cm_settings_scss['codeEditor'] = wp_enqueue_code_editor(array('type' => 'text/x-scss'));

        wp_localize_script('jquery', 'cm_settings_scss', $cm_settings_scss);

        $theme_path = get_template_directory_uri() . '/assets/styles/monokai.css';

        if (file_exists($theme_path)) {
            wp_enqueue_style('wp-codemirror-theme-css', $theme_path);
        }

        wp_enqueue_script('wp-theme-plugin-editor');
        wp_enqueue_style('wp-codemirror');
    }
}