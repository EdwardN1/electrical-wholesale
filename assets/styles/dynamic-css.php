<?php
header("Content-type: text/css; charset: UTF-8");

require_once get_template_directory().'/functions/scssphp/scss.inc.php';
use ScssPhp\ScssPhp\Compiler;

function scss($scss) {
	$x_scss = new Compiler();
	$x_scss->setFormatter('ScssPhp\ScssPhp\Formatter\Crunched');
	try {
		return $x_scss->compile($scss);
	} catch (Exception $e) {
		error_log('Caught Exception: '. $e->getMessage());
		return false;
	}
}

define('INCLUDESSPATH', get_template_directory() . '/assets/styles/scss/includes/');
define('DYNAMICPATH', get_template_directory() . '/assets/styles/scss/dynamic/');

/**
 * Includes - mixins and stuff that must be complied first.
 */
foreach (glob(INCLUDESSPATH.'_*.scss') as $filename)
{
	$includes = '';
	ob_start();
	include $filename.'.php';
	$includes .= preg_replace('/\s+/S', " ", ob_get_contents());
	ob_end_clean();
	$includes .= file_get_contents ($filename);
	$scss = scss($includes);
	if($scss) {
		$css .= $scss;
	}
}


/**
 * Custom Site Wide Styles
 */
$default_cssscss = get_field( 'default_cssscss', 'option' );
$scss = scss($default_cssscss);
if($scss) {
	$css .= $scss;
}

/**
 * Dynamic stuff
 */
foreach (glob(DYNAMICPATH.'_*.scss') as $filename)
{
	$includes = '';
	ob_start();
	include $filename.'.php';
	$includes .= preg_replace('/\s+/S', " ", ob_get_contents());
	ob_end_clean();
	$includes .= file_get_contents ($filename);
	$scss = scss($includes);
	if($scss) {
		$css .= $scss;
	}
}


echo $css;



