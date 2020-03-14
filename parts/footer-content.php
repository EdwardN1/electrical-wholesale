<?php if (have_rows('footer_rows', 'option')) : ?>
    <?php while (have_rows('footer_rows', 'option')) : the_row(); ?>
        <div class="<?php echo cssName(get_sub_field('row_name')); ?>">
            <!--<div class="grid-container">-->
                <?php $row_type = get_sub_field('row_type'); ?>
                <?php if ($row_type == 'Container'): ?>
                    <?php if (have_rows('container_rows')) : ?>
                        <?php while (have_rows('container_rows')) : the_row(); ?>
                            <div class="grid-x <?php echo cssName(get_sub_field('container_row_name')); ?>">
                                <?php if (have_rows('container_columns')) : ?>
                                    <?php while (have_rows('container_columns')) : the_row(); ?>
                                        <div class="<?php echo cssName(get_sub_field('container_name')); ?> cell <?php the_sub_field('column_width'); ?>">
                                            <?php $container_content_type = get_sub_field('container_content_type'); ?>
                                            <?php if ($container_content_type == 'Wysiwyg Content'): ?>
                                                <?php $container_content = the_sub_field('container_content'); ?>
                                            <?php else: ?>
                                                <?php echo tokens(get_sub_field('container_content_text')); ?>
                                            <?php endif; ?>
                                        </div>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <?php // no rows found ?>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <?php // no rows found ?>
                    <?php endif; ?>
                <?php else: ?>
                    <?php $content_type = get_sub_field('content_type'); ?>
                    <?php if ($content_type == 'Wysiwyg Editor'): ?>
                        <?php the_sub_field('wysiwyg_content'); ?>
                    <?php else: ?>
                        <?php echo tokens(get_sub_field('text_content')); ?>
                    <?php endif; ?>
                <?php endif; ?>
            <!--</div>-->
        </div>
    <?php endwhile; ?>
<?php else : ?>
    <?php // no rows found ?>
<?php endif; ?>
