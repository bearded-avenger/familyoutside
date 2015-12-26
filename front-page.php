<?php
get_header();

	get_template_part('template-parts/featured-posts');?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php

			$args = array(
				'post_type' 	=> array('hikes', 'reviews', 'post'),
				'post_status'	=> 'publish',
				'post__not_in'	=> fo_get_featured_ids()
			);
			$q = new wp_query( $args );

			if ( $q->have_posts() ) :

				while ( $q->have_posts() ) : $q->the_post();

					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;

				the_posts_navigation();

			endif;
		?>

		</main>
	</div>

<?php
get_footer();
