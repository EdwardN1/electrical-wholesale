<?php
/**
 * Created by PhpStorm.
 * User: Edward Nickerson
 * Date: 23/07/2019
 * Time: 12:20
 */

function getHeaderSCSS_ex()
{
    $scss = '';
    if (have_rows('header_content', 'option')) {
        $scss = 'header {';
        while (have_rows('header_content', 'option')) : the_row();
            $sectionID = cssName(get_sub_field('id'));
            $sectionSCSS = get_sub_field('cssscss');
            $sectionJS = get_sub_field('jquery');
            if ($sectionSCSS != '') {
                $scss .= '#' . $sectionID . ' {';
                $scss .= $sectionSCSS;
                $scss .= '}';
            }
        endwhile;
        $scss .= '}';
    }
    return $scss;
}

function getFooterSCSS_ex()
{
	$scss = '';
	if (have_rows('footer_content', 'option')) {
		$scss = 'footer {';
		while (have_rows('footer_content', 'option')) : the_row();
			$sectionID = cssName(get_sub_field('id'));
			$sectionSCSS = get_sub_field('cssscss');
			$sectionJS = get_sub_field('jquery');
			if ($sectionSCSS != '') {
				$scss .= '#' . $sectionID . ' {';
				$scss .= $sectionSCSS;
				$scss .= '}';
			}
		endwhile;
		$scss .= '}';
	}
	return $scss;
}

function getHeaderSCSS()
{
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
                    $container_row_name = cssName(get_sub_field('container_row_name'));
                    $headerSCSS .= '.' . $container_row_name . ' {';
                    if (have_rows('container_columns')) :
                        while (have_rows('container_columns')) : the_row();
                            $container_name = cssName(get_sub_field('container_name'));
                            $container_css = get_sub_field('container_css');
                            if ($container_css):
                                $test_container_css = '';
                                $test_container_css .= '.' . $container_name . ' {';
                                $test_container_css .= $container_css;
                                $test_container_css .= '}';
                                $headerSCSS .= $test_container_css;
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
                $headerSCSS .= $row_css;
            endif;
            $headerSCSS .= '}';
        endwhile;
        $headerSCSS .= '}';
    else :
        // no rows found
    endif;

    return $headerSCSS;


}

function getFooterSCSS()
{
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
                    $container_row_name = cssName(get_sub_field('container_row_name'));
                    $footerSCSS .= '.' . $container_row_name . ' {';
                    if (have_rows('container_columns')) :
                        while (have_rows('container_columns')) : the_row();
                            $container_name = cssName(get_sub_field('container_name'));
                            $container_css = get_sub_field('container_css');
                            if ($container_css):
                                $test_container_css = '';
                                $test_container_css .= '.' . $container_name . ' {';
                                $test_container_css .= $container_css;
                                $test_container_css .= '}';
                                $footerSCSS .= $test_container_css;
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
                $footerSCSS .= $row_css;
            endif;
            $footerSCSS .= '}';
        endwhile;
        $footerSCSS .= '}';
    else :
        // no rows found
    endif;

    return $footerSCSS;
}

function getTypographySCSS()
{
    $typographySCSS = '';
    if (have_rows('font_family', 'option')) :
        while (have_rows('font_family', 'option')) : the_row();
            $body = get_sub_field('body');
            $h1 = get_sub_field('h1');
            $h2 = get_sub_field('h2');
            $h3 = get_sub_field('h3');
            $h4 = get_sub_field('h4');
            $h5 = get_sub_field('h5');
            $h6 = get_sub_field('h6');
            $typographySCSS .= '$ts-body-font: ' . $body . ';';
            if ($h1) {
                $typographySCSS .= '$ts-h1-font: ' . $h1 . ';';
            } else {
                $typographySCSS .= '$ts-h1-font: ' . $body . ';';
            }
            if ($h2) {
                $typographySCSS .= '$ts-h2-font: ' . $h2 . ';';
            } else {
                $typographySCSS .= '$ts-h2-font: ' . $body . ';';
            }
            if ($h3) {
                $typographySCSS .= '$ts-h3-font: ' . $h3 . ';';
            } else {
                $typographySCSS .= '$ts-h3-font: ' . $body . ';';
            }
            if ($h4) {
                $typographySCSS .= '$ts-h4-font: ' . $h4 . ';';
            } else {
                $typographySCSS .= '$ts-h4-font: ' . $body . ';';
            }
            if ($h5) {
                $typographySCSS .= '$ts-h5-font: ' . $h5 . ';';
            } else {
                $typographySCSS .= '$ts-h5-font: ' . $body . ';';
            }
            if ($h6) {
                $typographySCSS .= '$ts-h6-font: ' . $h6 . ';';
            } else {
                $typographySCSS .= '$ts-h6-font: ' . $body . ';';
            }
        endwhile;
    endif;
    if (have_rows('font_size', 'option')) :
        while (have_rows('font_size', 'option')) : the_row();
            $body = get_sub_field('body');
            $h1 = get_sub_field('h1');
            $h2 = get_sub_field('h2');
            $h3 = get_sub_field('h3');
            $h4 = get_sub_field('h4');
            $h5 = get_sub_field('h5');
            $h6 = get_sub_field('h6');
            $typographySCSS .= '$ts-body-font-size: ' . $body . ';';
            if ($h1) {
                $typographySCSS .= '$ts-h1-font-size: ' . $h1 . ';';
            } else {
                $typographySCSS .= '$ts-h1-font-size: ' . $body . ';';
            }
            if ($h2) {
                $typographySCSS .= '$ts-h2-font-size: ' . $h2 . ';';
            } else {
                $typographySCSS .= '$ts-h2-font-size: ' . $body . ';';
            }
            if ($h3) {
                $typographySCSS .= '$ts-h3-font-size: ' . $h3 . ';';
            } else {
                $typographySCSS .= '$ts-h3-font-size: ' . $body . ';';
            }
            if ($h4) {
                $typographySCSS .= '$ts-h4-font-size: ' . $h4 . ';';
            } else {
                $typographySCSS .= '$ts-h4-font-size: ' . $body . ';';
            }
            if ($h5) {
                $typographySCSS .= '$ts-h5-font-size: ' . $h5 . ';';
            } else {
                $typographySCSS .= '$ts-h5-font-size: ' . $body . ';';
            }
            if ($h6) {
                $typographySCSS .= '$ts-h6-font-size: ' . $h6 . ';';
            } else {
                $typographySCSS .= '$ts-h6-font-size: ' . $body . ';';
            }
        endwhile;
    endif;
    if (have_rows('font_weight', 'option')) :
        while (have_rows('font_weight', 'option')) : the_row();
            $body = get_sub_field('body');
            $h1 = get_sub_field('h1');
            $h2 = get_sub_field('h2');
            $h3 = get_sub_field('h3');
            $h4 = get_sub_field('h4');
            $h5 = get_sub_field('h5');
            $h6 = get_sub_field('h6');
            $typographySCSS .= '$ts-body-font-weight: ' . $body . ';';
            if ($h1) {
                $typographySCSS .= '$ts-h1-font-weight: ' . $h1 . ';';
            } else {
                $typographySCSS .= '$ts-h1-font-weight: ' . $body . ';';
            }
            if ($h2) {
                $typographySCSS .= '$ts-h2-font-weight: ' . $h2 . ';';
            } else {
                $typographySCSS .= '$ts-h2-font-weight: ' . $body . ';';
            }
            if ($h3) {
                $typographySCSS .= '$ts-h3-font-weight: ' . $h3 . ';';
            } else {
                $typographySCSS .= '$ts-h3-font-weight: ' . $body . ';';
            }
            if ($h4) {
                $typographySCSS .= '$ts-h4-font-weight: ' . $h4 . ';';
            } else {
                $typographySCSS .= '$ts-h4-font-weight: ' . $body . ';';
            }
            if ($h5) {
                $typographySCSS .= '$ts-h5-font-weight: ' . $h5 . ';';
            } else {
                $typographySCSS .= '$ts-h5-font-weight: ' . $body . ';';
            }
            if ($h6) {
                $typographySCSS .= '$ts-h6-font-weight: ' . $h6 . ';';
            } else {
                $typographySCSS .= '$ts-h6-font-weight: ' . $body . ';';
            }
        endwhile;
    endif;
    ob_start();
    ?>
    body {
    font-family: $ts-body-font;
    font-size: $ts-body-font-size;
    font-weight: $ts-body-font-weight;
    }

    h1 {
    font-family: $ts-h1-font;
    font-size: $ts-h1-font-size;
    font-weight: $ts-h1-font-weight;
    }

    h2 {
    font-family: $ts-h2-font;
    font-size: $ts-h2-font-size;
    font-weight: $ts-h2-font-weight;
    }

    h3 {
    font-family: $ts-h3-font;
    font-size: $ts-h3-font-size;
    font-weight: $ts-h3-font-weight;
    }

    h4 {
    font-family: $ts-h4-font;
    font-size: $ts-h4-font-size;
    font-weight: $ts-h4-font-weight;
    }

    h5 {
    font-family: $ts-h5-font;
    font-size: $ts-h5-font-size;
    font-weight: $ts-h5-font-weight;
    }

    h6 {
    font-family: $ts-h6-font;
    font-size: $ts-h6-font-size;
    font-weight: $ts-h6-font-weight;
    }
    <?php
    $typographySCSS .= ob_get_contents();
    ob_end_clean();
    return $typographySCSS;
}

function getDefaultSCSS()
{
    $defaultSCSS = get_field('default_cssscss', 'option');
    return $defaultSCSS;
}

function getWooSCSS()
{
    $WooSCSS = get_field('woocommerce_cssscss', 'option');
    return $WooSCSS;
}

function getDefaultJS()
{
    $defaultJS = get_field('jquery', 'option');
    return $defaultJS;
}