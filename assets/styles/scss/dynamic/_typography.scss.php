<?php if ( have_rows( 'font_family', 'option' ) ) : 
	while ( have_rows( 'font_family', 'option' ) ) : the_row(); 
		$body = get_sub_field( 'body' );
		$h1 = get_sub_field( 'h1' );
		$h2 = get_sub_field( 'h2' );
		$h3 = get_sub_field( 'h3' );
		$h4 = get_sub_field( 'h4' );
		$h5 = get_sub_field( 'h5' );
		$h6 = get_sub_field( 'h6' );
		echo '$ts-body-font: '.$body.';';
		if($h1) {
			echo '$ts-h1-font: '.$h1.';';
		} else {
			echo '$ts-h1-font: '.$body.';';
		}
		if($h2) {
			echo '$ts-h2-font: '.$h2.';';
		} else {
			echo '$ts-h2-font: '.$body.';';
		}
		if($h3) {
			echo '$ts-h3-font: '.$h3.';';
		} else {
			echo '$ts-h3-font: '.$body.';';
		}
		if($h4) {
			echo '$ts-h4-font: '.$h4.';';
		} else {
			echo '$ts-h4-font: '.$body.';';
		}
		if($h5) {
			echo '$ts-h5-font: '.$h5.';';
		} else {
			echo '$ts-h5-font: '.$body.';';
		}
		if($h6) {
			echo '$ts-h6-font: '.$h6.';';
		} else {
			echo '$ts-h6-font: '.$body.';';
		}
	endwhile; 
endif; 
if ( have_rows( 'font_size', 'option' ) ) : 
	while ( have_rows( 'font_size', 'option' ) ) : the_row();
		$body = get_sub_field( 'body' );
		$h1 = get_sub_field( 'h1' );
		$h2 = get_sub_field( 'h2' );
		$h3 = get_sub_field( 'h3' );
		$h4 = get_sub_field( 'h4' );
		$h5 = get_sub_field( 'h5' );
		$h6 = get_sub_field( 'h6' );
		echo '$ts-body-font-size: '.$body.';';
		if($h1) {
			echo '$ts-h1-font-size: '.$h1.';';
		} else {
			echo '$ts-h1-font-size: '.$body.';';
		}
		if($h2) {
			echo '$ts-h2-font-size: '.$h2.';';
		} else {
			echo '$ts-h2-font-size: '.$body.';';
		}
		if($h3) {
			echo '$ts-h3-font-size: '.$h3.';';
		} else {
			echo '$ts-h3-font-size: '.$body.';';
		}
		if($h4) {
			echo '$ts-h4-font-size: '.$h4.';';
		} else {
			echo '$ts-h4-font-size: '.$body.';';
		}
		if($h5) {
			echo '$ts-h5-font-size: '.$h5.';';
		} else {
			echo '$ts-h5-font-size: '.$body.';';
		}
		if($h6) {
			echo '$ts-h6-font-size: '.$h6.';';
		} else {
			echo '$ts-h6-font-size: '.$body.';';
		}
	endwhile; 
endif; 
if ( have_rows( 'font_weight', 'option' ) ) : 
	while ( have_rows( 'font_weight', 'option' ) ) : the_row();
		$body = get_sub_field( 'body' );
		$h1 = get_sub_field( 'h1' );
		$h2 = get_sub_field( 'h2' );
		$h3 = get_sub_field( 'h3' );
		$h4 = get_sub_field( 'h4' );
		$h5 = get_sub_field( 'h5' );
		$h6 = get_sub_field( 'h6' );
		echo '$ts-body-font-weight: '.$body.';';
		if($h1) {
			echo '$ts-h1-font-weight: '.$h1.';';
		} else {
			echo '$ts-h1-font-weight: '.$body.';';
		}
		if($h2) {
			echo '$ts-h2-font-weight: '.$h2.';';
		} else {
			echo '$ts-h2-font-weight: '.$body.';';
		}
		if($h3) {
			echo '$ts-h3-font-weight: '.$h3.';';
		} else {
			echo '$ts-h3-font-weight: '.$body.';';
		}
		if($h4) {
			echo '$ts-h4-font-weight: '.$h4.';';
		} else {
			echo '$ts-h4-font-weight: '.$body.';';
		}
		if($h5) {
			echo '$ts-h5-font-weight: '.$h5.';';
		} else {
			echo '$ts-h5-font-weight: '.$body.';';
		}
		if($h6) {
			echo '$ts-h6-font-weight: '.$h6.';';
		} else {
			echo '$ts-h6-font-weight: '.$body.';';
		}
	endwhile; 
endif; 
