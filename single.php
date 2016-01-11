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

			get_template_part( 'template-parts/content' );

			if ( 'post' == get_post_type() && ( comments_open() || get_comments_number() ) ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main>

<?php
get_sidebar();
get_footer();