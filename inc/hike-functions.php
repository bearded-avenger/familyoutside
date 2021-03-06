<?php

/**
*	Various functions used for hiking reviews
*/

/**
*	Get the location of a hike
*
*	@param $post_id int id of the post
*	@since 1.0
*/
function fo_get_hike_location( $post_id = 0 ){

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	$terms = wp_get_object_terms( $post_id, 'hike_location' );

	if ( empty( $terms ) )
		return false;

	$state = $terms[0]->parent !== 0 ? $terms[0]->name : $terms[1]->name;
	$city  = $terms[0]->parent !== 0 ? $terms[1]->name : $terms[0]->name;

	return sprintf('%s, %s', $state, $city);

}

/**
*	Get the gps coordinates for teh hike trailhead (different from hike location)
*
*	@param $post_id int id of the post
*	@since 1.0
*	@return array
*/
function fo_get_hike_gps_location( $post_id = 0 ){

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	$ret = get_post_meta( $post_id, '_hike_location', true );
	$ret = $ret ? explode(',', $ret) : false;

	return $ret ? $ret : false;

}

/**
*	Get the description of the location (used with gps coordinates)
*
*	@param $post_id int id of the post
*	@since 1.0
*/
function fo_get_hike_location_description( $post_id = 0 ){

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	$ret = get_post_meta( $post_id, '_hike_location_desc', true );

	return $ret ? $ret : false;

}

/**
*	Get the description of the hike according 
*
*	@param $post_id int id of the post
*	@since 1.0
*/
function fo_get_hike_they_said( $post_id = 0 , $who = 'she' ){

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	$ret = get_post_meta( $post_id, '_hike_'.$who.'_said', true );

	return $ret ? $ret : false;

}

/**
*	Get the difficulty of a hike
*
*	@param $post_id int id of the post
*	@since 1.0
*/
function fo_get_hike_difficulty( $post_id = 0 ){

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	$difficulty = fo_get_term( $post_id, 'hike_difficulty', true );

	$out = '';

	$easy_tooltip = 'data-toggle="tooltip" data-placement="bottom" title="Easy"';
	$moderate_tooltip = 'data-toggle="tooltip" data-placement="bottom" title="Moderate"';
	$ms_tooltip = 'data-toggle="tooltip" data-placement="bottom" title="Moderately Strenuous"';
	$strenuous_tooltip = 'data-toggle="tooltip" data-placement="bottom" title="Strenuous"';

	if ( 'easy' == $difficulty ) {
		$out .= '<i class="fo-icon fo-icon-circle" '.$easy_tooltip.'></i>
				<i class="fo-icon fo-icon-circle-o" '.$moderate_tooltip.'></i>
				<i class="fo-icon fo-icon-circle-o" '.$ms_tooltip.'></i>
				<i class="fo-icon fo-icon-circle-o" '.$strenuous_tooltip.'></i>';
	} elseif ( 'moderate' == $difficulty ) {
		$out .= '<i class="fo-icon fo-icon-circle" '.$easy_tooltip.'></i>
				<i class="fo-icon fo-icon-circle" '.$moderate_tooltip.'></i>
				<i class="fo-icon fo-icon-circle-o" '.$ms_tooltip.'></i>
				<i class="fo-icon fo-icon-circle-o" '.$strenuous_tooltip.'></i>';
	} elseif ( 'moderately-strenuous' == $difficulty ) {
		$out .= '<i class="fo-icon fo-icon-circle" '.$easy_tooltip.'></i>
				<i class="fo-icon fo-icon-circle" '.$moderate_tooltip.'></i>
				<i class="fo-icon fo-icon-circle" '.$ms_tooltip.'></i>
				<i class="fo-icon fo-icon-circle-o" '.$strenuous_tooltip.'></i>';
	} elseif ( 'strenuous' == $difficulty ) {
		$out .= '<i class="fo-icon fo-icon-circle" '.$easy_tooltip.'></i>
				<i class="fo-icon fo-icon-circle" '.$moderate_tooltip.'></i>
				<i class="fo-icon fo-icon-circle" '.$ms_tooltip.'></i>
				<i class="fo-icon fo-icon-circle" '.$strenuous_tooltip.'></i>';
	}

	return $out;
}

/**
*	Get the ages of a hike
*
*	@param $post_id int id of the post
*	@since 1.0
*/
function fo_get_hike_ages( $post_id = 0 ){

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	return fo_get_term( $post_id, 'hike_ages' );

}

/**
*	Get the length of a hike
*
*	@param $post_id int id of the post
*	@since 1.0
*/
function fo_get_hike_length( $post_id = 0 ){

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	$ret = get_post_meta( $post_id, '_hike_length', true );

	return $ret ? $ret : false;

}

/**
*	Get the time of a hike
*
*	@param $post_id int id of the post
*	@since 1.0
*/
function fo_get_hike_time( $post_id = 0 ){

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	$ret = get_post_meta( $post_id, '_hike_time', true );

	return $ret ? $ret : false;

}