<?php
/**
 * Display Header Media
 *
 * @package Bold_Photography
 */

if ( 'disable' === get_theme_mod( 'bold_photography_header_media_option', 'disable' ) ) {
	return;
}

$header_image = bold_photography_featured_overall_image();

$header_media_text = bold_photography_has_header_media_text();

if ( ( ( is_header_video_active() && has_header_video() ) || 'disable' !== $header_image ) || $header_media_text ) :
?>
<div class="custom-header header-media">
	<div class="wrapper">
		<div class="custom-header-media">
			<?php
			if ( is_header_video_active() && has_header_video() ) {
				the_custom_header_markup();
			} elseif ( 'disable' !== $header_image ) {
				echo '<div id="wp-custom-header" class="wp-custom-header"><img src="' . esc_url( $header_image ) . '"/></div>	';
			}
			?>
			<?php bold_photography_header_media_text(); ?>
		</div>
	</div><!-- .wrapper -->
	<div class="custom-header-overlay"></div><!-- .custom-header-overlay -->
</div><!-- .custom-header -->
<?php endif; ?>
