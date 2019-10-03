<?php
/**
 * Hero Content Options
 *
 * @package Bold_Photography
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bold_photography_hero_content_options( $wp_customize ) {
	$wp_customize->add_section( 'bold_photography_hero_content_options', array(
			'title' => esc_html__( 'Hero Content', 'bold-photography' ),
			'panel' => 'bold_photography_theme_options',
		)
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_hero_content_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'bold_photography_sanitize_select',
			'choices'           => bold_photography_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'bold-photography' ),
			'section'           => 'bold_photography_hero_content_options',
			'type'              => 'select',
		)
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_hero_content',
			'default'           => '0',
			'sanitize_callback' => 'bold_photography_sanitize_post',
			'active_callback'   => 'bold_photography_is_hero_content_active',
			'label'             => esc_html__( 'Page', 'bold-photography' ),
			'section'           => 'bold_photography_hero_content_options',
			'type'              => 'dropdown-pages',
		)
	);
}
add_action( 'customize_register', 'bold_photography_hero_content_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'bold_photography_is_hero_content_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since Bold Photography 1.0
	*/
	function bold_photography_is_hero_content_active( $control ) {
		$enable = $control->manager->get_setting( 'bold_photography_hero_content_visibility' )->value();

		return bold_photography_check_section( $enable );
	}
endif;