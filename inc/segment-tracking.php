<?php

/**
*	Various functions used to send data to segment and mixpanel
*
*	@since 1.0
*/

if ( !class_exists('trackWP') ) {
	return;
}

/**
*	Track user login
*
*	@param $user_login string username
*	@param $user object user object
*	@since 1.0
*/
add_action('wp_login', 'track_login', 10, 2);
function track_login( $user_login, $user ) {

    $user_id = $user->ID;
    $user_data = get_userdata( $user_id );

    $traits = array(
        'userId'    => $user_id,
        'firstName' => $user_data->first_name,
        'lastName'  => $user_data->last_name,
        'username'  => $user_login,
        'email'     => $user_data->user_email
    );

    $props = array();

    trackWP::identify_user( $user_id, $traits );
    trackWP::track_event( 'User Login', $props, $user_id );

}

/**
*	Track user favorites
*
*	@param $user_id int id of the user
*	@param $post_id int id of the post being favorited
*	@since 1.0
*/
add_action( 'fo_bookmark_added', 'fo_track_favorite', 10, 2 );
function fo_track_favorite( $user_id, $post_id ) {

	$favorite = get_the_title( $post_id );

	$props = array(
		'post' => $favorite,
		'time'	=> time()
	);

	trackWP::track_event('Favorite Added', $props, $user_id );

}

/**
*	Track new user registrations
*
*	@param $user_id int id of the user
*	@since 1.0
*/
add_action( 'user_register', 'track_user_registration', 10, 1);
function track_user_registration( $user_id ) {

	$user_data  = get_userdata( $user_id );
	$registered = $user_data->user_registered . "\n";
	$created    = date("n/j/Y", strtotime( $registered ) );

	$traits = array(
		'firstName' => $user_data->first_name,
		'lastName'  => $user_data->last_name,
		'email'     => $user_data->user_email,
		'username'  => $user_data->user_login,
		'createdAt' => $created
	);

	$props = array(
		'createdAt'   => $created
	);

	trackWP::identify_user( $user_id, $traits );
	trackWP::track_event( 'Account Created', $props, $user_id );
}

/**
*	Track a user updating their demographic information
*
*	@param $user_id int id of the user
*	@param $data array  gender | age | education | employment
*	@since 1.0
*/
add_action('user_info_updated', 'track_user_info_updated', 10, 2 );
function track_user_info_updated( $user_id, $data ) {

	$gender 	= isset( $data['gender'] ) ? $data['gender'] : false;
	$age 		= isset( $data['age'] ) ? $data['age'] : false;
	$education 	= isset( $data['education'] ) ? $data['education'] : false;
	$employment = isset( $data['employment'] ) ? $data['employment'] : false;

	$props = array(
		'gender' 	 => $gender,
		'age'		 => $age,
		'education'	 => $education,
		'employment' => $employment
	);

	trackWP::identify_user( $user_id, $props );
	trackWP::track_event( 'Demographics Saved', $props, $user_id );
}


