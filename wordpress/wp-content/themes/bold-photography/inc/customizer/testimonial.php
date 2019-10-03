<?php
/**
 * Add Testimonial Settings in Customizer
 *
 * @package Bold_Photography
*/

/**
 * Add testimonial options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bold_photography_testimonial_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_jetpack_testimonial_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Bold_Photography_Note_Control',
			'label'             => sprintf( esc_html__( 'For Testimonial Options for Bold Photographyazine Theme, go %1$shere%2$s', 'bold-photography' ),
				'<a href="javascript:wp.customize.section( \'bold_photography_testimonials\' ).focus();">',
				 '</a>'
			),
		   'section'            => 'jetpack_testimonials',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	$wp_customize->add_section( 'bold_photography_testimonials', array(
			'panel'    => 'bold_photography_theme_options',
			'title'    => esc_html__( 'Testimonials', 'bold-photography' ),
		)
	);

	$action = 'install-plugin';
	$slug   = 'essential-content-types';

	$install_url = wp_nonce_url(
	    add_query_arg(
	        array(
	            'action' => $action,
	            'plugin' => $slug
	        ),
	        admin_url( 'update.php' )
	    ),
	    $action . '_' . $slug
	);

	bold_photography_register_option( $wp_customize, array(
	        'name'              => 'bold_photography_testimonial_jetpack_note',
	        'sanitize_callback' => 'sanitize_text_field',
	        'custom_control'    => 'Bold_Photography_Note_Control',
	        'active_callback'   => 'bold_photography_is_ect_testimonial_inactive',
	        /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
	        'label'             => sprintf( esc_html__( 'For Testimonial, install %1$sEssential Content Types%2$s Plugin with testimonial Type Enabled', 'bold-photography' ),
	            '<a target="_blank" href="' . esc_url( $install_url ) . '">',
	            '</a>'

	        ),
	       'section'            => 'bold_photography_testimonials',
	        'type'              => 'description',
	        'priority'          => 1,
	    )
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_testimonial_option',
			'default'           => 'disabled',
			'active_callback'   => 'bold_photography_is_ect_testimonial_active',
			'sanitize_callback' => 'bold_photography_sanitize_select',
			'choices'           => bold_photography_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'bold-photography' ),
			'section'           => 'bold_photography_testimonials',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_testimonial_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Bold_Photography_Note_Control',
			'active_callback'   => 'bold_photography_is_testimonial_active',
			/* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'bold-photography' ),
				'<a href="javascript:wp.customize.section( \'jetpack_testimonials\' ).focus();">',
				'</a>'
			),
			'section'           => 'bold_photography_testimonials',
			'type'              => 'description',
		)
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_testimonial_number',
			'default'           => '3',
			'sanitize_callback' => 'bold_photography_sanitize_number_range',
			'active_callback'   => 'bold_photography_is_testimonial_active',
			'label'             => esc_html__( 'Number of items', 'bold-photography' ),
			'section'           => 'bold_photography_testimonials',
			'type'              => 'number',
			'input_attrs'       => array(
				'style'             => 'width: 100px;',
				'min'               => 0,
			),
		)
	);

	$number = get_theme_mod( 'bold_photography_testimonial_number', 3 );

	for ( $i = 1; $i <= $number ; $i++ ) {

		//for CPT
		bold_photography_register_option( $wp_customize, array(
				'name'              => 'bold_photography_testimonial_cpt_' . $i,
				'sanitize_callback' => 'bold_photography_sanitize_post',
				'active_callback'   => 'bold_photography_is_testimonial_active',
				'label'             => esc_html__( 'Testimonial', 'bold-photography' ) . ' ' . $i ,
				'section'           => 'bold_photography_testimonials',
				'type'              => 'select',
				'choices'           => bold_photography_generate_post_array( 'jetpack-testimonial' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'bold_photography_testimonial_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'bold_photography_is_testimonial_active' ) ) :
	/**
	* Return true if testimonial is active
	*
	* @since Bold Photography 1.0
	*/
	function bold_photography_is_testimonial_active( $control ) {
		$enable = $control->manager->get_setting( 'bold_photography_testimonial_option' )->value();

        //return true only if previwed page on customizer matches the type of content option selected
        return ( bold_photography_is_ect_testimonial_active( $control ) &&  bold_photography_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'bold_photography_is_ect_testimonial_inactive' ) ) :
    /**
    *
    * @since Bold Photography 1.0
    */
    function bold_photography_is_ect_testimonial_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;

if ( ! function_exists( 'bold_photography_is_ect_testimonial_active' ) ) :
    /**
    *
    * @since Bold Photography 1.0
    */
    function bold_photography_is_ect_testimonial_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;



