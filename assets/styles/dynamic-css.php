<?php
header("Content-type: text/css; charset: UTF-8");

require_once get_template_directory().'/functions/scssphp/scss.inc.php';
use ScssPhp\ScssPhp\Compiler;
$scss = new Compiler();
$includes = '';
define('INCLUDESSPATH', get_template_directory() . '/assets/scss/dynamic/');
foreach (glob(INCLUDESSPATH.'_*.scss') as $filename)
{
	$includes .= file_get_contents ($filename);
}
echo $scss->compile($includes);


