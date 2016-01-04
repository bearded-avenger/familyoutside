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
				© 2016 A Family Outside
			</div>
		</div>
	</footer>

</div>

<?php wp_footer();?>
<script async="" src="//platform.twitter.com/widgets.js"></script>
<script async="" src="//connect.facebook.net/en_US/all.js"></script>
<?php if ( 'hikes' == get_post_type()  && is_single() ): ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmZRRKW006CPNupNCPJx1jfVfdHiP3QvI&callback=initMap"async defer></script>
<?php endif;?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-38255798-17', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
