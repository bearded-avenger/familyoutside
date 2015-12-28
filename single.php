<?php
/**
 * The template for displaying all single hike posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Family_Outside
 */

get_header(); ?>

	<main id="primary" class="site-main" role="main">
		<?php
		while ( have_posts() ) : the_post();

			if ( 'post' == get_post_type() ){
				the_title( '<h2 class="object-mast--title">','</h2>' );
				family_outside_posted_on();
			}

			get_template_part( 'template-parts/content' );

			the_post_navigation();

		endwhile; // End of the loop.
		?>

	</main>

<?php
get_sidebar();
get_footer();