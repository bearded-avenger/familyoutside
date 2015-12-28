<?php
get_header();

	get_template_part('template-parts/featured-posts');?>

	<main id="primary" class="site-main" role="main">

	<?php

		$args = array(
			'post_type' 	=> array('hikes', 'reviews', 'post'),
			'post_status'	=> 'publish',
			'post__not_in'	=> fo_get_featured_ids()
		);
		$q = new wp_query( $args );

		if ( $q->have_posts() ) :

			while ( $q->have_posts() ) : $q->the_post();

				get_template_part( 'template-parts/content-archive', get_post_format() );

			endwhile;

			the_posts_navigation();

		endif;
	?>

	</main>

<?php
get_sidebar();
get_footer();
