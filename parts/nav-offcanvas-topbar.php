<?php
/**
 * The off-canvas menu uses the Off-Canvas Component
 *
 * For more info: http://jointswp.com/docs/off-canvas-menu/
 */
?>


<?php $mobile_break_point = get_field( 'mobile_break_point', 'option' ); ?>
<?php if ( have_rows( 'header_rows', 'option' ) ) : ?>
    <?php while ( have_rows( 'header_rows', 'option' ) ) : the_row(); ?>
        <?php $row_name = get_sub_field( 'row_name' ); ?>
        <?php $row_type = get_sub_field( 'row_type' ); ?>
        <?php $row_height = get_sub_field( 'row_height' ); ?>
        <?php $row_height_mobile = get_sub_field( 'row_height_mobile' ); ?>
        <?php $row_max_height = get_sub_field( 'row_max_height' ); ?>
        <?php $row_max_height_mobile = get_sub_field( 'row_max_height_mobile' ); ?>
        <?php $row_background_type = get_sub_field( 'row_background_type' ); ?>
        <?php $row_background_image = get_sub_field( 'row_background_image' ); ?>
        <?php $row_background_image_URL = $row_background_image['url']; ?>
        <?php $row_background_image_ALT = $row_background_image['alt']; ?>
        <?php $row_background_colour = get_sub_field( 'row_background_colour' ); ?>
        <?php if ( have_rows( 'container_rows' ) ) : ?>
            <?php while ( have_rows( 'container_rows' ) ) : the_row(); ?>
                <?php if ( have_rows( 'container_columns' ) ) : ?>
                    <?php while ( have_rows( 'container_columns' ) ) : the_row(); ?>
                        <?php the_sub_field( 'container_name' ); ?>
                        <?php the_sub_field( 'column_width' ); ?>
                        <?php the_sub_field( 'container_content_type' ); ?>
                        <?php the_sub_field( 'container_content' ); ?>
                        <?php the_sub_field( 'container_content_text' ); ?>
                        <pre><code><?php echo esc_html( get_sub_field( 'container_css' ) ); ?></code></pre>
                        <pre><code><?php echo esc_html( get_sub_field( 'container_css_mobile' ) ); ?></code></pre>
                    <?php endwhile; ?>
                <?php else : ?>
                    <?php // no rows found ?>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php else : ?>
            <?php // no rows found ?>
        <?php endif; ?>
        <?php the_sub_field( 'content_type' ); ?>
        <?php the_sub_field( 'wysiwyg_content' ); ?>
        <?php the_sub_field( 'text_content' ); ?>
        <pre><code><?php echo esc_html( get_sub_field( 'row_css' ) ); ?></code></pre>
        <pre><code><?php echo esc_html( get_sub_field( 'row_css_mobile' ) ); ?></code></pre>
    <?php endwhile; ?>
<?php else : ?>
    <?php // no rows found ?>
<?php endif; ?>

<div class="top-bar" id="top-bar-menu">
	<div class="top-bar-left float-left">
		<ul class="menu">
			<li><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></li>
		</ul>
	</div>
	<div class="top-bar-right show-for-medium">
		<?php joints_top_nav(); ?>	
	</div>
	<div class="top-bar-right float-right show-for-small-only">
		<ul class="menu">
			<!-- <li><button class="menu-icon" type="button" data-toggle="off-canvas"></button></li> -->
			<li><a data-toggle="off-canvas"><?php _e( 'Menu', 'jointswp' ); ?></a></li>
		</ul>
	</div>
</div>