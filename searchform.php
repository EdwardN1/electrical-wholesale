<?php
/**
 * The template for displaying search form
 */
 ?>

<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'jointswp' ) ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search...', 'jointswp' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'jointswp' ) ?>" />
	</label>
	<?php
	if ( have_rows( 'icons', 'option' ) ) :
		while ( have_rows( 'icons', 'option' ) ) : the_row();
			$iname = get_sub_field( 'name' );
			$icon  = get_sub_field( 'icon' );
		endwhile;
	endif;
	?>
    <input type=image src="<?php the_field( '' ); ?>" alt="Search">
	<input type="submit" class="search-submit button" value="<?php echo esc_attr_x( 'Search', 'jointswp' ) ?>" />
</form>