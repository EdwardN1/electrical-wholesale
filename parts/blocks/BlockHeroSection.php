<?php $id = cssName(get_field('id')); ?>
<div id="<?php echo $id; ?>" class="hero-section">
    <?php $section_type = get_field('section_type'); ?>
    <?php if ($section_type == 'Image'): ?>
        <?php $image = get_field('image'); ?>
        <?php if ($image) { ?>
            <div class="hero-image" style="background-image: url(<?php echo $image['url']; ?>)">
        <?php } else { ?>
            <div class="hero-image no-image">
        <?php } ?>
        <?php $image_link_title = get_field('image_link_title'); ?>
        <?php $image_link_type = get_field('image_link_type'); ?>
        <?php $image_external_url = get_field('image_external_url'); ?>
        <?php $image_text_link = get_field('image_text_link'); ?>
        <?php $image_internal_page = get_field('image_internal_page'); ?>
        <?php $href = ''; ?>
        <?php $blank = ''; ?>
        <?php
        if ($image_link_type == 'External URL') {
            $blank = ' target="_blank"';
            $href = $image_external_url;
        }
        if ($image_link_type == 'Text') {
            $href = $image_text_link;
        }
        if ($image_link_type == 'Internal Page') {
            $href = $image_internal_page;
        }
        ?>
        <?php
        if (($image_link_title == '') && ($href != '')) {
            echo('<a href="' . $href . '"' . $blank . '>');
        }
        ?>
        <?php if (get_field('image_title') != ''): ?>
            <?php if (get_field('title_type') == 'H1 Heading'):; ?>
                <h1 class="title-text"><?php the_field('image_title'); ?></h1>
            <?php endif; ?>
            <?php if (get_field('title_type') == 'H2 Heading'):; ?>
                <h2 class="title-text"><?php the_field('image_title'); ?></h2>
            <?php endif; ?>
            <?php if (get_field('title_type') == 'Text'):; ?>
                <div class="title-text"><?php the_field('image_title'); ?></div>
            <?php endif; ?>
        <?php endif; ?>
        <?php if (get_field('sub_title') != ''): ?>
            <?php if (get_field('sub_title_type') == 'H1 Heading'):; ?>
                <h1 class="sub-title-text"><?php the_field('sub_title'); ?></h1>
            <?php endif; ?>
            <?php if (get_field('sub_title_type') == 'H2 Heading'):; ?>
                <h2 class="sub-title-text"><?php the_field('sub_title'); ?></h2>
            <?php endif; ?>
            <?php if (get_field('sub_title_type') == 'Text'):; ?>
                <div class="sub-title-text"><?php the_field('sub_title'); ?></div>
            <?php endif; ?>
        <?php endif; ?>
        <?php
        if (($image_link_title == '') && ($href != '')) {
            echo('<a href="' . $href . '" class="link-title-text"' . $blank . '>');
            echo($image_link_title);
            echo('</a>');
        }
        ?>
        <?php
        if (($image_link_title == '') && ($href != '')) {
            echo('</a>');
        }
        ?>

        </div>
    <?php else: ?>
        <?php if (have_rows('slides')) : ?>
            <?php $mobile_break_point = get_field('mobile_break_point'); ?>
            <?php if ($mobile_break_point > 0): ?>
                <style>
                    .hero-slides {
                        display: none;
                    }

                    .hero-slides.mobile {
                        display: block;
                    }

                    @media screen and (min-width: <?php echo $mobile_break_point;?>px) {
                        .hero-slides {
                            display: block;
                        }

                        .hero-slides.mobile {
                            display: none;
                        }
                    }
                </style>
                <div data-slick-slider class="hero-slides mobile">
                <?php $slideCounter = 0; ?>
                <?php while (have_rows('slides')) : the_row(); ?>
                    <?php $slide_image = get_sub_field('slide_mobile_image'); ?>
                    <?php $slide_imageURL = $slide_image['url']; ?>
                    <?php $slide_imageALT = $slide_image['alt']; ?>
                    <?php
                    $slide_imageWIDTH = $slide_image['width'];
                    $slide_imageHEIGHT = $slide_image['height'];
                    $slide_imageVW = $slide_imageHEIGHT / ($slide_imageWIDTH / 100);
                    $slide_imageMAXWIDTH = 1410;
                    $slide_imageMAXHEIGHT = $slide_imageHEIGHT / ($slide_imageWIDTH / $slide_imageMAXWIDTH);
                    ?>
                    <?php if ($slide_image) { ?>
                        <div class="hero-slide slide-<?php echo $slideCounter; ?>"
                             style="background-image: url(<?php echo $slide_imageURL; ?>);">
                            <div class="hero-slide-description"
                                 style="height: <?php echo $slide_imageVW; ?>vw;  max-height: <?php echo $slide_imageMAXHEIGHT; ?>; width: 100%; max-width: <?php echo $slide_imageMAXWIDTH; ?>;"
                            ">

                            <?php if (have_rows('slide_content_rows')) : ?>
                                <?php while (have_rows('slide_content_rows')) : the_row(); ?>
                                    <?php $row_type = get_sub_field('row_type'); ?>
                                    <?php $row_content = get_sub_field('row_content'); ?>
                                    <?php $row_paragraph = get_sub_field('row_paragraph'); ?>
                                    <?php $row_rich_text = get_sub_field('row_rich_text'); ?>
                                    <?php $row_spacer = get_sub_field('row_spacer'); ?>
                                    <?php $row_image = get_sub_field('row_image'); ?>
                                    <?php if ($row_image) : ?>
                                        <img src="<?php echo esc_url($row_image['url']); ?>"
                                             alt="<?php echo esc_attr($row_image['alt']); ?>"/>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <?php // no rows found ?>
                            <?php endif; ?>

                            <?php $slide_title = get_sub_field('slide_title'); ?>
                            <?php $slide_content = get_sub_field('slide_content'); ?>
                            <?php $slide_content_code = get_sub_field('slide_content_code'); ?>
                            <?php $slide_title_type = get_sub_field('slide_title_type'); ?>
                            <?php
                            /*if ($slide_title_type == 'H1 Heading') {
                                echo '<h1>' . $slide_title . '</h1>';
                            }
                            if ($slide_title_type == 'H2 Heading') {
                                echo '<h2>' . $slide_title . '</h2>';
                            }
                            if ($slide_title_type == 'H3 Heading') {
                                echo '<h3>' . $slide_title . '</h3>';
                            }
                            if ($slide_title_type == 'H4 Heading') {
                                echo '<h4>' . $slide_title . '</h4>';
                            }
                            if ($slide_title_type == 'Text') {
                                echo '<span>' . $slide_title . '</span>';
                            }
                            if ($slide_title_type == 'WYSIWYG') {
                                echo '<div class="wysiwyg">' . $slide_content . '</div>';
                            }
                            if ($slide_title_type == 'CODE') {
                                echo '<div class="code">' . $slide_content_code . '</div>';
                            }*/
                            ?>
                            <?php /*$slide_link_title = get_sub_field('slide_link_title'); */ ?><!--
                                        <?php /*$slide_link_type = get_sub_field('slide_link_type'); */ ?>
                                        <?php /*if ($slide_link_type == 'External URL'): */ ?>
                                            <?php /*$slide_external_url = get_sub_field('slide_external_url'); */ ?>
                                            <a href="<?php /*echo $slide_external_url; */ ?>"
                                               target="_blank" class="button"><?php /*echo $slide_link_title; */ ?></a>
                                        <?php /*endif; */ ?>
                                        <?php /*if ($slide_link_type == 'Text'): */ ?>
                                            <?php /*$slide_text_link = get_sub_field('slide_text_link'); */ ?>
                                            <a href="<?php /*echo $slide_text_link; */ ?>"
                                               class="button"><?php /*echo $slide_link_title; */ ?></a>
                                        <?php /*endif; */ ?>
                                        <?php /*if ($slide_link_type == 'Internal Page'): */ ?>
                                            <?php /*$slide_internal_page = get_sub_field('slide_internal_page'); */ ?>
                                            <a href="<?php /*echo $slide_internal_page; */ ?>"
                                               class="button"><?php /*echo $slide_link_title; */ ?></a>
                                        --><?php /*endif; */ ?>
                        </div>
                        </div>

                    <?php } ?>
                    <?php $slideCounter++; ?>

                <?php endwhile; ?>
                </div>
            <?php endif; ?>
            <?php
            $slider_dots = get_field('dots');
            $slider_arrows = get_field('arrows');
            $data_options = '';
            if ($slider_dots) $data_options .= ' data-dots="true"';
            if ($slider_arrows) $data_options .= ' data-arrows="true"';
            ?>
            <div data-slick-slider class="hero-slides" <?php echo $data_options; ?>>
                <?php $slideCounter = 0; ?>
                <?php while (have_rows('slides')) : the_row(); ?>
                    <?php $slide_image = get_sub_field('slide_image'); ?>
                    <?php
                    $dark_slide_class = '';
                    $dark_slide = get_sub_field('dark_slide');
                    if($dark_slide) $dark_slide_class = ' dark-slide';
                    ?>
                    <?php $slide_imageURL = $slide_image['url']; ?>
                    <?php $slide_imageALT = $slide_image['alt']; ?>
                    <?php
                    $slide_imageWIDTH = $slide_image['width'];
                    $slide_imageHEIGHT = $slide_image['height'];
                    $slide_imageVW = $slide_imageHEIGHT / ($slide_imageWIDTH / 100);
                    $slide_imageMAXWIDTH = 1410;
                    $slide_imageMAXHEIGHT = $slide_imageHEIGHT / ($slide_imageWIDTH / $slide_imageMAXWIDTH);
                    ?>
                    <?php if ($slide_image) { ?>
                        <div class="hero-slide slide-<?php echo $slideCounter.$dark_slide_class; ?>"
                             style="background-image: url(<?php echo $slide_imageURL; ?>); background-repeat: no-repeat; background-size: cover; background-position: center;">
                            <div class="hero-slide-sizer"
                                 style="height: <?php echo $slide_imageVW; ?>vw;  max-height: <?php echo $slide_imageMAXHEIGHT; ?>px; width: 100%; max-width: <?php echo $slide_imageMAXWIDTH; ?>px;">
                                <div class="hero-slide-description">

                                    <?php if (have_rows('slide_content_rows')) : ?>
                                        <?php while (have_rows('slide_content_rows')) : the_row(); ?>
                                            <?php $row_type = get_sub_field('row_type'); ?>
                                            <?php $row_content = get_sub_field('row_content'); ?>
                                            <?php $row_paragraph = get_sub_field('row_paragraph'); ?>
                                            <?php $row_rich_text = get_sub_field('row_rich_text'); ?>
                                            <?php $row_spacer = get_sub_field('row_spacer'); ?>
                                            <?php $row_image = get_sub_field('row_image'); ?>
                                            <?php
                                            if ($row_type == 'Plain Text') {
                                                echo '<div class="hero-slide-content plain-text">';
                                                echo $row_content;
                                                echo '</div>';
                                            }
                                            if ($row_type == 'Rich Text') {
                                                echo '<div class="hero-slide-content rich-text">';
                                                echo $row_rich_text;
                                                echo '</div>';
                                            }
                                            if ($row_type == 'Paragraph') {
                                                echo '<p class="hero-slide-content">';
                                                echo $row_paragraph;
                                                echo '</p>';
                                            }
                                            if ($row_type == 'Spacer') {
                                                echo '<div class="hero-slide-content spacer" style="padding-top: ' . $row_spacer . 'px;">&nbsp;</div>';
                                            }
                                            if ($row_type == 'H1') {
                                                echo '<h1 class="hero-slide-content">';
                                                echo $row_content;
                                                echo '</h1>';
                                            }
                                            if ($row_type == 'H2') {
                                                echo '<h2 class="hero-slide-content">';
                                                echo $row_content;
                                                echo '</h2>';
                                            }
                                            if ($row_type == 'H3') {
                                                echo '<h3 class="hero-slide-content">';
                                                echo $row_content;
                                                echo '</h3>';
                                            }
                                            if ($row_type == 'H4') {
                                                echo '<h4 class="hero-slide-content">';
                                                echo $row_content;
                                                echo '</h4>';
                                            }
                                            if ($row_type == 'Image') {
                                                if ($row_image) {
                                                    echo '<div class="hero-slide-content image">';
                                                    echo '<img src="' . esc_url($row_image['url']) . '" alt="' . esc_attr($row_image['alt']) . '"/>';
                                                    echo '</div>';
                                                }
                                            }
                                            ?>
                                        <?php endwhile; ?>
                                    <?php else : ?>
                                        <?php // no rows found ?>
                                    <?php endif; ?>

                                    <?php $add_link = get_sub_field('add_link'); ?>
                                    <?php $slide_link_title = get_sub_field('slide_link_title'); ?>
                                    <?php $slide_link_type = get_sub_field('slide_link_type'); ?>
                                    <?php if ($add_link): ?>
                                        <?php if ($slide_link_type == 'External URL'): ?>
                                            <?php
                                            $slide_external_url = get_sub_field('slide_external_url');
                                            if ($slide_link_title == '') $slide_link_title = $slide_external_url;
                                            ?>
                                            <?php if ($slide_external_url != ''): ?>
                                                <a href="<?php echo $slide_external_url; ?>" target="_blank"
                                                   class="slide-button"><?php echo $slide_link_title; ?></a>
                                            <?php endif;; ?>
                                        <?php endif; ?>
                                        <?php if ($slide_link_type == 'Text'): ?>
                                            <?php
                                            $slide_text_link = get_sub_field('slide_text_link');
                                            if ($slide_link_title == '') $slide_link_title = $slide_text_link;
                                            ?>
                                            <?php if ($slide_text_link != ''): ?>
                                                <a href="<?php echo $slide_text_link; ?>"
                                                   class="slide-button"><?php echo $slide_link_title; ?></a>
                                            <?php endif;; ?>
                                        <?php endif; ?>
                                        <?php if ($slide_link_type == 'Internal Page'): ?>
                                            <?php
                                            $slide_internal_page = get_sub_field('slide_internal_page');
                                            if ($slide_link_title == '') $slide_link_title = $slide_internal_page;
                                            ?>
                                            <?php if ($slide_internal_page != ''): ?>
                                                <a href="<?php echo $slide_internal_page; ?>"
                                                   class="slide-button"><?php echo $slide_link_title; ?></a>
                                            <?php endif;; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                    <?php $slideCounter++; ?>

                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <?php // no rows found ?>
        <?php endif; ?>
    <?php endif; ?>
</div>
