<?php
get_header();

 	if ( 0 == get_query_var('paged') ) {

		get_template_part('template-parts/featured-posts');
	}

	?><main id="primary" class="site-main" role="main"> <?php

		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content-archive');

			endwhile;

			fo_pagination();

		endif;
	?> </main> <?php

get_sidebar();
get_footer();