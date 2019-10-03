<?php
/**
 * Theme Options
 *
 * @package Bold_Photography
 */

/**
 * Add theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bold_photography_theme_options( $wp_customize ) {
	$wp_customize->add_panel( 'bold_photography_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'bold-photography' ),
		'priority' => 130,
	) );

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_latest_posts_title',
			'default'           => esc_html__( 'News', 'bold-photography' ),
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Latest Posts Title', 'bold-photography' ),
			'section'           => 'bold_photography_theme_options',
		)
	);

	// Layout Options
	$wp_customize->add_section( 'bold_photography_layout_options', array(
		'title' => esc_html__( 'Layout Options', 'bold-photography' ),
		'panel' => 'bold_photography_theme_options',
		)
	);

	/* Default Layout */
	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_default_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'bold_photography_sanitize_select',
			'label'             => esc_html__( 'Default Layout', 'bold-photography' ),
			'section'           => 'bold_photography_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'bold-photography' ),
				'no-sidebar'            => esc_html__( 'No Sidebar', 'bold-photography' ),
			),
		)
	);

	/* Homepage/Archive Layout */
	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_homepage_archive_layout',
			'default'           => 'no-sidebar',
			'sanitize_callback' => 'bold_photography_sanitize_select',
			'label'             => esc_html__( 'Homepage/Archive Layout', 'bold-photography' ),
			'section'           => 'bold_photography_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'bold-photography' ),
				'no-sidebar'            => esc_html__( 'No Sidebar', 'bold-photography' ),
			),
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'bold_photography_excerpt_options', array(
		'panel'     => 'bold_photography_theme_options',
		'title'     => esc_html__( 'Excerpt Options', 'bold-photography' ),
	) );

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_excerpt_length',
			'default'           => '20',
			'sanitize_callback' => 'absint',
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 200,
				'step'  => 5,
				'style' => 'width: 60px;',
			),
			'label'    => esc_html__( 'Excerpt Length (words)', 'bold-photography' ),
			'section'  => 'bold_photography_excerpt_options',
			'type'     => 'number',
		)
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_excerpt_more_text',
			'default'           => esc_html__( 'Continue reading...', 'bold-photography' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Read More Text', 'bold-photography' ),
			'section'           => 'bold_photography_excerpt_options',
			'type'              => 'text',
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'bold_photography_search_options', array(
		'panel'     => 'bold_photography_theme_options',
		'title'     => esc_html__( 'Search Options', 'bold-photography' ),
	) );

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_search_text',
			'default'           => esc_html__( 'Search', 'bold-photography' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Search Text', 'bold-photography' ),
			'section'           => 'bold_photography_search_options',
			'type'              => 'text',
		)
	);

	// Homepage / Frontpage Options.
	$wp_customize->add_section( 'bold_photography_homepage_options', array(
		'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'bold-photography' ),
		'panel'       => 'bold_photography_theme_options',
		'title'       => esc_html__( 'Homepage / Frontpage Options', 'bold-photography' ),
	) );

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_recent_posts_heading',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => esc_html__( 'News', 'bold-photography' ),
			'label'             => esc_html__( 'Recent Posts Heading', 'bold-photography' ),
			'section'           => 'bold_photography_homepage_options',
		)
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_static_page_heading',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'	=> 'bold_photography_is_static_page_enabled',
			'default'           => esc_html__( 'Archives', 'bold-photography' ),
			'label'             => esc_html__( 'Posts Page Header Text', 'bold-photography' ),
			'section'           => 'bold_photography_homepage_options',
		)
	);

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_front_page_category',
			'sanitize_callback' => 'bold_photography_sanitize_category_list',
			'custom_control'    => 'Bold_Photography_Multi_Cat',
			'label'             => esc_html__( 'Categories', 'bold-photography' ),
			'section'           => 'bold_photography_homepage_options',
			'type'              => 'dropdown-categories',
		)
	);

	// Pagination Options.
	$pagination_type = get_theme_mod( 'bold_photography_pagination_type', 'default' );

	$nav_desc = '';

	/**
	* Check if navigation type is Jetpack Infinite Scroll and if it is enabled
	*/
	$nav_desc = sprintf(
		wp_kses(
			__( 'For infinite scrolling, use %1$sCatch Infinite Scroll Plugin%2$s with Infinite Scroll module Enabled.', 'bold-photography' ),
			array(
				'a' => array(
					'href' => array(),
					'target' => array(),
				),
				'br'=> array()
			)
		),
		'<a target="_blank" href="https://wordpress.org/plugins/catch-infinite-scroll/">',
		'</a>'
	);

	$wp_customize->add_section( 'bold_photography_pagination_options', array(
		'description'     => $nav_desc,
		'panel'           => 'bold_photography_theme_options',
		'title'           => esc_html__( 'Pagination Options', 'bold-photography' ),
		'active_callback' => 'bold_photography_scroll_plugins_inactive'
	) );

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_pagination_type',
			'default'           => 'default',
			'sanitize_callback' => 'bold_photography_sanitize_select',
			'choices'           => bold_photography_get_pagination_types(),
			'label'             => esc_html__( 'Pagination type', 'bold-photography' ),
			'section'           => 'bold_photography_pagination_options',
			'type'              => 'select',
		)
	);

	/* Scrollup Options */
	$wp_customize->add_section( 'bold_photography_scrollup', array(
		'panel'    => 'bold_photography_theme_options',
		'title'    => esc_html__( 'Scrollup Options', 'bold-photography' ),
	) );

	bold_photography_register_option( $wp_customize, array(
			'name'              => 'bold_photography_disable_scrollup',
			'default'			=> 1,
			'sanitize_callback' => 'bold_photography_sanitize_checkbox',
			'label'             => esc_html__( 'Scroll Up', 'bold-photography' ),
			'section'           => 'bold_photography_scrollup',
			'custom_control'    => 'Bold_Photography_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'bold_photography_theme_options' );

/** Active Callback Functions */
if ( ! function_exists( 'bold_photography_scroll_plugins_inactive' ) ) :
	/**
	* Return true if infinite scroll functionality exists
	*
	* @since Bold Photography 1.0
	*/
	function bold_photography_scroll_plugins_inactive( $control ) {
		if ( ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) || class_exists( 'Catch_Infinite_Scroll' ) ) {
			// Support infinite scroll plugins.
			return false;
		}

		return true;
	}
endif;

if ( ! function_exists( 'bold_photography_is_static_page_enabled' ) ) :
	/**
	* Return true if A Static Page is enabled
	*
	* @since Bold Photography Pro 1.1.2
	*/
	function bold_photography_is_static_page_enabled( $control ) {
		$enable = $control->manager->get_setting( 'show_on_front' )->value();
		if ( 'page' === $enable ) {
			return true;
		}
		return false;
	}
endif;
