<?php
/**
	* Template Name: News
 */

get_header();

	?><main id="primary" class="site-main" role="main"> <?php


		$args = array(
			'post_type' => 'post'
		);
		$q = new wp_query( $args );

		if ( $q->have_posts() ) :

			while ( $q->have_posts() ) : $q->the_post();

				get_template_part( 'template-parts/content-archive');

			endwhile;

			fo_pagination();

		endif;
	?> </main> <?php

get_sidebar();
get_footer();