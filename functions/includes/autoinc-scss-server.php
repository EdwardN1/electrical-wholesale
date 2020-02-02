<?php
add_action('wp_ajax_compile_scss', 'compile_scss');
//add_action('wp_ajax_nopriv_compile_scss', 'compile_scss');

require_once get_template_directory() . '/functions/scssphp/scss.inc.php';
use ScssPhp\ScssPhp\Compiler;

define('SCSSPATH', get_template_directory() . '/assets/styles/server/scss/');


function compile_scss(){
	$res = 'Compile Error..';
	foreach ( glob( SCSSPATH . '*.scss' ) as $filename ) {
		$baseFile = basename($filename,'.scss');
		if ( substr( $baseFile, 0, 1 ) != '_' ) {
			$includes = file_get_contents( $filename );
			$css     = scss( $includes );
			if ( $css ) {

				$bytes = file_put_contents(SCSSPATH.$baseFile.'.css',$css);
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

function update_css(){
	foreach ( glob( SCSSPATH . '*.scss' ) as $filename ) {
		$baseFile = basename($filename,'.scss');
		if ( substr( $baseFile, 0, 1 ) != '_' ) {
			$includes = file_get_contents( $filename );
			$css     = scss_crunched( $includes );
			if ( $css ) {
				file_put_contents(SCSSPATH.$baseFile.'.css',$css);
			}
		}
	}
}


