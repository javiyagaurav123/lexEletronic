<?php
/**
 * The template for displaying services content
 *
 * @package Bold_Photography
 */
?>

<?php
$enable_content = get_theme_mod( 'bold_photography_service_option', 'disabled' );

if ( ! bold_photography_check_section( $enable_content ) ) {
	// Bail if services content is disabled.
	return;
}

$services_posts = bold_photography_get_posts( 'service' );

if ( empty( $services_posts ) ) {
	return;
}

$title    = get_option( 'ect_service_title', esc_html__( 'Services', 'bold-photography' ) );
$sub_title = get_option( 'ect_service_content' );

$classes[] = 'services-section';
$classes[] = 'section';

if ( ! $title && ! $sub_title ) {
	$classes[] = 'no-section-heading';
}
?>

<div id="services-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
<div id="services-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php if ( $title || $sub_title ) : ?>
			<div class="section-heading-wrapper">
				<?php if ( $title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $title ); ?></h2>
					</div><!-- .page-title-wrapper -->
				<?php endif; ?>

				<?php if ( $sub_title ) : ?>
					<div class="section-description-wrapper section-subtitle">
						<?php
						$sub_title = apply_filters( 'the_content', $sub_title );
						echo wp_kses_post( str_replace( ']]>', ']]&gt;', $sub_title ) );
						?>
					</div><!-- .section-description -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper services-content-wrapper layout-four">
			<?php
			foreach ( $services_posts as $post ) {
				setup_postdata( $post );

				// Include the services content template.
				get_template_part( 'template-parts/services/content-services' );
			}

			wp_reset_postdata();
			?>
		</div><!-- .services-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #services-section -->
