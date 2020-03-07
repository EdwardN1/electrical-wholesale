<?php
add_action('admin_enqueue_scripts', 'codemirror_enqueue_scripts');

function codemirror_enqueue_scripts($hook) {
	$cm_settings['codeEditor'] = wp_enqueue_code_editor(array('type' => 'text/x-scss'));
	wp_localize_script('jquery', 'cm_settings', $cm_settings);

	wp_enqueue_script('wp-theme-plugin-editor');
	wp_enqueue_style('wp-codemirror');
}