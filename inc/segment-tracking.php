<?php

/**
*	Various functions used to send data to segment and mixpanel
*
*	@since 1.0
*/

if ( !class_exists('trackWP') ) {
	return;
}

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
    trackWP::track_event( 'user_login', $props, $traits, $user_id );

}