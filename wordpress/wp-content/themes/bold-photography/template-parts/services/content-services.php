<?php
/**
 * The template for displaying services posts on the front page
 *
 * @package Bold_Photography
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
		<?php bold_photography_post_thumbnail( 'post-thumbnail', 'html', true, true ); ?>

		<div class="entry-container">
			<?php
				$excerpt = get_the_excerpt();
				echo '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->';
			?>
		</div><!-- .entry-container -->
	</div> <!-- .hentry-inner -->
</article> <!-- .article -->
