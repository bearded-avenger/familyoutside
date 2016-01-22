<?php

/**
*
*	Class responsible for front-end submissions
*
*/

class foSubmissions {

	function __construct(){

		add_action('wp_ajax_process_submission', array($this,'process_submission'));
	}

	public static function form(){

		$nonce = wp_create_nonce('process-submission');

		?>
		<div class="fo-submission-form-wrap">
			<div id="fo-submission-results"></div>
			<form id="fo-submission" method="post" enctype="multipart/form-data">

				<div class="fo-submission-section">

					<legend>1. Hike Information</legend>
					<!-- Title -->
					<div class="form-group">
					    <label for="post-title">Hike Title</label>
					    <input type="text" class="form-control" id="post-title" name="post-title" placeholder="Post Title" required>
					</div>

					<!-- Content -->
					<div class="form-group">
					    <label for="post-content">Hike Content</label>
					    <textarea rows="5" class="form-control" id="post-content" name="post-content" placeholder="Post Content" required></textarea>
					</div>

				</div>

				<div class="fo-submission-section">

					<legend>2. Hike Data</legend>

					<!-- Ages -->
					<div class="form-group">
				    	<label for="hike-age">Hike Ages</label>
				    	<div class="select">
				    		<select name="hike-age" id="hike-age">
				    			<option value="4-and-up">Over 4</option>
				    			<option value="8-and-up">Over 8</option>
				    			<option value="12-and-up">Over 12</option>
				    			<option value="16-and-up">Over 16</option>
				    		</select>
				    	</div>
				    </div>

					<!-- Difficulty -->
					<div class="form-group">
				    	<label for="hike-difficulty">Hike Difficulty</label>
				    	<div class="select">
				    		<select name="hike-difficulty" id="hike-difficulty">
				    			<option value="easy">Easy</option>
				    			<option value="moderate">Moderate</option>
				    			<option value="moderately-strenuous">Moderately Strenuous</option>
				    			<option value="strenuous">Strenuous</option>
				    		</select>
				    	</div>
				    </div>

					<!-- Rating -->
					<div class="form-group">
				    	<label for="hike-rating">Hike Rating</label>
				    	<div class="select">
				    		<select name="hike-rating" id="hike-rating">
				    			<option value="one-star">One Star</option>
				    			<option value="two-star">Two Star</option>
				    			<option value="three-star">Three Star</option>
				    			<option value="four-star">Four Star</option>
				    			<option value="five-star">Five Star</option>
				    		</select>
				    	</div>
				    </div>

				    <!-- Hike City and State -->
					<div class="form-inline form-group">
					  	<div class="form-group">
					    	<label for="hike-city">Hike City</label>
					    	<input type="text" class="form-control" id="hike-city" name="hike-city" placeholder="City">
					  	</div>
					  	<div class="form-group">
					    	<label for="hike-state">Hike State</label>
					    	<input type="text" class="form-control" id="hike-state" name="hike-state" placeholder="State">
					  	</div>
					</div>

				</div>

				<!-- Hike Data -->
				<div class="fo-submission-section">

					<legend>3. Hike Metadata</legend>

					<!-- Length -->
					<div class="form-group">
					    <label for="hike-length">Hike Length</label>
					    <input type="text" class="form-control" id="hike-length" name="hike-length" placeholder="Length of Hike" required>
					</div>

					<!-- Time -->
					<div class="form-group">
					    <label for="hike-time">Time to Complete Hike (in minutes)</label>
					    <input type="text" class="form-control" id="hike-time" name="hike-time" placeholder="Time (in minutes)" required>
					</div>

					<!-- GPS Coords -->
					<div class="form-group">
					    <label for="hike-gps-coords">GPS Coordinates of Trail Head</label>
					    <input type="text" class="form-control" id="hike-gps-coords" name="hike-gps-coords" placeholder="GPS Coordinates of Trail Head" required>
					</div>

					<!-- Location Description-->
					<div class="form-group">
					    <label for="hike-description">Location Description</label>
					    <textarea rows="3" class="form-control" id="hike-description" name="hike-description" placeholder="Location Description" required></textarea>
					</div>

				</div>

			    <!-- Images -->
			    <div class="fo-submission-section">

			    	<div class="media-upload--progress hide"><div class="media-upload--bar"></div ><div class="media-upload--percent">0%</div ></div>

			    	<legend>4. Hike Images</legend>

					<div class="form-group">
				    	<label class="file">
						  	<input type="file" name="post-images[]" id="post-image" aria-label="File browser example" multiple="multiple">
						  	<span class="file-custom"></span>
						</label>
					</div>

				</div>

				<div class="form-bottom">
					<input type="submit" class="btn btn-primary" value="Submit">
					<input type="hidden" name="action" value="process_submission">
					<input type="hidden" name="nonce" value="<?php echo $nonce;?>">
				</div>
			</form>
		</div>
		<?php
	}

	function process_submission(){

		if( !is_user_logged_in() )
			return;

		if( isset( $_POST['action'] ) && 'process_submission' == $_POST['action'] ) {

			if ( wp_verify_nonce( $_POST['nonce'], 'process-submission' ) ) {

    			$title 			= isset( $_POST['post-title'] ) ? $_POST['post-title'] : false;
    			$content 		= isset( $_POST['post-content'] ) ? $_POST['post-content'] : false;

    			// categories
    			$age 			= isset( $_POST['hike-age'] ) ? sanitize_text_field( $_POST['hike-age'] ) : false;
    			$difficulty 	= isset( $_POST['hike-difficulty'] ) ? sanitize_text_field( $_POST['hike-difficulty'] ) : false;
    			$rating 		= isset( $_POST['hike-rating'] ) ? sanitize_text_field( $_POST['hike-rating'] ) : false;
    			$city 			= isset( $_POST['hike-city'] ) ? sanitize_text_field( $_POST['hike-city'] ) : false;
    			$state 			= isset( $_POST['hike-state'] ) ? sanitize_text_field( $_POST['hike-state'] ) : false;

    			// post meta
    			$length 		= isset( $_POST['hike-length'] ) ? sanitize_text_field( $_POST['hike-length'] ) : false;
    			$time 			= isset( $_POST['hike-time'] ) ? sanitize_text_field( $_POST['hike-time'] ) : false;
    			$gps_coords 	= isset( $_POST['hike-gps-coords'] ) ? sanitize_text_field( $_POST['hike-gps-coords'] ) : false;
    			$location_desc 	= isset( $_POST['hike-description'] ) ? sanitize_text_field( $_POST['hike-description'] ) : false;

				$args = array(
				  	'post_title'    => wp_strip_all_tags( $title ),
				  	'post_content'  => self::fo_sanitize_content( $content ),
				  	'post_status'   => 'draft',
				  	'post_type'	  	=> 'hikes'
				);
				$post_id = wp_insert_post( $args );

				if ( is_wp_error( $post_id ) ) {

					wp_send_json_error();

				} else {

					// Categories
					wp_set_object_terms( absint( $post_id ), $age, 'hike_ages', true );
					wp_set_object_terms( absint( $post_id ), $difficulty, 'hike_difficulty', true );
					wp_set_object_terms( absint( $post_id ), $rating, 'hike_rating', true );

					// set state
					$parent = wp_set_object_terms( absint( $post_id ), $state, 'hike_location', true );

					// set city
					// @todo there's some weird bug where the slug is coming out as city-state instead of just city
					$child = wp_insert_term( $city, 'hike_location', array( 'parent'=> $parent[0], 'slug' => strtolower( $city ) ) );

					// Post Meta
					update_post_meta( $post_id, '_hike_length', $length );
					update_post_meta( $post_id, '_hike_time', $time );
					update_post_meta( $post_id, '_hike_location', $gps_coords );
					update_post_meta( $post_id, '_hike_location_desc', $location_desc );

					if ( $_FILES ) {

						$files = $_FILES['post-images'];

						foreach ( $files['name'] as $key => $value ) {

							if ( $files['name'][$key] ) {

								$file = array(
									'name'     => $files['name'][$key],
									'type'     => $files['type'][$key],
									'tmp_name' => $files['tmp_name'][$key],
									'error'    => $files['error'][$key],
									'size'     => $files['size'][$key]
								);

								$_FILES = array('post-images' => $file);

								foreach ( $_FILES as $file => $array ) {

									if( getimagesize( $array['tmp_name'] ) ){

								        $newupload = self::insert_attachment( $file, $post_id);

								    }

								}
							}
						}
					}
				}


				wp_send_json_success();

			} else {

				wp_send_json_error();
			}

		} else {

			wp_send_json_error();

		}
	}

	public static function insert_attachment( $file_handler, $post_id ) {

	  	if ( $_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK ) __return_false();

	  	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	  	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	  	require_once(ABSPATH . "wp-admin" . '/includes/media.php');

	  	$attach_id = media_handle_upload( $file_handler, $post_id );

	  	return $attach_id;
	}

	/**
	*	Used on the front end to properly escape attributes where users have control over what input is entered
	*	as well as through a callback upon saving in the backend
	*
	*	@since 1.0
	*	@return a sanitized string
	*/
	public static function fo_sanitize_content( $input = '' ) {

		// bail if no input
		if ( empty( $input ) )
			return;

		// setup our array of allowed content to pass
		$allowed_html = array(
			'a' 			=> array(
			    'href' 		=> array(),
			    'title' 	=> array(),
			    'rel'		=> array(),
			    'target'	=> array(),
			    'name' 		=> array()
			),
			'img'			=> array(
				'src' 		=> array(),
				'alt'		=> array(),
				'title'		=> array()
			),
			'p'				=> array(),
			'br' 			=> array(),
			'em' 			=> array(),
			'strong' 		=> array()
		);

		$out = wp_kses( $input, $allowed_html );

		return $out;
	}
}
new foSubmissions;