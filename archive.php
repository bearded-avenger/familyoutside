<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Family_Outside
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main facetwp-template archive-page" role="main">

		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content-archive');

			endwhile;

			if ( ( 'hikes' == get_post_type() || 'reviews' == get_post_type() ) && class_exists('FacetWP') ) {

				echo facetwp_display( 'pager' );

			} else {

				the_posts_navigation();
			}

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
