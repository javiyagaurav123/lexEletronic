<?php
/**
 * The main template file
 *
 * @package Theme-Vision
 * @subpackage Agama
 * @since 1.0
 */

// Do not allow direct access to the file.
if( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

    <?php if( 'left' == agama_sidebar_position() ): ?>
        <?php get_sidebar(); ?>
    <?php endif; ?>

	<div id="primary" class="site-content <?php echo Agama::bs_class(); ?>">
		<div id="content" role="main"<?php Agama_Helper::get_blog_isotope_class(); ?>>
            
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">

			<?php if ( current_user_can( 'edit_posts' ) ) : // Show a different message to a logged-in user who can add posts. ?>
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'No posts to display', 'agama' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'agama' ), admin_url( 'post-new.php' ) ); ?></p>
				</div>

			<?php else :
				// Show the default message to everyone else.
			?>
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'agama' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'agama' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			<?php endif; ?>

			</article>

		<?php endif; // end have_posts() check ?>

		</div>
		
		<?php agama_content_nav( 'nav-below' ); ?>
        
        <?php Agama_Helper::get_infinite_scroll_load_more_btn(); ?>
        
	</div>

    <?php if( 'right' == agama_sidebar_position() ): ?>
        <?php get_sidebar(); ?>
    <?php endif; ?>

<?php get_footer(); ?>
