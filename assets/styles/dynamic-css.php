<?php
header("Content-type: text/css; charset: UTF-8");

require_once get_template_directory().'/functions/scssphp/scss.inc.php';
use ScssPhp\ScssPhp\Compiler;

function scss($scss) {
	$x_scss = new Compiler();
	try {
		return $x_scss->compile($scss);
	} catch (Exception $e) {
		error_log('Caught Exception: '. $e->getMessage());
		return false;
	}
}

define('INCLUDESSPATH', get_template_directory() . '/assets/styles/scss/includes/');


foreach (glob(INCLUDESSPATH.'_*.scss') as $filename)
{
	$includes = '';
	ob_start();
	include $filename.'.php';
	$includes .= preg_replace('/\s+/S', " ", ob_get_contents());
	ob_end_clean();
	$includes .= file_get_contents ($filename);
	error_log($includes);
}

$default_cssscss = get_field( 'default_cssscss', 'option' );
$scss = scss($default_cssscss);
if($scss) {
	$css .= $scss;
}

echo $css;



