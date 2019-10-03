<?php
/**
 * Options.
 *
 * @package Wishlist
 */

$default = wishlist_get_default_theme_options();

// Add Theme Options Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
		'title'      => esc_html__( 'Theme Options', 'wishlist' ),
		'priority'   => 80,
	)
);

// Load main header options.
require_once trailingslashit( get_template_directory() ) . '/inc/customizer/options/header.php';

// Load shop page options if woocommerce is active.
if( class_exists( 'WooCommerce' ) ){
	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/options/shop.php';
}

// Load blog options.
require_once trailingslashit( get_template_directory() ) . '/inc/customizer/options/blog.php';

// Load footer options.
require_once trailingslashit( get_template_directory() ) . '/inc/customizer/options/footer.php';