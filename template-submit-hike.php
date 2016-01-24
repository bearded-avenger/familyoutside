<?php
/**
	* Template Name: Submit Hike
 */

get_header(); ?>

	<main id="primary" class="site-main site-submit-hike" role="main">

		<?php if ( is_user_logged_in() ): ?>

			<header class="page-header">
				<?php
					the_title( '<h2 class="page-title">', '</h2>' );
				?>
			</header>

			<?php echo foSubmissions::form();?>
		<?php endif; ?>

	</main>

<?php
get_sidebar('hike-submission');
get_footer();
