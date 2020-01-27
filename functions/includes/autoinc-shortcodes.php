<?php
add_shortcode('icon', 'Generateicon');
add_shortcode('nav', 'Generatenav');
add_shortcode('searchform', 'Generatesearchform');

function Generatesearchform($params = array()) {
	ob_start();
	include get_template_directory().'/searchform.php';
	$res = '<div class="searchform">'.ob_get_contents().'</div>';
	ob_end_clean();
	return $res;
}

function Generatenav($params = array())
{

    // default parameters
    extract(shortcode_atts(array(
        'name' => '',
        'includelink' => false,
        'includeheading' => false
    ), $params));

    /**
     *
     * Need to tell IDE that these variables do exist
     *
     * @var string $name
     * @var string $align
     * @var string $stretch
     */

    $res = '';

    if($name=='The Main Menu') {
        ob_start();
        joints_top_nav();
        $res = ob_get_contents();
        ob_end_clean();
        return $res;
        error_log('menu - '.$res);
    }

    if($name=='The Secondary Menu') {
        ob_start();
        joints_secondary_nav();
        $res = ob_get_contents();
        ob_end_clean();
    }

    if($name=='The Off-Canvas Menu (Mobile)') {
        ob_start();
        joints_off_canvas_nav();
        $res = ob_get_contents();
        ob_end_clean();
    }

    if($name=='Category Menu') {
        ob_start();
        joints_category_menu();
        $res = ob_get_contents();
        ob_end_clean();
    }

    if($name=='Links Menu') {
        ob_start();
        joints_links_menu();
        $res = ob_get_contents();
        ob_end_clean();
    }

    return $res;
}

function Generateicon($params = array())
{

    // default parameters
    extract(shortcode_atts(array(
        'name' => '',
        'includelink' => false,
        'includeheading' => false
    ), $params));

    /**
     *
     * Need to tell IDE that these variables do exist
     *
     * @var string $includelink
     * @var string $name
     * @var string $includeheading
     */

    $res = '';
    if($name) {
        if (have_rows('icons', 'option')) :
            while (have_rows('icons', 'option')) : the_row();
                $iname = get_sub_field('name');
                $icon = get_sub_field('icon');
                if ($iname == $name) {
                    //error_log('$iname = '.$iname.' | $name = '.$name);
                    if ($icon) {
                        $iconURL = $icon['url'];
                        $iconALT = $icon['alt'];
                        $link = get_sub_field('link');
                        $heading = get_sub_field('heading');
                        $heading_position = get_sub_field('heading_position');
                        $iconSRC = '<img src="'.$iconURL.'" alt="'.$iconALT.'" class="icon-'.$name.'"/>';
                        $iconLink = '<a href="'.$link.'">'.$iconSRC.'</a>';
                        //error_log('$iconSRC = '.$iconSRC);
                       // error_log('$iconLink = '.$iconLink);
                        if($includeheading=='true'){
                            if($heading_position == 'top') {
                                if($includelink=='true') {
                                    $res = '<div class="icon heading-top"><div class="icon-heading">'.$heading.'</div><div>'.$iconLink.'</div></div>';
                                } else {
                                    $res = '<div class="icon heading-top"><div class="icon-heading">'.$heading.'</div><div>'.$iconSRC.'</div></div>';
                                }
                            }
                            if($heading_position == 'Bottom') {
                                if($includelink=='true') {
                                    $res = '<div class="icon heading-bottom"><div>'.$iconLink.'</div><div class="icon-heading">'.$heading.'</div></div>';
                                } else {
                                    $res = '<div class="icon heading-bottom"><div>'.$iconSRC.'</div><div class="icon-heading">'.$heading.'</div></div>';
                                }
                            }
                            if($heading_position == 'Left') {
                                if($includelink=='true') {
                                    $res = '<div class="icon heading-left grid-x"><div class="cell shrink icon-heading">'.$heading.'</div><div class="cell shrink">'.$iconLink.'</div></div>';
                                } else {
                                    $res = '<div class="icon heading-left grid-x"><div class="cell shrink icon-heading">'.$heading.'</div><div class="cell shrink">'.$iconSRC.'</div></div>';
                                }
                            }
                            if($heading_position == 'Right') {
                                if($includelink=='true') {
                                    $res = '<div class="icon heading-right grid-x"><div class="cell shrink">'.$iconLink.'</div><div class="cell shrink icon-heading">'.$heading.'</div></div>';
                                } else {
                                    $res = '<div class="icon heading-right grid-x"><div class="cell shrink">'.$iconSRC.'</div><div class="cell shrink icon-heading">'.$heading.'</div></div>';
                                }
                            }
                        } else {
                            if($includelink=='true') {
                                $res = $iconLink;
                            } else {
                                $res = $iconSRC;
                            }
                            //error_log($res);
                        }
                    } else {
                        $res = $name . ' - Please add an image to this icon to display it.';
                    }
                    break;
                }
            endwhile;
            reset_rows();
        else :
            $res = 'No icons created. Go set some up in Theme Settings';
        endif;
    } else {
        $res = 'No name set - cannot show the icon';
    }

    if($res=='') {
        $res = $name.' - Could not find that name in the icons list. Check the spelling or go setup the icon in Theme Settings.';
    }
    //error_log($res);
    return $res;
}
