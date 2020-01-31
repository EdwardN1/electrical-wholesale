<?php
add_action('wp_ajax_compile_scss', 'compile_scss');
add_action('wp_ajax_nopriv_compile_scss', 'compile_scss');

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
                /*ini_set('display_errors', 'On');
				$cssFile = fopen($baseFile.'.css','w');
				if(false === $cssFile) {
				    $res = 'Unable to open '.$baseFile.'.css for writing';
                } else {
                    $bytes = fwrite($cssFile,$css);
                    fclose($cssFile);
                    $res = '<div>Compile success. Output to: '.SCSSPATH.$baseFile.'.css '.$bytes.' bytes written</div>';;
                    $res .= '<div><pre>'.$css.'</pre></div>';
                }*/
				$bytes = file_put_contents($baseFile.'.css',$css);
				if($bytes) {
					$res = '<div>Compile success. Output to: '.SCSSPATH.$baseFile.'.css '.$bytes.' bytes written</div>';
					$res .= '<div><pre>'.$css.'</pre></div>';
				} else {
					$res = 'Unable to open '.$baseFile.'.css for writing';
				}
			}
		}
	}
	echo $res;
	exit;
}

add_action( 'save_post', 'save_post_and_compile', 10, 3 );

function save_post_and_compile( $post_ID, $post, $update ) {
    error_log('saving post.');
    $scssResult = compile_scss();
    error_log($scssResult);

}

