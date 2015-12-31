<?php

$args = array(
	'post_type' 		=> array('hikes', 'reviews', 'post'),
	'post__in' 			=> fo_get_featured_ids(),
	'posts_per_page' 	=> 3,
	'orderby' 			=> 'post__in'
);
$q = new wp_query( $args );

?>
<div class="featured-posts">

	<?php if ( $q->have_posts() ) : while ( $q->have_posts() ) : $q->the_post();

		$img 			= wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'featured-post-cover');
		$category 		= fo_return_type_data()['label'];
		$class 			= fo_return_type_data()['class'];

		if ( 0 == $q->current_post ) { ?>

			<div class="featured-posts--item featured-posts--top">
				<?php echo featured_posts_inner( $img, $class, $category ); ?>
			</div>

		<?php }

		if ( 1 == $q->current_post ){ ?>
			<div class="featured-posts--item featured-posts--lt">
				<?php echo featured_posts_inner( $img, $class, $category ); ?>
			</div>
		<?php }

		if  ( 2 == $q->current_post ){ ?>
			<div class="featured-posts--item featured-posts--rt">
				<?php echo featured_posts_inner( $img, $class, $category ); ?>
			</div>
		<?php }

	endwhile;endif;wp_reset_query();?>

</div>

<?php

/**
*	Builds inner html for featured posts item
*
*	@param $img array the featured image
*	@param $class string the css class
*	@param $category string the post type
*/
function featured_posts_inner( $img, $class, $category ){ ?>

	<a href="<?php echo get_permalink();?>" class="featured-posts--item__inner">
		<span class="label <?php echo sanitize_html_class( $class );?>"><?php echo esc_html( $category );?></span>
		<h3><?php echo get_the_title();?></h3>
		<div class="featured-posts--img" style="background-image:url(<?php echo esc_url( $img[0] );?>);"></div>
	</a>

<?php }