<?php
/**
 * The template used for displaying hero content
 *
 * @package Bold_Photography
 */

$enable_section = get_theme_mod( 'bold_photography_hero_content_visibility', 'disabled' );

if ( ! bold_photography_check_section( $enable_section ) ) {
	// Bail if hero content is not enabled
	return;
}
	
get_template_part( 'template-parts/hero-content/post-type-hero' );