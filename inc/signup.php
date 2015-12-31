<?php

class foSignup {

	function __construct(){
		add_action( 'wp_ajax_nopriv_create_account', 	array( $this,'process_create_account' ) );
		add_action( 'wp_footer', 					array( $this, 'draw_modal' ) );
	}

	/**
	*
	*	Return the form used within the modal for creating a user
	*
	*	@since 1.0
	*/
	function draw_modal(){

		if ( !is_user_logged_in() ): ?>

		<div class="modal fade modal--create-account modal--centered" id="modal--create-account" tabindex="-1" role="dialog">
		    <div class="modal-dialog modal-sm">
			  	<div class="modal-content">
			  		<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        				<h4 class="modal-title" id="gridSystemModalLabel">Signup is quick and free!</h4>
        				<p>Save hikes and product reviews to your own list, get access exclusive member only content, and much more!</p>
					</div>
					<div class="modal-body">
						<?php self::draw_form();?>
			
					</div>
					<div class="modal-footer">
						<p class="modal--terms">By creating an account you agree to our <a href="http://support.foookie.com/article/170-terms-of-use">terms of use</a> and <a href="http://support.foookie.com/article/172-privacy-policy">privacy policy</a>.</p>
					</div>
				</div>
			</div>
		</div>

		<?php endif;
	}

	function draw_form(){ ?>
		<form id="fo-create-account-form" method="post" class="fo-form-custom fo-form-create-user">
		    <div id="fo-form--confirmation"></div>
		    <div class="form-group">
		        <input class="form-control" required id="name" type="text" name="name" value="" placeholder="Choose a Username"/>
		    </div>

		    <div class="form-group">
		        <input class="form-control" required id="email" type="text" name="email" value="" placeholder="Enter Your Email"/>
		    </div>

		    <div class="form-group">
		        <input id="fo-create-user--password-1" type="password" class="password form-control" name="password" value="" placeholder="Create Password"/>
		    </div>

		   	<div class="form-group">
		        <input id="fo-create-user--password-2" type="password" class="password form-control" name="confirm-password" value="" placeholder="Confirm Password"/>
		    </div>

		    <input type="hidden" name="action" value="create_account">
		    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('create-account');?>"/>
		    <input type="submit" value="Sign me up!" class="btn btn-primary btn-small">
		</form><?php
	}
	/**
	*
	*	Create a user and set them as a subscriber on teh main site
	*
	*	@since 5.5
	*/
	public static function process_create_account() {

		$name = isset( $_POST['name'] ) ? esc_html( strtolower( $_POST['name'] ) ) : false;
		$email = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : false;
		$password = isset( $_POST['password']) ? sanitize_text_field( trim( $_POST['password'] ) ) : false;
		$password2 = isset( $_POST['confirm-password']) ? sanitize_text_field( trim( $_POST['confirm-password'] ) ) : false;

		if ( isset( $_POST['action'] ) && $_POST['action'] == 'create_account' ) {

			// ok security passes so let's process some data
			if ( wp_verify_nonce( $_POST['nonce'], 'create-account' ) ) {

				// if name or email are missing then bail out
				if ( empty( $name ) || empty( $email ) || empty( $password ) ) {
					wp_send_json_error(array('message' => 'missing-fields'));

				}

				// check if the username exists and merge, if not then create the user with the random password
				$user_id = username_exists( $name );

				if ( !$user_id == false ) {

					wp_send_json_error(array('message' => 'user-exists'));

				} elseif ( email_exists( $email ) ) {

					wp_send_json_error(array('message' => 'email-exists'));

				} else if ( $password !== $password2 ) {

					wp_send_json_error(array('message' => 'passwords-no-match'));

				} else {

					// create teh user and set the role to subscriber
					$userdata = array(
						'user_email'  =>  $email,
					    'user_login'  =>  $name,
					    'user_pass'   =>  $password,
					    'role'		  => 'subscriber'
					);
					$user_id = wp_insert_user( $userdata );

					// automatically login the user
					$creds = array();
					$creds['user_login'] = $name;
					$creds['user_password'] = $password;
					$creds['remember'] = true;
					$user = wp_signon( $creds, false );

					wp_send_json_success();

				}

			}

		}

	}

}
new foSignup;