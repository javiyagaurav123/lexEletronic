<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Wishlist
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wishlist_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	if( class_exists( 'WooCommerce' ) && is_woocommerce() ){
		// Add class for global layout on woocommerce pages.
		$shop_layout 	= wishlist_get_option( 'shop_layout' );
		$classes[] = 'global-layout-' . esc_attr( $shop_layout );

	}else{
		// Add class for global layout.
		$global_layout = wishlist_get_option( 'global_layout' );
		$classes[] = 'global-layout-' . esc_attr( $global_layout );

	}

	//Add column class in body for woocommerce
	$product_number = wishlist_get_option( 'product_number' );

	if(  2 === $product_number || 3 === $product_number || 4 === $product_number ){

		$classes[] = 'columns-'.absint( $product_number );

	}else{

		$classes[] = 'columns-3';

	}

	return $classes;
}
add_filter( 'body_class', 'wishlist_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function wishlist_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'wishlist_pingback_header' );

//=============================================================
// Function to change default excerpt
//=============================================================
if ( ! function_exists( 'wishlist_implement_excerpt_length' ) ) :

	/**
	 * Implement excerpt length.
	 *
	 * @since 1.0.0
	 *
	 * @param int $length The number of words.
	 * @return int Excerpt length.
	 */
	function wishlist_implement_excerpt_length( $length ) {

		$excerpt_length = wishlist_get_option( 'excerpt_length' );

		if ( absint( $excerpt_length ) > 0 ) {
			$length = absint( $excerpt_length );
		}
		return $length;

	}
endif;

if ( ! function_exists( 'wishlist_content_more_link' ) ) :

	/**
	 * Implement read more in content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more_link Read More link element.
	 * @param string $more_link_text Read More text.
	 * @return string Link.
	 */
	function wishlist_content_more_link( $more_link, $more_link_text ) {

		$read_more_text = wishlist_get_option( 'readmore_text' );

		if ( ! empty( $read_more_text ) ) {

			$more_link = str_replace( $more_link_text, esc_html( $read_more_text ), $more_link );

		}

		return $more_link;

	}

endif;

if ( ! function_exists( 'wishlist_implement_read_more' ) ) :

	/**
	 * Implement read more in excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The excerpt.
	 */
	function wishlist_implement_read_more( $more ) {

		$output = $more;

		$read_more_text = wishlist_get_option( 'readmore_text' );

		if ( ! empty( $read_more_text ) ) {

			$output = '&hellip;<p><a href="' . esc_url( get_permalink() ) . '" class="btn-more">' . esc_html( $read_more_text ) . '<span class="arrow-more">&rarr;</span></a></p>';

		}

		return $output;

	}
endif;

if ( ! function_exists( 'wishlist_hook_read_more_filters' ) ) :

	/**
	 * Hook read more and excerpt length filters.
	 *
	 * @since 1.0.0
	 */
	function wishlist_hook_read_more_filters() {
		
		add_filter( 'excerpt_length', 'wishlist_implement_excerpt_length', 999 );
		add_filter( 'the_content_more_link', 'wishlist_content_more_link', 10, 2 );
		add_filter( 'excerpt_more', 'wishlist_implement_read_more' );

	}
endif;
add_action( 'wp', 'wishlist_hook_read_more_filters' );

if ( ! function_exists( 'wp_body_open' ) ) {
    /**
     * Body open hook.
     */
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}