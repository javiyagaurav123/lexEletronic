<?php
/**
 * Footer Options.
 *
 * @package Wishlist
 */

// Footer Section.
$wp_customize->add_section( 'section_footer',
	array(
		'title'      => esc_html__( 'Footer', 'wishlist' ),
		'priority'   => 100,
		'panel'      => 'theme_option_panel',
	)
);

// Setting enable_social_icons.
$wp_customize->add_setting( 'theme_options[enable_social_icons]',
	array(
		'default'           => $default['enable_social_icons'],
		'sanitize_callback' => 'wishlist_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[enable_social_icons]',
	array(
		'label'    			=> esc_html__( 'Enable Social Icons', 'wishlist' ),
		'description'       => esc_html__( '(Go to Appearance >> Menus, create menu and assign it to Social Links)', 'wishlist' ),
		'section'  			=> 'section_footer',
		'type'     			=> 'checkbox',
		'priority' 			=> 100,
	)
);

// Setting enable_goto_top.
$wp_customize->add_setting( 'theme_options[enable_goto_top]',
	array(
		'default'           => $default['enable_goto_top'],
		'sanitize_callback' => 'wishlist_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[enable_goto_top]',
	array(
		'label'    			=> esc_html__( 'Enable Goto Top', 'wishlist' ),
		'section'  			=> 'section_footer',
		'type'     			=> 'checkbox',
		'priority' 			=> 100,
	)
);

// Setting copyright_text.
$wp_customize->add_setting( 'theme_options[copyright_text]',
	array(
		'default'           => $default['copyright_text'],
		'sanitize_callback' => 'wishlist_sanitize_textarea',
	)
);
$wp_customize->add_control( 'theme_options[copyright_text]',
	array(
		'label'    => esc_html__( 'Copyright Text', 'wishlist' ),
		'section'  => 'section_footer',
		'type'     => 'textarea',
		'priority' => 100,
	)
);