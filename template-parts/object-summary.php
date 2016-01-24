<?php

/**
*	Displays a map for trail location or TLDR; for a product review
*
*/


?>
<div class="object-summary">

	<div class="container">

		<?php if ( ( 'hikes' == get_post_type() || 'activities' == get_post_type() ) && is_single() ) {

			$location = fo_get_hike_gps_location();
			$lat      = isset( $location['0'] ) ? $location['0'] : false;
			$long      = isset( $location['1'] ) ? $location['1'] : false;

			?>
			<div class="object-summary--lt">
				<h3>Get There</h3>
				<?php echo apply_filters('the_content',fo_get_hike_location_description() );?>
				<a id="hike-map--directions" href="#" class="btn btn-primary btn-xs">Get Directions</a>
			</div>
			<div class="object-summary--rt">
				<div id="hike-map" style="height:400px;width:100%;"></div>
				 <script>

					var map;
					function initMap() {

						var myLatLng = {lat: <?php echo $lat;?>, lng: <?php echo $long;?>};
						  map = new google.maps.Map(document.getElementById('hike-map'), {
						    center: myLatLng,
						    scrollwheel:false,
						    zoom: 12,
						    mapTypeId: 'terrain'
						  });
						   var marker = new google.maps.Marker({
						    position: myLatLng,
						    map: map,
						    title: 'Hello World!'
						  });
					}

				</script>
			</div>
		<?php } else { ?>
			<h3>TLDR;</h3>
			<?php echo fo_get_review_summary();?>
		<?php } ?>

	</div>

</div>