<?php
$dataFields = '';
if (have_rows('data')) :
    while (have_rows('data')) : the_row();
        $dataFields .= ' data-' . get_sub_field('name');
        $dataValue = get_sub_field('value');
        if ($dataValue != '') {
            $dataFields .= '="' . $dataValue . '"';
        }
    endwhile;
endif;
$classNames = get_sub_field('classes');
if ($classNames != '') {
    $classNames = ' class="' . $classNames . '"';
}
$html = get_sub_field('html');
$html = do_shortcode(tokens($html));
$res .= '<div id="'.cssName(get_sub_field('id')).'"'.$dataFields.$classNames.'>'.$html.'</div>';
