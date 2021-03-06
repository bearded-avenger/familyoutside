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

		if ( is_author() ): ?>

			<header class="page-header">
				<?php the_archive_title( '<h2 class="page-title">', '</h2>' ); ?>
			</header><!-- .page-header -->

		<?php endif;

		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content-archive');

			endwhile;

			if ( ( 'hikes' == get_post_type() || 'reviews' == get_post_type() || is_author() ) && class_exists('FacetWP') ) {

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
