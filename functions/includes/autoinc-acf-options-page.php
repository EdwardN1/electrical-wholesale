<?php
// ******************* ACF Options Page ****************** //

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));

    if ($current_user->user_email == 'edward@technicks.com') {
        acf_add_options_page(array(
            'page_title' => 'Master Page Settings',
            'menu_title' => 'Master Page Settings',
            'menu_slug' => 'master-page-settings',
            'capability' => 'edit_posts',
            'redirect' => false
        ));
    }

}

function get_icon($name)
{
    $res = '';
    if (have_rows('icons', 'option')):
        while (have_rows('icons', 'option')): the_row();
            $iname = get_sub_field('name');
            $icon = get_sub_field('icon');
            if ($iname == $name) {
                $res = $icon['url'];
            }
        endwhile;
    endif;

    return $res;
}

function get_secondary_logo($name)
{
    $res = '';
    if (have_rows('secondary_logos', 'option')):
        while (have_rows('secondary_logos', 'option')): the_row();
            $iname = get_sub_field('name');
            $icon = get_sub_field('logo');
            if ($iname == $name) {
                $res = $icon['url'];
            }
        endwhile;
    endif;

    return $res;
}

function get_social_media($name)
{
    $res = array();
    if (have_rows('social_media_sites', 'option')):
        while (have_rows('social_media_sites', 'option')): the_row();
            $iname = get_sub_field('name');
            $icon = get_sub_field('icon');
            $icon_reversed = get_sub_field('icon_reversed');
            $link = get_sub_field('link');
            $sharing_link = get_sub_field('sharing_link');
            $include = get_sub_field('include');
            if (($iname == $name)&&$include) {
                $res['icon'] = $icon['url'];
                $res['icon-reversed'] = $icon_reversed['url'];
                $res['link'] = $link;
                $res['sharing-link'] = $sharing_link;
            }
        endwhile;
    endif;

    return $res;
}

add_action('acf/save_post', 'acf_save_post_processing', 20);

function acf_save_post_processing() {
	$screen = get_current_screen();
	if(strpos($screen->id,'theme-general-settings')==true) {
		$header = getHeaderSCSS();
		$footer = getFooterSCSS();
		$typography = getTypographySCSS();
		$defaultSCSS = getDefaultSCSS();
		file_put_contents(get_template_directory() . '/assets/styles/server/theme-settings/'.'_typography.scss',$typography);
		file_put_contents(get_template_directory() . '/assets/styles/server/theme-settings/'.'_header.scss',$header);
		file_put_contents(get_template_directory() . '/assets/styles/server/theme-settings/'.'_footer.scss',$footer);
		file_put_contents(get_template_directory() . '/assets/styles/server/theme-settings/'.'_default.scss',$defaultSCSS);
		update_css();
	}
}