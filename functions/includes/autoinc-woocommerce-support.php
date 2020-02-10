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
remove_action('woocommerce_single_product_summary','WC_Structured_Data::generate_product_data()',60);

add_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
add_action('woocommerce_single_product_summary','woocommerce_template_single_meta',10);
add_action('woocommerce_single_product_summary','woocommerce_template_single_rating',20);
add_action('woocommerce_single_product_summary','woocommerce_template_single_price',20);
add_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);
//add_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',40);
add_action('woocommerce_single_product_summary','woocommerce_output_product_data_tabs',50);
add_action('woocommerce_single_product_summary','woocommerce_template_single_sharing',60);
add_action('woocommerce_single_product_summary','WC_Structured_Data::generate_product_data()',70);

/**
 * re-arrange: woocommerce_after_single_product_summary.
 *
 * @hooked woocommerce_output_product_data_tabs - 10
 * @hooked woocommerce_upsell_display - 15
 * @hooked woocommerce_output_related_products - 20
 *
 * @hooked woocommerce_upsell_display - 15
 * @hooked woocommerce_output_related_products - 20
 */

remove_action('woocommerce_after_single_product_summary','woocommerce_output_product_data_tabs',10);

/**
 * Reorder product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'woo_reorder_tabs', 98 );
function woo_reorder_tabs( $tabs ) {

	$tabs['description']['priority'] = 10;			// Description second
	$tabs['reviews']['priority'] = 15;			// Reviews third

	return $tabs;
}

/**
 * Rename product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {

	$tabs['description']['title'] = __( 'Product Details' );		// Rename the description tab

	return $tabs;

}


/**
 * Add a custom product data tab
 */
add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {

	// Adds the new tab

	$tabs['test_tab'] = array(
		'title' 	=> __( 'Description', 'woocommerce' ),
		'priority' 	=> 5,
		'callback' 	=> 'woo_new_product_tab_content'
	);

	return $tabs;

}
function woo_new_product_tab_content() {

	// The new tab content

	/*echo '<h2>New Product Tab</h2>';
	echo '<p>Here\'s your new product tab.</p>';*/
	woocommerce_template_single_excerpt();
}

