<?php

function bbloomer_add_css_to_emails( $css, $email ) {
    $primary_color = get_field('primary_color','option');;
    $secondary_color = get_field('secondary_color','option');;
    $css .= '
      h2 { color: '.$secondary_color.'; }
      h3 { color: '.$secondary_color.'; }
      #template_header {background-color:'.$primary_color.' 1important;}
   ';
    return $css;
}
add_filter( 'woocommerce_email_styles', 'bbloomer_add_css_to_emails', 9999, 2 );