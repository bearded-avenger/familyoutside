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

	<?php if ( ( is_post_type_archive( array('hikes','reviews') ) || is_author() || is_page_template('template-hikes-map.php') || is_page_template('template-news.php') ) && class_exists('FacetWP') ): ?>

		<?php if ( is_page_template('template-hikes-map.php') || is_post_type_archive('hikes') ) { ?>
			<ul class="filter-view">
				<li class="filter-view--list">
					<a href="/hikes"><i class="fo-icon fo-icon-list"></i>List View</a>
				</li>
				<li class="filter-view--map">
					<a href="/hikes-map"><i class="fo-icon fo-icon-map"></i>Map View</a>
				</li>
			</ul>
		<?php } ?>
		<div class="widget-area--inner">

			<?php

				if ( is_post_type_archive('hikes') || is_author() || is_page_template('template-hikes-map.php') ) {

					if ( is_page_template('template-hikes-map.php') ) {

						echo '<h5 class="filter-title">Hike Proximity</h5>';
		 				echo facetwp_display( 'facet', 'location' );

					}

					echo '<h5 class="filter-title">Hike Difficulty</h5>';
					echo facetwp_display( 'facet', 'difficulty' );

					echo '<h5 class="filter-title">Hike Rating</h5>';
					echo facetwp_display( 'facet', 'hike_rating' );

				}

				if ( is_post_type_archive('reviews') || is_author() ) {

					echo '<h5 class="filter-title">Product Rating</h5>';
					echo facetwp_display( 'facet', 'product_rating' );
				}

				if ( is_page_template('template-news.php') ){

					echo '<h5 class="filter-title">Article Categories</h5>';
					echo facetwp_display( 'facet', 'categories' );
				}
			?>
		</div>
	<?php endif; ?>
	<div class="widget-area--ads">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</aside><!-- #secondary -->
