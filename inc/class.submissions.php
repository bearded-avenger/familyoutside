<?php

/**
*
*	Class responsible for front-end submissions
*
*/

class foSubmissions {

	function __construct(){

		add_action('wp_ajax_process_submission', array($this,'process_submission'));
		add_action('hike_submitted',			array($this,'mail_submission'), 11 , 2);
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
					    <label for="post_title">Hike Title</label>
					    <p class="help-block">This will serve as the title of the post.</p>
					    <input type="text" class="form-control" id="post-title" name="post_title" placeholder="Post Title" required>
					</div>

					<!-- Content -->
					<div class="form-group">
					    <label for="post_content">Hike Content</label>
					    <p class="help-block">This is the actual post itself. Feel free to be as descriptive as necessary.</p>
					    <textarea rows="5" class="form-control" id="post-content" name="post_content" placeholder="Post Content" required></textarea>
					</div>

				</div>

				<div class="fo-submission-section">

					<legend>2. Hike Data</legend>

					<!-- Ages -->
					<div class="form-group">
				    	<label for="hike_age">Hike Ages</label>
				    	<p class="help-block">What is the suitable age range for this hike?</p>
				    	<div class="select">
				    		<select name="hike_age" id="hike-age" required>
				    			<option value="4-and-up">Over 4</option>
				    			<option value="8-and-up">Over 8</option>
				    			<option value="12-and-up">Over 12</option>
				    			<option value="16-and-up">Over 16</option>
				    		</select>
				    	</div>

				    </div>

					<!-- Difficulty -->
					<div class="form-group">
				    	<label for="hike_difficulty">Hike Difficulty</label>
				    	<p class="help-block">How difficult is the hike? We'll typically give a label of <em>moderately strenuous</em> if there's any up hill action involved, but it's totally up to you.</p>
				    	<div class="select">
				    		<select name="hike_difficulty" id="hike-difficulty" required>
				    			<option value="easy">Easy</option>
				    			<option value="moderate">Moderate</option>
				    			<option value="moderately-strenuous">Moderately Strenuous</option>
				    			<option value="strenuous">Strenuous</option>
				    		</select>
				    	</div>

				    </div>

					<!-- Rating -->
					<div class="form-group">
				    	<label for="hike_rating">Hike Rating</label>
				    	<p class="help-block">How would you rate this hike?</p>
				    	<div class="select">
				    		<select name="hike_rating" id="hike-rating" required>
				    			<option value="one-star">One Star</option>
				    			<option value="two-star">Two Star</option>
				    			<option value="three-star">Three Star</option>
				    			<option value="four-star">Four Star</option>
				    			<option value="five-star">Five Star</option>
				    		</select>
				    	</div>

				    </div>

				    <!-- Hike City and State -->
				  	<div class="form-group">
				    	<label for="hike_city">Hike City</label>
				    	<p class="help-block">What is the closest city?</p>
				    	<input type="text" class="form-control" id="hike-city" name="hike_city" placeholder="City" required>

				  	</div>

				  	<div class="form-group">
				    	<label for="hike_state">Hike State</label>
				    	<p class="help-block">What state is the hike located in?</p>
				    	<input type="text" class="form-control" id="hike-state" name="hike_state" placeholder="State" required>

				  	</div>

				</div>

				<!-- Hike Data -->
				<div class="fo-submission-section">

					<legend>3. Hike Metadata</legend>

					<!-- Length -->
					<div class="form-group">
					    <label for="hike_length">Hike Length</label>
					    <p class="help-block">How long is the hike? For example, if the hike is 2.3 miles, put 2.3 in the space above.</p>
					    <input type="text" class="form-control" id="hike-length" name="hike_length" placeholder="Length of Hike" required>
					</div>

					<!-- Time -->
					<div class="form-group">
					    <label for="hike_time">Time to Complete Hike (in minutes)</label>
					    <p class="help-block">How long does the hike take? If it takes 2 hours, then you'll put 120 in the space above.</p>
					    <input type="text" class="form-control" id="hike-time" name="hike_time" placeholder="Time (in minutes)" required>
					</div>

					<!-- GPS Coords -->
					<div class="form-group">
					    <label for="hike_gps_coords">GPS Coordinates of Trail Head</label>
					    <p class="help-block">What are the GPS coordinates of the trail head? Enter as latitute, longitude. For example 32.332323, -34.23234. You can find this info on Google Maps.</p>
					    <input type="text" class="form-control" id="hike-gps-coords" name="hike_gps_coords" placeholder="GPS Coordinates of Trail Head" required>
					</div>

					<!-- Location Description-->
					<div class="form-group">
					    <label for="hike_description">Location Description</label>
					     <p class="help-block">Give a special description for the location. For example, if the trailhead is hidden behind a tree, then include this information.</p>
					    <textarea rows="3" class="form-control" id="hike-description" name="hike_description" placeholder="Location Description" required></textarea>
					</div>

				</div>

			    <!-- Images -->
			    <div class="fo-submission-section">

			    	<div class="media-upload--progress hide"><div class="media-upload--bar"></div ><div class="media-upload--percent">0%</div ></div>

			    	<legend>4. Hike Images</legend>

					<div class="form-group">
						<p class="help-block">Upload a max of 5 images. If you only upload 1 image then the gallery won't show and instead will just show an image. Resize the images to a maxiumum width of 1200px. You can use an app like JPEG Mini.</p>

				    	<label class="file">
						  	<input type="file" name="post_images[]" id="post-image" aria-label="File browser example" multiple="multiple" required>
						  	<span class="file-custom"></span>
						</label>
					</div>
					<div id="imagePreview"></div>

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

				$user_id = get_current_user_ID();
				$user_data = get_user_by( 'ID', $user_id );

				$data = array(
					'email' 		=> $user_data->user_email,
					'title' 		=> isset( $_POST['post_title'] ) ? $_POST['post_title'] : false,
					'content'		=> isset( $_POST['post_content'] ) ? $_POST['post_content'] : false,
					'age'			=> isset( $_POST['hike_age'] ) ? sanitize_text_field( $_POST['hike_age'] ) : false,
					'difficulty' 	=> isset( $_POST['hike_difficulty'] ) ? sanitize_text_field( $_POST['hike_difficulty'] ) : false,
					'rating'		=> isset( $_POST['hike_rating'] ) ? sanitize_text_field( $_POST['hike_rating'] ) : false,
					'city'			=> isset( $_POST['hike_city'] ) ? sanitize_text_field( $_POST['hike_city'] ) : false,
					'state'			=> isset( $_POST['hike_state'] ) ? sanitize_text_field( $_POST['hike_state'] ) : false,
					'length'		=> isset( $_POST['hike_length'] ) ? sanitize_text_field( $_POST['hike_length'] ) : false,
					'time'			=> isset( $_POST['hike_time'] ) ? sanitize_text_field( $_POST['hike_time'] ) : false,
					'gps_coords'	=> isset( $_POST['hike_gps_coords'] ) ? sanitize_text_field( $_POST['hike_gps_coords'] ) : false,
					'location_desc' => isset( $_POST['hike_description'] ) ? sanitize_text_field( $_POST['hike_description'] ) : false
				);

				$args = array(
				  	'post_title'    => wp_strip_all_tags( $data['title'] ),
				  	'post_content'  => self::fo_sanitize_content( $data['content'] ),
				  	'post_status'   => 'draft',
				  	'post_type'	  	=> 'hikes'
				);
				$post_id = wp_insert_post( $args );

				if ( is_wp_error( $post_id ) ) {

					wp_send_json_error();

				} else {

					// Categories
					wp_set_object_terms( absint( $post_id ), $data['age'], 'hike_ages', true );
					wp_set_object_terms( absint( $post_id ), $data['difficulty'], 'hike_difficulty', true );
					wp_set_object_terms( absint( $post_id ), $data['rating'], 'hike_rating', true );

					// set state
					$parent = wp_set_object_terms( absint( $post_id ), $data['state'], 'hike_location', true );

					// set city
					// @todo there's some weird bug where the slug is coming out as city-state instead of just city
					$child = wp_insert_term( $data['city'], 'hike_location', array( 'parent'=> $parent[0], 'slug' => strtolower( $data['city'] ) ) );

					// Post Meta
					update_post_meta( $post_id, '_hike_length', $data['length'] );
					update_post_meta( $post_id, '_hike_time', $data['time'] );
					update_post_meta( $post_id, '_hike_location', $data['gps_coords'] );
					update_post_meta( $post_id, '_hike_location_desc', $data['location_desc'] );

					// Images
					if ( $_FILES ) {

						$files = $_FILES['post_images'];

						foreach ( $files['name'] as $key => $value ) {

							if ( $files['name'][$key] ) {

								$file = array(
									'name'     => $files['name'][$key],
									'type'     => $files['type'][$key],
									'tmp_name' => $files['tmp_name'][$key],
									'error'    => $files['error'][$key],
									'size'     => $files['size'][$key]
								);

								$_FILES = array('post_images' => $file);

								foreach ( $_FILES as $file => $array ) {

									if( getimagesize( $array['tmp_name'] ) ){

								        $newupload = self::insert_attachment( $file, $post_id);

								    }

								}
							}
						}
					}
				}

				do_action('hike_submitted', $user_id, $data );

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

	function mail_submission( $user_id, $data ) {

		$message = "Email: ".$data['email']."\n";
		$message .= "Title: ".$data['title']."\n";
		$message .= "Content: ".$data['content']."\n";
		$message .= "Age: ".$data['age']."\n";
		$message .= "Difficulty: ".$data['difficulty']."\n";
		$message .= "Rating: ".$data['rating']."\n";
		$message .= "City: ".$data['city']."\n";
		$message .= "State: ".$data['state']."\n";
		$message .= "Length: ".$data['length']."\n";
		$message .= "Time: ".$data['time']."\n";
		$message .= "GPS Coords: ".$data['gps_coords']."\n";
		$message .= "Location Description: ".$data['location_desc']."\n";

		wp_mail( 'email@nickhaskins.com','New Hike Submission', $message );
	}
}
new foSubmissions;