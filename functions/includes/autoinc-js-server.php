<?php

require_once get_template_directory() . '/functions/JShrink/src/JShrink/Minifier.php';

define('JSSERVERPATH', get_template_directory() . '/assets/scripts/server/');

function compileJS() {
    $postfiles = glob(JSSERVERPATH . '/posts/*.js');
    $themefiles = glob(JSSERVERPATH . '/theme/*.js');
    $js = '';

	foreach($themefiles as $themefile) {
		$js .= file_get_contents($themefile);
	}

    foreach($postfiles as $postfile) {
        $js .= file_get_contents($postfile);
    }

    $js = \JShrink\Minifier::minify('jQuery(document).ready(function ($) {'.$js.'});');

    file_put_contents(JSSERVERPATH.'combined.js', $js);
}
