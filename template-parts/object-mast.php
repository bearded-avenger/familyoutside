<?php

/**
*	Displays object gallery with fallback to featured iamge if no gallery images
*	and the product meta bar
*
*/


?>
<div class="object-mast">

	<div class="object-mast--header">
		<div class="container">
			<div class="object-mast--lt">
				<?php the_title( '<h2 class="object-mast--title">','</h2>' );?>
				<?php if ( 'hikes' == get_post_type() ){ ?>
					<div class="object-mast--location"><?php echo fo_get_hike_location();?></div>
				<?php } else { ?>
					<p class="entry--meta">
						<?php family_outside_posted_on(); ?>
					</p>
				<?php } ?>
			</div>
			<div class="object-mast--rt">
				<?php echo fo_social_sharing();?>
			</div>
		</div>
	</div>

	<?php echo fo_draw_object_gallery();?>

	<?php if ( 'activities' !== get_post_type() ): ?>

	<div class="object-mast--meta">
		<div class="container">

			<?php if ( 'hikes' == get_post_type() ) { ?>
				<ul class="object-mast--meta__hikes">
					<li>
						<span>Length:</span>
						<span><?php echo fo_get_hike_length();?> mile</span>
					</li>
					<li>
						<span>Time:</span>
						<span><?php echo fo_calculate_total_time( fo_get_hike_time() );?></span>
					</li>
					<li>
						<span>Ages:</span>
						<span><?php echo fo_get_hike_ages();?></span>
					</li>
					<li>
						<span>Difficulty:</span>
						<span><?php echo fo_get_hike_difficulty();?></span>
					</li>
					<li>
						<span>Rating:</span>
						<span><?php echo fo_get_object_rating();?></span>
					</li>
				</ul>
			<?php } else { ?>
				<ul class="object-mast--meta__reviews">
					<li>
						<span>Price:</span>
						<span>$<?php echo fo_get_review_price();?></span>
					</li>
					<li>
						<span>Manufacturer:</span>
						<span><?php echo fo_get_review_manufacturer();?></span>
					</li>
					<li>
						<span>Category:</span>
						<span><?php echo fo_get_review_category();?></span>
					</li>
					<li>
						<span>Rating:</span>
						<span><?php echo fo_get_object_rating(get_the_ID(),'product_rating');?></span>
					</li>
				</ul>
			<?php } ?>

		</div>
	</div>

	<?php endif; ?>

</div>