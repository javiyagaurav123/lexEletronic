<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bold_Photography
 */

$sidebar = bold_photography_get_sidebar_id();

if ( '' === $sidebar ) {
    return;
}
?>

<aside id="secondary" class="widget-area sidebar">
	<?php dynamic_sidebar( $sidebar ); ?>
</aside><!-- #secondary -->
