<?php

function tc_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'tc_add_woocommerce_support' );

add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

/*function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 150,
		'single_image_width'    => 300,

		'product_grid'          => array(
			'default_rows'    => 3,
			'min_rows'        => 2,
			'max_rows'        => 8,
			'default_columns' => 4,
			'min_columns'     => 2,
			'max_columns'     => 5,
		),
	) );
}

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );*/

/*add_filter( 'woocommerce_enqueue_styles', '__return_false' );*/


/**
 *
 * Rearrange woocommerce_single_product_summary
 *
 * Hook: woocommerce_single_product_summary.
 *
 * @hooked woocommerce_template_single_title - 5
 * @hooked woocommerce_template_single_rating - 10
 * @hooked woocommerce_template_single_price - 10
 * @hooked woocommerce_template_single_excerpt - 20
 * @hooked woocommerce_template_single_add_to_cart - 30
 * @hooked woocommerce_template_single_meta - 40
 * @hooked woocommerce_template_single_sharing - 50
 * @hooked WC_Structured_Data::generate_product_data() - 60
 *
 * @hooked woocommerce_template_single_title - 5
 * @hooked woocommerce_template_single_meta - 10
 * @hooked woocommerce_template_single_rating - 20
 * @hooked woocommerce_template_single_price - 20
 * @hooked woocommerce_template_single_excerpt -30
 * @hooked woocommerce_template_single_add_to_cart - 40
 * @hooked woocommerce_template_single_sharing - 50
 * @hooked WC_Structured_Data::generate_product_data() - 60
 */

remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',20);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_sharing',50);

add_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
add_action('woocommerce_single_product_summary','woocommerce_template_single_meta',10);
add_action('woocommerce_single_product_summary','woocommerce_template_single_rating',20);
add_action('woocommerce_single_product_summary','woocommerce_template_single_price',20);
add_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',30);
add_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',40);
add_action('woocommerce_single_product_summary','woocommerce_template_single_sharing',50);