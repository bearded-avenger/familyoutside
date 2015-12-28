<?php

/**
*	Displays a map for trail location or TLDR; for a product review
*
*/


?>
<div class="object-summary">

	<div class="container">

		<?php if ( 'hikes' == get_post_type() ) { ?>
			<h3>Get There</h3>
			<div class="object-summary--lt">
				<?php echo fo_get_hike_location_description();?>
			</div>
			<div class="object-summary--rt">
				<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo fo_get_hike_gps_location();?>&key=AIzaSyAmZRRKW006CPNupNCPJx1jfVfdHiP3QvI" allowfullscreen></iframe>
			</div>
		<?php } else { ?>
			<h3>TLDR;</h3>
			<?php echo fo_get_review_summary();?>
		<?php } ?>

	</div>

</div>