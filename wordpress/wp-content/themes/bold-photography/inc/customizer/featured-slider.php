<?php
/**
 * Featured Slider Options
 *
 * @package Bold_Photography
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bold_photography_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'bold_photography_featured_slider', array(
			'panel' => 'bold_photography_theme_options',
			'title' => esc_html__( 'Featured Slider', 'bold-photography' ),
		)
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'bold_photography_sanitize_select',
			'choices'           => bold_photography_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'bold-photography' ),
			'section'           => 'bold_photography_featured_slider',
			'type'              => 'select',
		)
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_slider_number',
			'default'           => '4',
			'sanitize_callback' => 'bold_photography_sanitize_number_range',

			'active_callback'   => 'bold_photography_is_slider_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'bold-photography' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of Slides', 'bold-photography' ),
			'section'           => 'bold_photography_featured_slider',
			'type'              => 'number',
		)
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_slider_content_show',
			'default'           => 'hide-content',
			'sanitize_callback' => 'bold_photography_sanitize_select',
			'active_callback'   => 'bold_photography_is_slider_active',
			'choices'           => bold_photography_content_show(),
			'label'             => esc_html__( 'Display Content', 'bold-photography' ),
			'section'           => 'bold_photography_featured_slider',
			'type'              => 'select',
		)
	);

	$slider_number = get_theme_mod( 'bold_photography_slider_number', 4 );

	for ( $i = 1; $i <= $slider_number ; $i++ ) {
		// Page Sliders
		bold_photography_register_option( $wp_customize, array(
				'name'              => 'bold_photography_slider_page_' . $i,
				'sanitize_callback' => 'bold_photography_sanitize_post',
				'active_callback'   => 'bold_photography_is_slider_active',
				'label'             => esc_html__( 'Page', 'bold-photography' ) . ' # ' . $i,
				'section'           => 'bold_photography_featured_slider',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'bold_photography_slider_options' );

/** Active Callback Functions */

if ( ! function_exists( 'bold_photography_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since Bold Photography 1.0
	*/
	function bold_photography_is_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'bold_photography_slider_option' )->value();

		//return true only if previwed page on customizer matches the type option selected
		return bold_photography_check_section( $enable );
	}
endif;