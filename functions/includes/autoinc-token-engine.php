<?php
function tokens($text) {
    $html = $text;
    $tokens = array();
    preg_match_all('/<token\s*([^>]*)\s*\/?>/', $html, $tokens, PREG_SET_ORDER);
    foreach ($tokens as $customTag) {
        $originalTag = $customTag[0];
        $rawAttributes = $customTag[1];

        preg_match_all('/([^=\s]+)="([^"]+)"/', $rawAttributes, $attributes, PREG_SET_ORDER);

        $formatedAttributes = array();

        foreach ($attributes as $attribute) {
            $name = $attribute[1];
            $value = $attribute[2];

            $formatedAttributes[$name] = $value;
        }

        $replaceWith = '';

        $class = '';
        if ($formatedAttributes['class']) {
            $class = ' class="' . $formatedAttributes['class'] . '"';
        }

        if ($formatedAttributes['type'] == 'link') {
            $tokenName = $formatedAttributes['name'];

            if (have_rows('link_tokens')) :
                while (have_rows('link_tokens')) : the_row();
                    if (get_sub_field('name') == $tokenName) {
                        if ($replaceWith == '') {
                            $replaceWith = '<a href="';

                            if (get_sub_field('link_type') == 'Internal Page') {
                                $replaceWith .= get_sub_field('page') . '"' . $class . '>' . get_sub_field('link_description') . '</a>';
                            }
                            if (get_sub_field('link_type') == 'External Page') {
                                $replaceWith .= get_sub_field('url') . '" target="_blank"' . $class . '>' . get_sub_field('link_description') . '</a>';
                            }
                            if (get_sub_field('link_type') == 'Text') {
                                $replaceWith .= get_sub_field('text') . '"' . $class . '>' . get_sub_field('link_description') . '</a>';
                            }
                            if (get_sub_field('link_type') == 'File') {
                                $replaceWith .= get_sub_field('file') . '" target="_blank"' . $class . '>' . get_sub_field('link_description') . '</a>';
                            }
                        }
                        //break;
                    }
                endwhile;
            endif;
        }

        if ($formatedAttributes['type'] == 'image') {
            $tokenName = $formatedAttributes['name'];
            if (have_rows('image_tokens')) :
                while (have_rows('image_tokens')) : the_row();
                    if (get_sub_field('name') == $tokenName) {
                        if ($replaceWith == '') {
                            $image = get_sub_field('content');
                            $replaceWith = $image['url'];
                        }
                    }
                endwhile;
            endif;
        }

        if ($formatedAttributes['type'] == 'image-alt') {
            $tokenName = $formatedAttributes['name'];
            if (have_rows('image_tokens')) :
                while (have_rows('image_tokens')) : the_row();
                    if (get_sub_field('name') == $tokenName) {
                        if ($replaceWith == '') {
                            $image = get_sub_field('content');
                            $replaceWith = $image['alt'];
                        }
                    }
                endwhile;
            endif;
        }

        if ($formatedAttributes['type'] == 'text') {
            $tokenName = $formatedAttributes['name'];
            if (have_rows('text_tokens')) :
                while (have_rows('text_tokens')) : the_row();
                    if (get_sub_field('name') == $tokenName) {
                        if ($replaceWith == '') {
                            $content = get_sub_field('content');
                            $replaceWith = $content;
                        }
                    }
                endwhile;
            endif;
        }

        if ($formatedAttributes['type'] == 'richtext') {
            $tokenName = $formatedAttributes['name'];
            if (have_rows('wysiwyg_tokens')) :
                while (have_rows('wysiwyg_tokens')) : the_row();
                    if (get_sub_field('name') == $tokenName) {
                        if ($replaceWith == '') {
                            $content = get_sub_field('content');
                            $replaceWith = $content;
                        }
                    }
                endwhile;
            endif;
        }

        if ($formatedAttributes['type'] == 'option') {
            $tokenName = $formatedAttributes['name'];
            $replaceWith = get_field($tokenName,'option');
        }


        $html =  str_replace($originalTag, $replaceWith, $html);
    }

    return $html;
}
