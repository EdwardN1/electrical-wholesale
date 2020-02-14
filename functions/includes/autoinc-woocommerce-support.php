<?php

function tc_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'tc_add_woocommerce_support');

//add_theme_support( 'wc-product-gallery-zoom' );
//add_theme_support( 'wc-product-gallery-lightbox' );
//add_theme_support( 'wc-product-gallery-slider' );

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

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
//remove_action('woocommerce_single_product_summary','WC_Structured_Data::generate_product_data()',60);

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 20);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
//add_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',40);
add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 50);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 55);
//add_action('woocommerce_single_product_summary','WC_Structured_Data::generate_product_data()',70);

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

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

/**
 * Reorder product data tabs
 */
add_filter('woocommerce_product_tabs', 'woo_reorder_tabs', 98);
function woo_reorder_tabs($tabs)
{

    $tabs['description']['priority'] = 10;            // Description second
    $tabs['reviews']['priority'] = 15;            // Reviews third

    return $tabs;
}

/**
 * Rename product data tabs
 */
add_filter('woocommerce_product_tabs', 'woo_rename_tabs', 98);
function woo_rename_tabs($tabs)
{

    $tabs['description']['title'] = __('Product Details');        // Rename the description tab

    return $tabs;

}


/**
 * Add a custom product data tab
 */
add_filter('woocommerce_product_tabs', 'woo_new_product_tab');
function woo_new_product_tab($tabs)
{

    // Adds the new tab

    $tabs['test_tab'] = array(
        'title' => __('Description', 'woocommerce'),
        'priority' => 5,
        'callback' => 'woo_new_product_tab_content'
    );

    return $tabs;

}

function woo_new_product_tab_content()
{

    // The new tab content

    /*echo '<h2>New Product Tab</h2>';
    echo '<p>Here\'s your new product tab.</p>';*/
    woocommerce_template_single_excerpt();
}

add_filter('woocommerce_get_price_html', 'ts_price_html', 100, 2);

function ts_price_html($price, $product)
{
    ob_start();
    $sPrice = explode('.', $price);
    ?>
    <span class="only">Only</span>
    <br><?php echo $sPrice[0]; ?><span class="pence">.<?php echo $sPrice[1]; ?></span>
    <br>
    <span class="normal">VAT excluded</span>
    <?php
    $res = ob_get_contents();
    ob_end_clean();
    return $res;
}

/**
 * @param $translated_text
 * @param $text
 * @param $domain
 *
 * @return string|string[]
 *
 * Change Cart to Basket
 */

function gb_change_cart_string($translated_text, $text, $domain)
{

    $translated_text = str_replace("cart", "basket", $translated_text);

    $translated_text = str_replace("Cart", "Basket", $translated_text);

    return $translated_text;
}

add_filter('gettext', 'gb_change_cart_string', 100, 3);

/**
 * Hook: woocommerce_shop_loop_item_title.
 *
 * @hooked woocommerce_template_loop_product_title - 10
 */
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', 'ts_woocommerce_template_loop_product_title', 10);

function ts_woocommerce_template_loop_product_title()
{
    $title = get_the_title();
    if (str_word_count($title, 0) > 5) {
        $words = str_word_count($title, 2);
        $pos = array_keys($words);
        $title = substr($title, 0, $pos[5]) . '...';
    }

    echo '<h2 class="' . esc_attr(apply_filters('woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title')) . '">' . $title . '</h2>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Hook: woocommerce_before_shop_loop
 *
 *  Add in categories and sub-categories to product listings.
 */

function ts_product_subcategories($args = array())
{

        $parentid = get_queried_object_id();
        $args = array(
            'parent' => $parentid
        );

        $terms = get_terms('product_cat', $args);

        if ($terms) {
            $numberCols = 4;
            echo '<ul class="products columns-' . $numberCols . '">';
            $colCount = 1;
            $colClass = '';
            foreach ($terms as $term) {
                if (($term->name != 'Uncategorized') && ($term->count > 0)):
                    if ($colCount == 1) {
                        $colClass = ' first';
                    } else {
                        $colClass = '';
                    }
                    if ($colCount == $numberCols) {
                        $colClass = ' last';
                        $colCount = 1;
                    } else {
                        $colCount++;
                    }
                    echo '<li class="product-category product' . $colClass . '">';
                    echo '<a href="' . esc_url(get_term_link($term)) . '" class="' . $term->slug . '">';
                    woocommerce_subcategory_thumbnail($term);
                    echo '<h2 class="woocommerce-loop-category__title">';
                    echo $term->name;
                    echo '</h2>';
                    echo '</a>';
                    echo '</li>';
                endif;
            }
            echo '</ul>';
        }

}


//add_action('woocommerce_before_main_content', 'ts_product_subcategories', 500);

/**
 * Add AJAX Shortcode when cart contents update
 */

add_filter( 'woocommerce_add_to_cart_fragments', 'woo_cart_but_count' );

function woo_cart_but_count( $fragments ) {



    $cart_count = WC()->cart->cart_contents_count;

    $frag = '<style id="basket-cart-qty">a.icon-link-basket:after {content: "'.$cart_count.'";}</style>';
    $fragments['style#basket-cart-qty'] = $frag;

    return $fragments;
}