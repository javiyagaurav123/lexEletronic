<?php
/**
 * Reset Theme Options, Footer Options, Section Sorter Options, Font Family Options
 *
 * @package Vogue
 */

if ( ! class_exists( 'Bold_Photography_Customizer_Reset' ) ) {
	/**
	 * Adds Reset button to customizer
	 */
	final class Bold_Photography_Customizer_Reset {
		/**
		 * @var Bold_Photography_Customizer_Reset
		 */
		private static $instance = null;

		/**
		 * @var WP_Customize_Manager
		 */
		private $wp_customize;

		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		private function __construct() {
			add_action( 'customize_controls_print_footer_scripts', array( $this, 'customize_controls_print_scripts' ) );
			add_action( 'wp_ajax_customizer_reset', array( $this, 'ajax_customizer_reset' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ) );
		}

		public function customize_controls_print_scripts() {
			wp_enqueue_script( 'bold-photography-customizer-reset', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/customizer-reset.min.js', array( 'jquery' ), '20190207' );
			
			wp_localize_script( 'bold-photography-customizer-reset', 'boldPhotographyCustomizerReset', array(
				'reset'          => esc_html__( 'Reset', 'bold-photography' ),
				'confirm'        => esc_html__( "Caution: Reset all settings to default. Process is irreversible.", 'bold-photography' ),
				'nonce'          => array(
					'reset' => wp_create_nonce( 'bold-photography-customizer-reset' ),
				),
				'resetSection'   => esc_html__( 'Reset section', 'bold-photography' ),
				'confirmSection' => esc_html__( "Caution: Reset section settings to default. Process is irreversible.", 'bold-photography' ),
			) );
		}

		/**
		 * Store a reference to `WP_Customize_Manager` instance
		 *
		 * @param $wp_customize
		 */
		public function customize_register( $wp_customize ) {
			$this->wp_customize = $wp_customize;
		}

		public function ajax_customizer_reset() {
			if ( ! $this->wp_customize->is_preview() ) {
				wp_send_json_error( 'not_preview' );
			}

			if ( ! check_ajax_referer( 'bold-photography-customizer-reset', 'nonce', false ) ) {
				wp_send_json_error( 'invalid_nonce' );
			}

			if ( 'all' === $_POST['section'] ) {
				$this->reset_customizer();
			}

			wp_send_json_success();
		}

		public function reset_customizer() {
			$settings = $this->wp_customize->settings();

			// remove theme_mod settings registered in customizer
			foreach ( $settings as $setting ) {
				if ( 'theme_mod' == $setting->type ) {
					remove_theme_mod( $setting->id );
				}
			}
		}
	}
}

Bold_Photography_Customizer_Reset::get_instance();
