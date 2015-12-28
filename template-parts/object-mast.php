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
			<?php the_title( '<h2 class="object-mast--title">','</h2>' );?>
			<div class="object-mast--location">
				<?php echo fo_get_hike_location();?>
			</div>
		</div>
	</div>

	<div class="object-mast--gallery">
		<?php echo fo_draw_object_gallery();?>
	</div>

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
						<span><?php echo fo_get_hike_time();?></span>
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
						<span><?php echo fo_get_hike_rating();?></span>
					</li>
				</ul>
			<?php } else { ?>
				<ul class="object-mast--meta__reviews">
					<li>
						<span>Price</span>
						<span>$20</span>
					</li>
					<li>
						<span>Manufacturer</span>
						<span>$20</span>
					</li>
						<span>Category</span>
						<span>$20</span>
					</li>
					<li>
						<span>Rating</span>
						<span>$20</span>
					</li>
				</ul>
			<?php } ?>

		</div>
	</div>

</div>