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
		<?php else: ?>

			<p>Oh snap! You have to be logged in to submit a hike. <a href="#" data-toggle="modal" data-target="#modal--login">Log in</a> or <a a href="#" data-toggle="modal" data-target="#modal--create-account">create a free account</a>!</p>

		<?php endif; ?>

	</main>

<?php
get_sidebar('hike-submission');
get_footer();
