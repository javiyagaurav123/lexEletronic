<?php
/**
 * Blog Options.
 *
 * @package Wishlist
 */

// Layout Section.
$wp_customize->add_section( 'section_layout',
	array(
		'title'      => esc_html__( 'Blog/Archive', 'wishlist' ),
		'priority'   => 100,
		'panel'      => 'theme_option_panel',
	)
);

// Setting global_layout.
$wp_customize->add_setting( 'theme_options[global_layout]',
	array(
		'default'           => $default['global_layout'],
		'sanitize_callback' => 'wishlist_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[global_layout]',
	array(
		'label'    => esc_html__( 'Default Sidebar Layout', 'wishlist' ),
		'section'  => 'section_layout',
		'type'     => 'radio',
		'priority' => 100,
		'choices'  => array(
				'left-sidebar'  => esc_html__( 'Sidebar / Content', 'wishlist' ),
				'right-sidebar' => esc_html__( 'Content / Sidebar', 'wishlist' ),
				'no-sidebar'    => esc_html__( 'Content (no sidebars)', 'wishlist' ),
			),
	)
);

// Setting excerpt_length.
$wp_customize->add_setting( 'theme_options[excerpt_length]',
	array(
		'default'           => $default['excerpt_length'],
		'sanitize_callback' => 'wishlist_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'theme_options[excerpt_length]',
	array(
		'label'       => esc_html__( 'Excerpt Length', 'wishlist' ),
		'description' => esc_html__( 'in words', 'wishlist' ),
		'section'     => 'section_layout',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array( 'min' => 1, 'max' => 200, 'style' => 'width: 55px;' ),
	)
);

// Setting readmore_text.
$wp_customize->add_setting( 'theme_options[readmore_text]',
	array(
		'default'           => $default['readmore_text'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[readmore_text]',
	array(
		'label'    => esc_html__( 'Read More Text', 'wishlist' ),
		'section'  => 'section_layout',
		'type'     => 'text',
		'priority' => 100,
	)
);