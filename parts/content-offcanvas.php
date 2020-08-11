<?php
/**
 * The template part for displaying offcanvas content
 *
 * For more info: http://jointswp.com/docs/off-canvas-menu/
 */
?>

<div class="off-canvas position-right" id="off-canvas" data-off-canvas>
    <?php joints_off_canvas_nav(); ?>

    <?php echo get_product_categories('off-canvas'); ?>

    <?php if (is_active_sidebar('offcanvas')) : ?>
        <div style="padding-left: 1em; padding-right: 1em;">
            <?php dynamic_sidebar('offcanvas'); ?>
        </div>
    <?php endif; ?>

</div>
