<?php

require_once get_template_directory() . '/functions/scssphp/scss.inc.php';

use ScssPhp\ScssPhp\Compiler;

define('INCLUDESSPATH', get_template_directory() . '/assets/styles/scss/includes/');
define('DYNAMICPATH', get_template_directory() . '/assets/styles/scss/dynamic/');
//define('SCSSPATH', get_template_directory() . '/assets/styles/server/scss/');

function cssName($string)
{
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}

function scss($scss)
{
	$x_scss = new Compiler();
    $x_scss->setImportPaths(get_template_directory() . '/assets/styles/server/scss/');
	//$x_scss->setFormatter('ScssPhp\ScssPhp\Formatter\Crunched');
	try {
		return $x_scss->compile($scss);
	} catch (Exception $e) {
		error_log('Caught Exception: ' . $e->getMessage());
		return false;
	}
}

function scss_crunched($scss)
{
	$x_scss = new Compiler();
	$x_scss->setImportPaths(get_template_directory() . '/assets/styles/server/scss/');
	$x_scss->setFormatter('ScssPhp\ScssPhp\Formatter\Crunched');
	try {
		return $x_scss->compile($scss);
	} catch (Exception $e) {
		error_log('Caught Exception: ' . $e->getMessage());
		return false;
	}
}
