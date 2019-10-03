<?php
/**
 * Featured Content options
 *
 * @package Bold_Photography
 */

/**
 * Add featured content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bold_photography_featured_content_options( $wp_customize ) {
	// Add note to ECT Featured Content Section
    bold_photography_register_option( $wp_customize, array(
            'name'              => 'bold_photography_featured_content_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Bold_Photography_Note_Control',
            'label'             => sprintf( esc_html__( 'For all Featured Content Options for Bold Photography Theme, go %1$shere%2$s', 'bold-photography' ),
                '<a href="javascript:wp.customize.section( \'bold_photography_featured_content\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'featured_content',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'bold_photography_featured_content', array(
			'title' => esc_html__( 'Featured Content', 'bold-photography' ),
			'panel' => 'bold_photography_theme_options',
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

	// Add note to ECT Featured Content Section
    bold_photography_register_option( $wp_customize, array(
            'name'              => 'bold_photography_featured_content_etc_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Bold_Photography_Note_Control',
            'active_callback'   => 'bold_photography_is_ect_featured_content_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Featured Content, install %1$sEssential Content Types%2$s Plugin with Featured Content Type Enabled', 'bold-photography' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'bold_photography_featured_content',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	// Add color scheme setting and control.
	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_featured_content_option',
			'default'           => 'disabled',
			'active_callback'	=> 'bold_photography_is_ect_featured_content_active',
			'sanitize_callback' => 'bold_photography_sanitize_select',
			'choices'           => bold_photography_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'bold-photography' ),
			'section'           => 'bold_photography_featured_content',
			'type'              => 'select',
		)
	);

    bold_photography_register_option( $wp_customize, array(
            'name'              => 'bold_photography_featured_content_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Bold_Photography_Note_Control',
            'active_callback'   => 'bold_photography_is_featured_content_active',
            'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'bold-photography' ),
                 '<a href="javascript:wp.customize.control( \'featured_content_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'bold_photography_featured_content',
            'type'              => 'description',
        )
    );

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_featured_content_number',
			'default'           => 3,
			'sanitize_callback' => 'bold_photography_sanitize_number_range',
			'active_callback'   => 'bold_photography_is_featured_content_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Featured Content is changed (Max no of Featured Content is 20)', 'bold-photography' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Featured Content', 'bold-photography' ),
			'section'           => 'bold_photography_featured_content',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'bold_photography_featured_content_number', 3 );

	//loop for featured post content
	for ( $i = 1; $i <= $number ; $i++ ) {

		bold_photography_register_option( $wp_customize, array(
				'name'              => 'bold_photography_featured_content_cpt_' . $i,
				'sanitize_callback' => 'bold_photography_sanitize_post',
				'active_callback'   => 'bold_photography_is_featured_content_active',
				'label'             => esc_html__( 'Featured Content', 'bold-photography' ) . ' ' . $i ,
				'section'           => 'bold_photography_featured_content',
				'type'              => 'select',
                'choices'           => bold_photography_generate_post_array( 'featured-content' ),
			)
		);
	} // End for().

	bold_photography_register_option( $wp_customize, array(
            'name'              => 'bold_photography_featured_content_text',
            'default'           => esc_html__( 'News Archive', 'bold-photography' ),
            'sanitize_callback' => 'sanitize_text_field',
            'active_callback'   => 'bold_photography_is_featured_content_active',
            'label'             => esc_html__( 'Button Text', 'bold-photography' ),
            'section'           => 'bold_photography_featured_content',
            'type'              => 'text',
        )
    );

    bold_photography_register_option( $wp_customize, array(
            'name'              => 'bold_photography_featured_content_link',
            'sanitize_callback' => 'esc_url_raw',
            'active_callback'   => 'bold_photography_is_featured_content_active',
            'label'             => esc_html__( 'Button Link', 'bold-photography' ),
            'section'           => 'bold_photography_featured_content',
        )
    );

    bold_photography_register_option( $wp_customize, array(
            'name'              => 'bold_photography_featured_content_target',
            'sanitize_callback' => 'bold_photography_sanitize_checkbox',
            'active_callback'   => 'bold_photography_is_featured_content_active',
            'label'             => esc_html__( 'Open Link in New Window/Tab', 'bold-photography' ),
            'section'           => 'bold_photography_featured_content',
            'custom_control'    => 'Bold_Photography_Toggle_Control',
        )
    );
}
add_action( 'customize_register', 'bold_photography_featured_content_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'bold_photography_is_featured_content_active' ) ) :
	/**
	* Return true if featured content is active
	*
	* @since Bold Photography 1.0
	*/
	function bold_photography_is_featured_content_active( $control ) {
		$enable = $control->manager->get_setting( 'bold_photography_featured_content_option' )->value();


		return ( bold_photography_is_ect_featured_content_active( $control ) &&  bold_photography_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'bold_photography_is_ect_featured_content_active' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Bold Photography 1.0
    */
    function bold_photography_is_ect_featured_content_active( $control ) {
        return ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) );
    }
endif;

if ( ! function_exists( 'bold_photography_is_ect_featured_content_inactive' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Bold_Photography 1.0
    */
    function bold_photography_is_ect_featured_content_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) );
    }
endif;