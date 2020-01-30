<?php

$thisDIR     = __DIR__;
$scssInclude = str_Replace( 'assets/styles/server/scss', '', $thisDIR );

require_once $scssInclude . '/functions/scssphp/scss.inc.php';

use ScssPhp\ScssPhp\Compiler;

/*$scss = new Compiler();
$scss->setFormatter( 'ScssPhp\ScssPhp\Formatter\Compressed' );*/

function scss( $scss ) {
	$x_scss = new Compiler();
	$x_scss->setFormatter('ScssPhp\ScssPhp\Formatter\Crunched');
	try {
		return $x_scss->compile( $scss );
	} catch ( Exception $e ) {
		error_log( 'Caught Exception: ' . $e->getMessage() );

		return false;
	}
}

foreach ( glob( '*.scss' ) as $filename ) {
	if ( substr( $filename, 0, 1 ) != '_' ) {
		$includes = file_get_contents( $filename );
		$css     = scss( $includes );
		if ( $scss ) {
			$cssFile = fopen($filename.'.css','w');
			fwrite($cssFile,$css);
			fclose($cssFile);
		}
	}
}

error_log( 'Served' );