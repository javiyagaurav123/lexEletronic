<?php
/**
 * Add Portfolio Settings in Customizer
 *
 * @package Bold_Photography
 */

/**
 * Add portfolio options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bold_photography_portfolio_options( $wp_customize ) {
	// Add note to Jetpack Portfolio Section
	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_jetpack_portfolio_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Bold_Photography_Note_Control',
			'label'             => sprintf( esc_html__( 'For Portfolio Options for Bold Photography Theme, go %1$shere%2$s', 'bold-photography' ),
				 '<a href="javascript:wp.customize.section( \'bold_photography_portfolio\' ).focus();">',
				 '</a>'
			),
			'section'           => 'jetpack_portfolio',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	$wp_customize->add_section( 'bold_photography_portfolio', array(
			'panel'    => 'bold_photography_theme_options',
			'title'    => esc_html__( 'Portfolio', 'bold-photography' ),
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
	        'name'              => 'bold_photography_portfolio_jetpack_note',
	        'sanitize_callback' => 'sanitize_text_field',
	        'custom_control'    => 'Bold_Photography_Note_Control',
	        'active_callback'   => 'bold_photography_is_ect_portfolio_inactive',
	        /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
	        'label'             => sprintf( esc_html__( 'For Portfolio, install %1$sEssential Content Types%2$s Plugin with Portfolio Type Enabled', 'bold-photography' ),
	            '<a target="_blank" href="' . esc_url( $install_url ) . '">',
	            '</a>'

	        ),
	       'section'            => 'bold_photography_portfolio',
	        'type'              => 'description',
	        'priority'          => 1,
	    )
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_portfolio_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'bold_photography_sanitize_select',
			'active_callback'   => 'bold_photography_is_ect_portfolio_active',
			'choices'           => bold_photography_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'bold-photography' ),
			'section'           => 'bold_photography_portfolio',
			'type'              => 'select',
		)
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_portfolio_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Bold_Photography_Note_Control',
			'active_callback'   => 'bold_photography_is_portfolio_active',
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'bold-photography' ),
				 '<a href="javascript:wp.customize.control( \'jetpack_portfolio_title\' ).focus();">',
				 '</a>'
			),
			'section'           => 'bold_photography_portfolio',
			'type'              => 'description',
		)
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_portfolio_number',
			'default'           => 6,
			'sanitize_callback' => 'bold_photography_sanitize_number_range',
			'active_callback'   => 'bold_photography_is_portfolio_active',
			'label'             => esc_html__( 'Number of items to show', 'bold-photography' ),
			'section'           => 'bold_photography_portfolio',
			'type'              => 'number',
			'input_attrs'       => array(
				'style'             => 'width: 100px;',
				'min'               => 0,
			),
		)
	);

	$number = get_theme_mod( 'bold_photography_portfolio_number', 5 );

	for ( $i = 1; $i <= $number ; $i++ ) {

		//for CPT
		bold_photography_register_option( $wp_customize, array(
				'name'              => 'bold_photography_portfolio_cpt_' . $i,
				'sanitize_callback' => 'bold_photography_sanitize_post',
				'active_callback'   => 'bold_photography_is_portfolio_active',
				'label'             => esc_html__( 'Portfolio', 'bold-photography' ) . ' ' . $i ,
				'section'           => 'bold_photography_portfolio',
				'type'              => 'select',
				'choices'           => bold_photography_generate_post_array( 'jetpack-portfolio' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'bold_photography_portfolio_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'bold_photography_is_portfolio_active' ) ) :
	/**
	* Return true if portfolio is active
	*
	* @since Bold Photography 1.0
	*/
	function bold_photography_is_portfolio_active( $control ) {
		$enable = $control->manager->get_setting( 'bold_photography_portfolio_option' )->value();

        //return true only if previwed page on customizer matches the type of content option selected
        return ( bold_photography_is_ect_portfolio_active( $control ) &&  bold_photography_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'bold_photography_is_ect_portfolio_inactive' ) ) :
    /**
    *
    * @since Bold Photography 1.0
    */
    function bold_photography_is_ect_portfolio_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;

if ( ! function_exists( 'bold_photography_is_ect_portfolio_active' ) ) :
    /**
    *
    * @since Bold Photography 1.0
    */
    function bold_photography_is_ect_portfolio_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;
