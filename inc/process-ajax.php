<?php

/**
*	Class used to hold processing functionality for various ajax calls
*	@since 1.0
*/
class foProcessAjax {

	public function __construct(){

		add_action( 'wp_ajax_process_delete_bookmarks', array($this, 'delete_bookmarks' ) );

	}

	/**
	*
	* 	Process the bookmark deleting
	*	@since 1.0
	*/
	public static function delete_bookmarks(){

		if ( isset( $_POST['action'] ) ) {

			// bail out if this user isnt logged in
			if( !is_user_logged_in() )
				return;

			if ( ! wp_verify_nonce( $_POST['nonce'], 'process_delete_bookmarks' ) )
				return;

			$user_id = get_current_user_id();

			if ( $_POST['action'] == 'process_delete_bookmarks' ) {

				$bookmarks = isset( $_POST['bookmark_ids'] ) ? $_POST['bookmark_ids'] : false;
				$bookmarks = explode(',', $bookmarks);

				// delete the bookmarks
				self::remove_bookmarks( $user_id, $bookmarks );

		        wp_send_json_success();

			} else {

				wp_send_json_error();

			}

		} else {

			wp_send_json_error();
		}

	}

	/**
	*	Loop through the available bookmarks and remove them
	*/
	private static function remove_bookmarks( $user_id, $bookmarks ) {

		foreach ( $bookmarks as $bookmark ) {

			fo_remove_bookmark( $user_id, $bookmark );
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
}

new foProcessAjax;