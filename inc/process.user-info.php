<?php

/**
*	Class used to hold processing functionality for user info
*	@since 1.0
*/
class foProcessUserInfo {

	function __construct(){

		add_action( 'wp_ajax_process_user_info', array($this, 'user_info' ) );
		add_action('wp_footer',	array($this,'draw_modal'));

	}

	/**
	*
	* 	Process the infoz
	*	@since 1.0
	*/
	function user_info(){

		if ( isset( $_POST['action'] ) ) {

			// bail out if this user isnt logged in
			if( !is_user_logged_in() )
				return;

			if ( ! wp_verify_nonce( $_POST['nonce'], 'process-user-info' ) )
				return;

			$user_id = get_current_user_id();

			if ( $_POST['action'] == 'process_user_info' ) {

				do_action('user_info_updated', $user_id );

		        wp_send_json_success();

			} else {

				wp_send_json_error();

			}

		} else {

			wp_send_json_error();
		}

	}

	/**
	*	Sanitize checkbox input
	*/
	private static function sanitize_checkbox( $input ){

		if ( $input ) {

			$output = '1';

		} else {

			$output = '0';

		}

		return $output;
	}

	/**
	*
	*	Return the form used within the modal for saving user info
	*
	*	@since 1.0
	*/
	function draw_modal(){

		if ( is_user_logged_in() && is_page('dashboard') ): ?>

		<div class="modal fade modal--user-info" id="modal--user-info" tabindex="-1" role="dialog">
		    <div class="modal-dialog modal-sm">
			  	<div class="modal-content">
			  		<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        				<h4 class="modal-title" id="gridSystemModalLabel">User Information</h4>
        				<p>Providing this data will help us understand who is using our site!</p>
					</div>
					<div class="modal-body">
						<?php self::draw_form();?>
					</div>
				</div>
			</div>
		</div>

		<?php endif;
	}

	/**
	*
	*	Draw the form used to save info
	*	@since 1.0
	*/
	function draw_form(){ ?>

		<form id="fo-user-info-form" method="post" class="fo-form-user-info">
		    <div id="fo-form--confirmation"></div>

		    <div class="form-group">
		    	<label>Who do you identify as?</label>
				<div class="radio">
					<label class="control" for="gender-male">
						Male
						<input type="radio" id="gender-male" name="gender[]" value="male">
						<span class="control-indicator"></span>
					</label>
				</div>
				<div class="radio">
					<label class="control" for="gender-female">
						Female
						<input type="radio" id="gender-female" name="gender[]" value="female">
						<span class="control-indicator"></span>
					</label>
				</div>
		    </div>

		    <div class="form-group">
		    	<label>What is your age?</label>
		    	<div class="select">
		    		<select name="age" id="age">
		    			<option value="under-12">Under 12</option>
		    			<option value="12-17">12-17</option>
		    			<option value="18-24">18-24</option>
		    			<option value="25-34">25-34</option>
		    			<option value="35-44">35-44</option>
		    			<option value="45-54">45-54</option>
		    			<option value="55-64">55-64</option>
		    			<option value="65-74">65-74</option>
		    			<option value="older-75">75 or older</option>
		    		</select>
		    	</div>
		    </div>

		    <div class="form-group">
		    	<label>What is your occupation?</label>
		        <input class="form-control" required id="occupation" type="text" name="occupation" value="" placeholder="Occupation"/>
		    </div>

		    <div class="form--bottom">
		    	<input type="hidden" name="action" value="process_user_info">
		    	<input type="hidden" name="nonce" value="<?php echo wp_create_nonce('process-user-info');?>"/>
		    	<input type="submit" value="Save" class="btn btn-primary">
			</div>
		</form><?php
	}
}

new foProcessUserInfo;