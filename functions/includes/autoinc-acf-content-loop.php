<?php

function get_header_content()
{
    $res = '';
    if (have_rows('header_content', 'option')) :
        while (have_rows('header_content', 'option')) : the_row();
            include get_template_directory().'/functions/includes/inc-acf-content-loop.php';
        endwhile;
    endif;
    return $res;
}

function get_page_content_ex()
{
    $res = '';
    if (have_rows('page_content')) :
        while (have_rows('page_content')) : the_row();
            include get_template_directory().'/functions/includes/inc-acf-content-loop.php';
        endwhile;
    endif;
    return $res;
}

function get_footer_content()
{
    $res = '';
    if (have_rows('footer_content', 'option')) :
        while (have_rows('footer_content', 'option')) : the_row();
            include get_template_directory().'/functions/includes/inc-acf-content-loop.php';
        endwhile;
    endif;
    return $res;
}

