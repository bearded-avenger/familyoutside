<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Family_Outside
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( 'post' == get_post_type() ){
		the_title( '<h2 class="object-mast--title">','</h2>' );
		family_outside_posted_on();
		fo_social_sharing();
		echo '<div class="featured-image">';
			the_post_thumbnail('large');
		echo '</div>';
	} ?>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'family-outside' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'family-outside' ),
				'after'  => '</div>',
			) );

			do_action('hike_after_content');
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php family_outside_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
