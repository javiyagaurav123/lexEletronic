<?php
/**
 * Theme functions and definitions.
 *
 * Sets up the theme and provides some helper functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package Theme-Vision
 * @subpackage Agama
 */

// Do not allow direct access to the file.
if( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get Agama Core Class File
get_template_part( 'framework/class-agama-core' );

/**
 * Agama Theme Class
 *
 * @package Theme-Vision
 * @since 1.3.7
 */
final class Agama_WP_Theme extends Agama_Core {
    
    /**
     * Class Constructor
     *
     * @since 1.3.7
     */
    function __construct() {
        
        // Theme Version
        parent::$version = '1.4.51';
        
        // Development Mode
        parent::$development = false;
        
        // Parent Constructor
        parent::__construct();
        
        // Include Theme Files
        self::get_template_parts();
    }
    
    /**
     * Get Template Parts
     *
     * @since 1.3.7
     */
    static function get_template_parts() {
        get_template_part( 'framework/agama-actions' );
        get_template_part( 'framework/agama-filters' );
        get_template_part( 'framework/agama-functions' );
        get_template_part( 'framework/class-agama-plugin-activation' );
        get_template_part( 'framework/class-agama-helper' );
		get_template_part( 'framework/class-agama-slider' );
		get_template_part( 'framework/class-agama-core' );
		get_template_part( 'framework/class-agama' );
		get_template_part( 'framework/class-agama-wc' );
		get_template_part( 'framework/class-agama-breadcrumb' );
		get_template_part( 'framework/class-agama-frontpage-boxes' );
		get_template_part( 'framework/widgets/widgets' );
        get_template_part( 'framework/admin/customizer/builder/class-agama-page-builder' );
		get_template_part( 'framework/admin/admin-init' );
    }
}
new Agama_WP_Theme;

/* Omit closing PHP tag to avoid "Headers already sent" issues. */
