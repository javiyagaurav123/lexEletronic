<?php
/**
 * Header Media Options
 *
 * @package Bold_Photography
 */

/**
 * Add Header Media options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bold_photography_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'bold-photography' );

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_header_media_option',
			'default'           => 'disable',
			'sanitize_callback' => 'bold_photography_sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'bold-photography' ),
				'exclude-home'           => esc_html__( 'Excluding Homepage', 'bold-photography' ),
				'exclude-home-page-post' => esc_html__( 'Excluding Homepage, Page/Post Featured Image', 'bold-photography' ),
				'entire-site'            => esc_html__( 'Entire Site', 'bold-photography' ),
				'entire-site-page-post'  => esc_html__( 'Entire Site, Page/Post Featured Image', 'bold-photography' ),
				'pages-posts'            => esc_html__( 'Pages and Posts', 'bold-photography' ),
				'disable'                => esc_html__( 'Disabled', 'bold-photography' ),
			),
			'label'             => esc_html__( 'Enable on', 'bold-photography' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	/*Overlay Option for Header Media*/
	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_header_media_image_opacity',
			'default'           => '0',
			'sanitize_callback' => 'bold_photography_sanitize_number_range',
			'label'             => esc_html__( 'Header Media Overlay', 'bold-photography' ),
			'section'           => 'header_image',
			'type'              => 'number',
			'input_attrs'       => array(
				'style' => 'width: 60px;',
				'min'   => 0,
				'max'   => 100,
			),
		)
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_header_media_text_alignment',
			'default'           => 'text-align-left',
			'sanitize_callback' => 'bold_photography_sanitize_select',
			'choices'           => array(
				'text-align-center' => esc_html__( 'Center', 'bold-photography' ),
				'text-align-right'  => esc_html__( 'Right', 'bold-photography' ),
				'text-align-left'   => esc_html__( 'Left', 'bold-photography' ),
			),
			'label'             => esc_html__( 'Text Alignment', 'bold-photography' ),
			'section'           => 'header_image',
			'type'              => 'radio',
		)
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_header_media_content_alignment',
			'default'           => 'content-align-left',
			'sanitize_callback' => 'bold_photography_sanitize_select',
			'choices'           => array(
				'content-align-center' => esc_html__( 'Center', 'bold-photography' ),
				'content-align-right'  => esc_html__( 'Right', 'bold-photography' ),
				'content-align-left'   => esc_html__( 'Left', 'bold-photography' ),
			),
			'label'             => esc_html__( 'Content Alignment', 'bold-photography' ),
			'section'           => 'header_image',
			'type'              => 'radio',
		)
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_header_media_logo',
			'sanitize_callback' => 'esc_url_raw',
			'custom_control'    => 'WP_Customize_Image_Control',
			'label'             => esc_html__( 'Header Media Logo', 'bold-photography' ),
			'section'           => 'header_image',
		)
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_header_media_logo_option',
			'default'           => 'homepage',
			'sanitize_callback' => 'bold_photography_sanitize_select',
			'active_callback'   => 'bold_photography_is_header_media_logo_active',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'bold-photography' ),
				'entire-site'            => esc_html__( 'Entire Site', 'bold-photography' ) ),
			'label'             => esc_html__( 'Enable Header Media logo on', 'bold-photography' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_header_media_title',
			'sanitize_callback' => 'wp_kses_post',
			'default'           => esc_html__( 'Bring your creativity to life', 'bold-photography' ),
			'label'             => esc_html__( 'Header Media Title', 'bold-photography' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_header_media_text',
			'sanitize_callback' => 'wp_kses_post',
			'default'           => esc_html__( 'A camera that puts a world of possibilities at your fingertips', 'bold-photography' ),
			'label'             => esc_html__( 'Site Header Text', 'bold-photography' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_header_media_url',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'bold-photography' ),
			'section'           => 'header_image',
		)
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_header_media_url_text',
			'default'           => esc_html__( 'View More', 'bold-photography' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'bold-photography' ),
			'section'           => 'header_image',
		)
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_header_url_target',
			'sanitize_callback' => 'bold_photography_sanitize_checkbox',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'bold-photography' ),
			'section'           => 'header_image',
			'custom_control'    => 'Bold_Photography_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'bold_photography_header_media_options' );

/** Active Callback Functions */

if ( ! function_exists( 'bold_photography_is_header_media_logo_active' ) ) :
	/**
	* Return true if header logo is active
	*
	* @since Bold Photography 1.0
	*/
	function bold_photography_is_header_media_logo_active( $control ) {
		$logo = $control->manager->get_setting( 'bold_photography_header_media_logo' )->value();
		if ( '' != $logo ) {
			return true;
		} else {
			return false;
		}
	}
endif;
