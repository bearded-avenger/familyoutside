<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Family_Outside
 */

?>

	</div><!-- #content -->

	<?php if ( ('hikes' == get_post_type() || 'reviews' == get_post_type() ) && is_single() ) {
		get_template_part('template-parts/object-summary');

	}
	?>

	<footer id="colophon" class="footer" role="contentinfo">
		<div class="container">
			<?php if ( is_active_sidebar( 'sidebar-2' ) ) {
				dynamic_sidebar( 'sidebar-2' );
			} ?>
			<div class="byline">
				C 2016 A Family Outside
			</div>
		</div>
	</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
