<?php
get_header();

	get_template_part('template-parts/featured-posts');?>

	<main id="primary" class="site-main" role="main">

	<?php

		$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;

		$args = array(
			'post_type' 	=> array('hikes', 'reviews', 'post'),
			'post_status'	=> 'publish',
			'post__not_in'	=> fo_get_featured_ids(),
			'paged'			=> $paged
		);
		$wp_query = new wp_query( $args );

		if ( $wp_query->have_posts() ) :

			while ( $wp_query->have_posts() ) : $wp_query->the_post();

				get_template_part( 'template-parts/content-archive', get_post_format() );

			endwhile;

			fo_pagination( $wp_query );

		endif;
	?>

	</main>

<?php
get_sidebar();
get_footer();
