<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Family_Outside
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">

	<?php if ( ( is_post_type_archive( array('hikes','reviews') ) || is_author() ) && class_exists('FacetWP') ): ?>
		<div class="widget-area--inner">
			<?php

				if ( is_post_type_archive('hikes') || is_author() ) {

					echo '<h5 class="filter-title">Hike Difficulty</h5>';
					echo facetwp_display( 'facet', 'difficulty' );

					echo '<h5 class="filter-title">Hike Rating</h5>';
					echo facetwp_display( 'facet', 'hike_rating' );

				}

				if ( is_post_type_archive('reviews') || is_author() ) {

					echo '<h5 class="filter-title">Product Rating</h5>';
					echo facetwp_display( 'facet', 'product_rating' );
				}
			?>
		</div>
	<?php endif; ?>
	<div class="widget-area--ads">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</aside><!-- #secondary -->
