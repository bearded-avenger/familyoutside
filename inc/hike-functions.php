<?php

/**
*	Various functions used for hiking reviews
*/

/**
*	Get the difficulty of a hike
*
*	@param $post_id int id of the post
*	@since 1.0
*/
function fo_get_hike_difficulty( $post_id = 0 ){

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

}

/**
*	Get the rating of a hike
*
*	@param $post_id int id of the post
*	@since 1.0
*/
function fo_get_hike_rating( $post_id = 0 ){

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

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