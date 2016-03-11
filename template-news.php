<?php
/**
	* Template Name: News
 */

get_header();

	?><main id="primary" class="site-main" role="main"> <?php

		echo facetwp_display( 'template', 'articles' );
		echo facetwp_display( 'pager' );

	?></main> <?php

get_sidebar();
get_footer();