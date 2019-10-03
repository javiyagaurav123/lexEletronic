<?php
/**
 * The template for displaying testimonial items
 *
 * @package Bold_Photography
 */
?>

<?php
$number = get_theme_mod( 'bold_photography_testimonial_number', 3 );

if ( ! $number ) {
	// If number is 0, then this section is disabled
	return;
}

$args = array(
	'ignore_sticky_posts' => 1 // ignore sticky posts
);

$type = 'jetpack-testimonial';

$post_list  = array();// list of valid post/page ids

$args['post_type'] = $type;

for ( $i = 1; $i <= $number; $i++ ) {
	$post_id = '';

	$post_id =  get_theme_mod( 'bold_photography_testimonial_cpt_' . $i );
	

	if ( $post_id && '' !== $post_id ) {
		// Polylang Support.
		if ( class_exists( 'Polylang' ) ) {
			$post_id = pll_get_post( $post_id, pll_current_language() );
		}

		$post_list = array_merge( $post_list, array( $post_id ) );

	}
}

$args['post__in'] = $post_list;
$args['orderby'] = 'post__in';


$args['posts_per_page'] = $number;
$loop = new WP_Query( $args );

if ( $loop -> have_posts() ) :
	while ( $loop -> have_posts() ) :
		$loop -> the_post();

		get_template_part( 'template-parts/testimonial/content', 'testimonial' );
	endwhile;
	wp_reset_postdata();
endif;
