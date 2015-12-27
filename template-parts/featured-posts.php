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
		$category 		= get_post_type();

		if ( 0 == $q->current_post ) { ?>

			<div class="featured-posts--item featured-posts--top">
				<a href="<?php echo get_permalink();?>" class="featured-posts--item__inner">
					<span class="label label-primary"><?php echo $category;?></span>
					<h3><?php echo get_the_title();?></h3>
					<div class="featured-posts--img" style="background-image:url(<?php echo $img[0];?>);"></div>
				</a>
			</div>

		<?php }

		if ( 1 == $q->current_post ){ ?>
			<div class="featured-posts--item featured-posts--lt">
				<a href="<?php echo get_permalink();?>" class="featured-posts--item__inner">
					<span class="label label-primary"><?php echo $category;?></span>
					<h3><?php echo get_the_title();?></h3>
					<div class="featured-posts--img" style="background-image:url(<?php echo $img[0];?>);"></div>
				</a>
			</div>
		<?php }

		if  ( 2 == $q->current_post ){ ?>
			<div class="featured-posts--item featured-posts--rt">
				<a href="<?php echo get_permalink();?>" class="featured-posts--item__inner">
					<span class="label label-primary"><?php echo $category;?></span>
					<h3><?php echo get_the_title();?></h3>
					<div class="featured-posts--img" style="background-image:url(<?php echo $img[0];?>);"></div>
				</a>
			</div>
		<?php }

	endwhile;endif;wp_reset_query();?>

</div>