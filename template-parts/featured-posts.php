<?php

$img 			= wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'featured-post-cover');
$category 		= get_the_category(get_the_ID());
$thumb 			= has_post_thumbnail() ? 'has-thumbnail' : 'no-thumbnail';

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

		if ( 0 == $q->current_post ) { ?>

			<div class="featured-posts__top">
				<?php echo get_the_title();?>
			</div>

		<?php }

		if ( 1 == $q->current_post ){ ?>
			<div class="featured-posts__lt">
				<?php echo get_the_title();?>
			</div>
		<?php }

		if  ( 2 == $q->current_post ){ ?>
			<div class="featured-posts__rt">
				<?php echo get_the_title();?>
			</div>
		<?php }

	endwhile;endif;wp_reset_query();?>

</div>