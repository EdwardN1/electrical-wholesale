<?php
header("Content-type: text/css; charset: UTF-8");



/**
 * Includes - mixins and stuff that must be complied first.
 */

$glob_scss = '';


foreach (glob(INCLUDESSPATH . '_*.scss') as $filename) {
    $includes = '';
    ob_start();
    if(file_exists($filename . '.php')) {
        include $filename . '.php';
        $includes .= preg_replace('/\s+/S', " ", ob_get_contents());
    }
    ob_end_clean();
    //error_log('getting: '.$filename);
    $includes .= file_get_contents($filename);
    $scss = scss($includes);
    if ($scss) {
        $glob_scss .= $includes;
    }
}


/**
 * Custom Site Wide Styles
 */
$default_cssscss = get_field('default_cssscss', 'option');
$scss = scss($glob_scss.$default_cssscss);
if ($scss) {
    $css .= $scss;
}

/**
 * Dynamic stuff
 */
foreach (glob(DYNAMICPATH . '_*.scss') as $filename) {
    $includes = '';
    ob_start();
    include $filename . '.php';
    $includes .= preg_replace('/\s+/S', " ", ob_get_contents());
    ob_end_clean();
    $includes .= file_get_contents($filename);
    $scss = scss($glob_scss.$includes);
    if ($scss) {
        $css .= $scss;
    }
}

/**
 * Header CSS
 */
$headerSCSS = '';
if (have_rows('header_rows', 'option')) :
    $headerSCSS .= 'header {';
    while (have_rows('header_rows', 'option')) : the_row();
        $row_name = cssName(get_sub_field('row_name'));
        $headerSCSS .= '.' . $row_name . ' {';
        $row_type = get_sub_field('row_type');
        $row_height = get_sub_field('row_height');
        $row_max_height = get_sub_field('row_max_height');
        $headerSCSS .= 'height: ' . $row_height . 'px;';
        $headerSCSS .= 'max-height: ' . $row_max_height . 'px;';
        $row_background_type = get_sub_field('row_background_type');
        $row_background_image = get_sub_field('row_background_image');
        if ($row_background_type == 'Image'):
            $row_background_image_URL = '';
            $row_background_image_ALT = '';
            if ($row_background_image) {
                $row_background_image_URL = $row_background_image['url'];
                $row_background_image_ALT = $row_background_image['alt'];
            }
            $headerSCSS .= 'background-image: url("' . $row_background_image_URL . '"");';
            $headerSCSS .= 'background-size: cover;';
            $headerSCSS .= 'background-position: center;';
        endif;
        if ($row_background_type == 'Colour'):
            $row_background_colour = get_sub_field('row_background_colour');
            $headerSCSS .= 'background-color: ' . $row_background_colour . ';';
        endif;
        if (have_rows('container_rows')) :
            while (have_rows('container_rows')) : the_row();
                $container_row_name = get_sub_field('container_row_name');
                $headerSCSS .= '.'.$container_row_name.' {';
                if (have_rows('container_columns')) :
                    while (have_rows('container_columns')) : the_row();
                        $container_name = cssName(get_sub_field('container_name'));
                        $container_css = get_sub_field('container_css');
                        if ($container_css):
                            $test_container_css = '';
                            $test_container_css .= '.' . $container_name . ' {';
                            $test_container_css .= $container_css;
                            $test_container_css .= '}';
                            $scss = scss($glob_scss.$test_container_css);
                            if ($scss):
                                $headerSCSS .= $test_container_css;
                            endif;
                        endif;
                    endwhile;
                else :
                    // no rows found
                endif;
                $headerSCSS .= '}';
            endwhile;
        else :
            // no rows found
        endif;
        $row_css = get_sub_field('row_css');
        if ($row_css):
            $test_row_css = '';
            $test_row_css .= '.' . $row_name . ' {';
            $test_row_css .= $row_css;
            $test_row_css .= '}';
            $scss = scss($glob_scss.$test_row_css);
            if ($scss):
                $headerSCSS .= $row_css;
            endif;
        endif;
        $headerSCSS .= '}';
    endwhile;
    $headerSCSS .= '}';
    $scss = scss($glob_scss.$headerSCSS);
    if ($scss):
        $css .= $scss;
    endif;
else :
    // no rows found
endif;

/**
 * Footer CSS
 */
$footerSCSS = '';
if (have_rows('footer_rows', 'option')) :
    $footerSCSS .= 'footer {';
    while (have_rows('footer_rows', 'option')) : the_row();
        $row_name = cssName(get_sub_field('row_name'));
        $footerSCSS .= '.' . $row_name . ' {';
        $row_type = get_sub_field('row_type');
        $row_height = get_sub_field('row_height');
        $row_max_height = get_sub_field('row_max_height');
        $footerSCSS .= 'height: ' . $row_height . 'px;';
        $footerSCSS .= 'max-height: ' . $row_max_height . 'px;';
        $row_background_type = get_sub_field('row_background_type');
        $row_background_image = get_sub_field('row_background_image');
        if ($row_background_type == 'Image'):
            $row_background_image_URL = '';
            $row_background_image_ALT = '';
            if ($row_background_image) {
                $row_background_image_URL = $row_background_image['url'];
                $row_background_image_ALT = $row_background_image['alt'];
            }
            $footerSCSS .= 'background-image: url("' . $row_background_image_URL . '"");';
            $footerSCSS .= 'background-size: cover;';
            $footerSCSS .= 'background-position: center;';
        endif;
        if ($row_background_type == 'Colour'):
            $row_background_colour = get_sub_field('row_background_colour');
            $footerSCSS .= 'background-color: ' . $row_background_colour . ';';
        endif;
        if (have_rows('container_rows')) :
            while (have_rows('container_rows')) : the_row();
                $container_row_name = get_sub_field('container_row_name');
                $footerSCSS .= '.'.$container_row_name.' {';
                if (have_rows('container_columns')) :
                    while (have_rows('container_columns')) : the_row();
                        $container_name = cssName(get_sub_field('container_name'));
                        $container_css = get_sub_field('container_css');
                        if ($container_css):
                            $test_container_css = '';
                            $test_container_css .= '.' . $container_name . ' {';
                            $test_container_css .= $container_css;
                            $test_container_css .= '}';
                            $scss = scss($glob_scss.$test_container_css);
                            if ($scss):
                                $footerSCSS .= $test_container_css;
                            endif;
                        endif;
                    endwhile;
                else :
                    // no rows found
                endif;
                $footerSCSS .= '}';
            endwhile;
        else :
            // no rows found
        endif;
        $row_css = get_sub_field('row_css');
        if ($row_css):
            $test_row_css = '';
            $test_row_css .= '.' . $row_name . ' {';
            $test_row_css .= $row_css;
            $test_row_css .= '}';
            $scss = scss($glob_scss.$test_row_css);
            if ($scss):
                $footerSCSS .= $row_css;
            endif;
        endif;
        $footerSCSS .= '}';
    endwhile;
    $footerSCSS .= '}';
    $scss = scss($glob_scss.$footerSCSS);
    if ($scss):
        $css .= $scss;
    endif;
else :
    // no rows found
endif;

echo $css;



