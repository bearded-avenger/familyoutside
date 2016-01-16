<?php
/**
	* Template Name: Hikes Map
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main archive-page" role="main">

			<script>
				(function($) {
				    var map;
				    var activeMarker = null;
				    var markersArray = [];
				    $(function() {
				        map = new google.maps.Map(document.getElementById('map'), {
				            center: {lat: 36.2, lng: -81.6},
				            mapTypeId: 'terrain',
				            scrollwheel: false,
				            zoom: 9
				        });
				    });
				    $(document).on('facetwp-loaded', function() {
				        clearOverlays();
				        $('.map-item').each(function() {
				            var lat = $(this).attr('data-latitude');
				            var lng = $(this).attr('data-longitude');
				            var distance = $(this).attr('data-distance');
				            var title = $(this).attr('data-title');
				            var marker = new google.maps.Marker({
				                map: map,
				                position: new google.maps.LatLng(
				                    parseFloat(lat),
				                    parseFloat(lng)
				                ),
				                info: new google.maps.InfoWindow({
				                    content: '<div class="map-item--window">' + '<h5>' + title + '</h5>' + ('' != distance ? '<span class="map-item--distance">'+distance+'</span>' : '' ) + $(this).html() + '</div>'
				                })
				            });
				            google.maps.event.addListener(marker, 'click', function() {
				                if (null !== activeMarker) {
				                    activeMarker.info.close();
				                }
				                marker.info.open(map, marker);
				                activeMarker = marker;
				            });
				            markersArray.push(marker);

				        });

				    });
				    // Clear markers
				    function clearOverlays() {
				        for (var i = 0; i < markersArray.length; i++) {
				            markersArray[i].setMap(null);
				        }
				        markersArray = [];
				    }
				})(jQuery);
			</script>

			 <!-- Map -->
			<div class="map--display">
	        	<div id="map" style="height:550px"></div>
	        </div>


    		<?php // echo facetwp_display( 'template', 'hikes' ); // hidden from view ?>
    		<div class="facetwp-template">
				<?php

					$q = new wp_query( array('post_type' => 'hikes', 'posts_per_page' => 100 ) );

					while ( $q->have_posts() ) : $q->the_post();

						$title 		= get_the_title( get_the_ID() );
						$distance 	= facetwp_get_distance( get_the_ID() );
						$distance 	= ( false !== $distance ) ? round( $distance, 1 ) . ' miles away' : '';
						$location 	= fo_get_hike_gps_location();
						$lat      	= isset( $location['0'] ) ? $location['0'] : false;
						$long      	= isset( $location['1'] ) ? $location['1'] : false;

						?><div class="map-item"
								style="display:none"
								data-title="<?php echo esc_attr( $title ); ?>"
								data-latitude="<?php echo $lat; ?>"
								data-longitude="<?php echo $long; ?>"
								data-distance="<?php echo $distance; ?>"
							>
							<a href="<?php echo get_permalink();?>">
								<?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail' ); ?>
								<i class="fo-icon fo-icon-link"></i>
							</a>
						</div><?php

					endwhile;
				?>
    		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

