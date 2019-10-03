<?php
/**
 * Load files.
 *
 * @package Wishlist
 */

//=============================================================
// Change number of product per row
//=============================================================

if (!function_exists('wishlist_product_columns')) {

	function wishlist_product_columns() {

		$product_number = wishlist_get_option( 'product_number' );

		return absint( $product_number ); // number of products per row

	}
	
}

add_filter('loop_shop_columns', 'wishlist_product_columns');

//=============================================================
// Change number of related product
//=============================================================

if (!function_exists('wishlist_related_products_args')) {

	function wishlist_related_products_args( $args ) {

		$product_number = wishlist_get_option( 'product_number' );

		$args['columns']   		= absint( $product_number );
		
		$args['posts_per_page'] = absint( $product_number ); // number of related products
		
		return $args;
	}

}

add_filter( 'woocommerce_output_related_products_args', 'wishlist_related_products_args' );


//=============================================================
// Change number of upsell products
//=============================================================

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

add_action( 'woocommerce_after_single_product_summary', 'wishlist_output_upsells', 15 );

if ( ! function_exists( 'wishlist_output_upsells' ) ) {

	function wishlist_output_upsells() {

		$product_number = wishlist_get_option( 'product_number' );

	    woocommerce_upsell_display( absint( $product_number ), absint( $product_number ) ); // Display 3 products in rows of 3
	    
	}

}

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );


add_action( 'woocommerce_shop_loop_item_title', 'wishlist_woocommerce_template_loop_product_title', 10 );

if ( ! function_exists( 'wishlist_woocommerce_template_loop_product_title' ) ) {

	/**
	 * Show the product title in the product loop. By default this is an H2.
	 */
	function wishlist_woocommerce_template_loop_product_title() {
		echo '<h2 class="woocommerce-loop-product__title">' . get_the_title() . '</h2>';
		echo '</a>';
	}
}

// Remove sidebar in woocommerce page and add conditional sidebar
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10); 

add_action( 'woocommerce_sidebar', 'wishlist_woocommerce_sidebar', 10 ); 

function wishlist_woocommerce_sidebar( ) { 

	$shop_layout = wishlist_get_option( 'shop_layout' );

	// Include sidebar.
	if ( 'no-sidebar' !== $shop_layout ) {
		get_sidebar();
	}
};

// Return the number of products you want to show per page
add_filter( 'loop_shop_per_page', 'wishlist_new_loop_shop_per_page', 20 );

function wishlist_new_loop_shop_per_page( $cols ) {
  
  $product_per_page = wishlist_get_option( 'product_per_page' );

  $cols = absint( $product_per_page );

  return $cols;
}

// Remove sorting option
$hide_product_sorting = wishlist_get_option( 'hide_product_sorting' );

if( true === $hide_product_sorting ){

	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

}

// Disable Related Products
$disable_related_products = wishlist_get_option( 'disable_related_products' );

if( true === $disable_related_products ){

	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}

// Update number of items in cart and total after Ajax
add_filter( 'woocommerce_add_to_cart_fragments', 'wishlist_header_add_to_cart_fragment' );

function wishlist_header_add_to_cart_fragment( $fragments ) {
	
	global $woocommerce;
	
	ob_start(); ?>

	<span class="cart-value wishlist-cart-fragment"> <?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>

	<?php

	$fragments['span.wishlist-cart-fragment'] = ob_get_clean();

	return $fragments;
	
}