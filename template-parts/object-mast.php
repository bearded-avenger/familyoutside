<?php

/**
*	Displays object gallery with fallback to featured iamge if no gallery images
*	and the product meta bar
*
*/


?>
<div class="object-mast">

	<div class="object-mast--gallery">
		<?php echo fo_draw_object_gallery();?>
	</div>

	<div class="object-mast--meta">

		<ul>
			<li>
				<span>Price</span>
				<span>$20</span>
			</li>
		</ul>

	</div>

</div>