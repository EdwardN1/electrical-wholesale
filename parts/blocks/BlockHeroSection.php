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
                        .hero-slides {display: none;}
                        .hero-slides.mobile {display: block;}
                        @media screen and (min-width: <?php echo $mobile_break_point;?>px) {
                            .hero-slides {display: block;}
                            .hero-slides.mobile {display: none;}
                        }
                    </style>
                    <div data-slick-slider class="hero-slides mobile">
                        <?php $slideCounter = 0; ?>
                        <?php while (have_rows('slides')) : the_row(); ?>
                            <?php $slide_image = get_sub_field('slide_mobile_image'); ?>
                            <?php $slide_imageURL = $slide_image['url']; ?>
                            <?php $slide_imageALT = $slide_image['alt']; ?>
                            <?php if ($slide_image) { ?>
                                <div class="hero-slide slide-<?php echo $slideCounter; ?>" style="background-image: url(<?php echo $slide_imageURL; ?>)">
                                    <div class="hero-slide-description">
                                        <?php $slide_title = get_sub_field('slide_title'); ?>
                                        <?php $slide_title_type = get_sub_field('slide_title_type'); ?>

                                        <?php if ($slide_title_type == 'H1 Heading'): ?>
                                            <h1><?php echo $slide_title; ?></h1>
                                        <?php else: ?>
                                            <?php if ($slide_title_type == 'H2 Heading'): ?>
                                                <h2><?php echo $slide_title; ?></h2>
                                            <?php else: ?>
                                                <span><?php echo $slide_title; ?></span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php $slide_link_title = get_sub_field('slide_link_title'); ?>
                                        <?php $slide_link_type = get_sub_field('slide_link_type'); ?>
                                        <?php if ($slide_link_type == 'External URL'): ?>
                                            <?php $slide_external_url = get_sub_field('slide_external_url'); ?>
                                            <a href="<?php echo $slide_external_url; ?>"
                                               target="_blank" class="button"><?php echo $slide_link_title; ?></a>
                                        <?php endif; ?>
                                        <?php if ($slide_link_type == 'Text'): ?>
                                            <?php $slide_text_link = get_sub_field('slide_text_link'); ?>
                                            <a href="<?php echo $slide_text_link; ?>"
                                               class="button"><?php echo $slide_link_title; ?></a>
                                        <?php endif; ?>
                                        <?php if ($slide_link_type == 'Internal Page'): ?>
                                            <?php $slide_internal_page = get_sub_field('slide_internal_page'); ?>
                                            <a href="<?php echo $slide_internal_page; ?>"
                                               class="button"><?php echo $slide_link_title; ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            <?php } ?>
                            <?php $slideCounter++; ?>

                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                <div data-slick-slider class="hero-slides">
                    <?php $slideCounter = 0; ?>
                    <?php while (have_rows('slides')) : the_row(); ?>
                        <?php $slide_image = get_sub_field('slide_image'); ?>
                        <?php $slide_imageURL = $slide_image['url']; ?>
                        <?php $slide_imageALT = $slide_image['alt']; ?>
                        <?php if ($slide_image) { ?>
                            <div class="hero-slide slide-<?php echo $slideCounter; ?>" style="background-image: url(<?php echo $slide_imageURL; ?>)">
                                <div class="hero-slide-description">
                                    <?php $slide_title = get_sub_field('slide_title'); ?>
                                    <?php $slide_title_type = get_sub_field('slide_title_type'); ?>

                                    <?php if ($slide_title_type == 'H1 Heading'): ?>
                                        <h1><?php echo $slide_title; ?></h1>
                                    <?php else: ?>
                                        <?php if ($slide_title_type == 'H2 Heading'): ?>
                                            <h2><?php echo $slide_title; ?></h2>
                                        <?php else: ?>
                                            <span><?php echo $slide_title; ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php $slide_link_title = get_sub_field('slide_link_title'); ?>
                                    <?php $slide_link_type = get_sub_field('slide_link_type'); ?>
                                    <?php if ($slide_link_type == 'External URL'): ?>
                                        <?php $slide_external_url = get_sub_field('slide_external_url'); ?>
                                        <a href="<?php echo $slide_external_url; ?>"
                                           target="_blank" class="button"><?php echo $slide_link_title; ?></a>
                                    <?php endif; ?>
                                    <?php if ($slide_link_type == 'Text'): ?>
                                        <?php $slide_text_link = get_sub_field('slide_text_link'); ?>
                                        <a href="<?php echo $slide_text_link; ?>"
                                           class="button"><?php echo $slide_link_title; ?></a>
                                    <?php endif; ?>
                                    <?php if ($slide_link_type == 'Internal Page'): ?>
                                        <?php $slide_internal_page = get_sub_field('slide_internal_page'); ?>
                                        <a href="<?php echo $slide_internal_page; ?>"
                                           class="button"><?php echo $slide_link_title; ?></a>
                                    <?php endif; ?>
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
