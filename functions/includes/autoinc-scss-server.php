<?php
add_action('wp_ajax_compile_scss', 'compile_scss');

require_once get_template_directory() . '/functions/scssphp/scss.inc.php';
use ScssPhp\ScssPhp\Compiler;

define('SCSSPATH', get_template_directory() . '/assets/styles/server/scss/');

/*function scss( $scss ) {
	$x_scss = new Compiler();
	$x_scss->setFormatter('ScssPhp\ScssPhp\Formatter\Crunched');
	try {
		return $x_scss->compile( $scss );
	} catch ( Exception $e ) {
		error_log( 'Caught Exception: ' . $e->getMessage() );

		return false;
	}
}*/

function compile_scss(){
	$res = 'Compile Error..';
	foreach ( glob( SCSSPATH . '*.scss' ) as $filename ) {
		$baseFile = basename($filename,'.scss');
		if ( substr( $baseFile, 0, 1 ) != '_' ) {
			$includes = file_get_contents( $filename );
			$css     = scss( $includes );
			if ( $css ) {
				$cssFile = fopen($baseFile.'.css','w');
				fwrite($cssFile,$css);
				fclose($cssFile);
				$res = 'Compile success. Output to: '.SCSSPATH.$baseFile.'.css';;
			}
		}
	}
	echo $res;
	exit;
}

