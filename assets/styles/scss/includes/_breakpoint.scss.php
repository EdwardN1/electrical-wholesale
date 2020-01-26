<?php if ( have_rows( 'breakpoints', 'option' ) ) : ?>
    $breakpoints: (
	<?php while ( have_rows( 'breakpoints', 'option' ) ) : the_row(); ?>
        small: 0,
        medium: <?php the_sub_field( 'medium' ); ?>px,
        large: <?php the_sub_field( 'large' ); ?>px,
        xlarge: <?php the_sub_field( 'xlarge' ); ?>px,
        xxlarge: <?php the_sub_field( 'xxlarge' ); ?>px,
	<?php endwhile; ?>
    ) !default;
<?php endif;
