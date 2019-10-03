<?php
/**
 * The template used for displaying testimonial on front page
 *
 * @package Bold_Photography
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
		<?php bold_photography_post_thumbnail( 'bold-photography-testimonial', 'html', true, false ); ?>

		<div class="entry-container">
				<div class="entry-content">
					<?php the_excerpt(); ?>
				</div>
			
			<?php $position = get_post_meta( get_the_id(), 'ect_testimonial_position', true ); ?>

			<?php if ( $position ) : ?>
					<header class="entry-header">
						<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
						<?php if ( $position ) : ?>
							<p class="entry-meta"><span class="position">
								<?php echo esc_html( $position ); ?></span>
							</p>
						<?php endif; ?>
					</header>
			<?php endif;?>
		</div><!-- .entry-container -->	
	</div><!-- .hentry-inner -->
</article>
