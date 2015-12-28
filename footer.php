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
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'family-outside' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'family-outside' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'family-outside' ), 'family-outside', '<a href="http://nickhaskins.com" rel="designer">Nick Haskins</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
