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

	if ( 'easy' == $difficulty ) {
		$out .= '<i class="fo-icon fo-icon-circle"></i>
				<i class="fo-icon fo-icon-circle-o"></i>
				<i class="fo-icon fo-icon-circle-o"></i>';
	} elseif ( 'moderate' == $difficulty ) {
		$out .= '<i class="fo-icon fo-icon-circle"></i>
				<i class="fo-icon fo-icon-circle"></i>
				<i class="fo-icon fo-icon-circle-o"></i>';
	} elseif ( 'difficult' == $difficulty ) {
		$out .= '<i class="fo-icon fo-icon-circle"></i>
				<i class="fo-icon fo-icon-circle"></i>
				<i class="fo-icon fo-icon-circle"></i>';
	}

	return $out;
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

	$rating = fo_get_term( $post_id, 'hike_rating', true );

	$out = '';

	if ( 'one-star' == $rating ) {
		$out .= '<i class="fo-icon fo-icon-star"></i>
				<i class="fo-icon fo-icon-star-o"></i>
				<i class="fo-icon fo-icon-star-o"></i>
				<i class="fo-icon fo-icon-star-o"></i>
				<i class="fo-icon fo-icon-star-o"></i>';
	} elseif ( 'two-star' == $rating ) {
		$out .= '<i class="fo-icon fo-icon-star"></i>
				<i class="fo-icon fo-icon-star"></i>
				<i class="fo-icon fo-icon-star-o"></i>
				<i class="fo-icon fo-icon-star-o"></i>
				<i class="fo-icon fo-icon-star-o"></i>';
	} elseif ( 'three-star' == $rating ) {
		$out .= '<i class="fo-icon fo-icon-star"></i>
				<i class="fo-icon fo-icon-star"></i>
				<i class="fo-icon fo-icon-star"></i>
				<i class="fo-icon fo-icon-star-o"></i>
				<i class="fo-icon fo-icon-star-o"></i>';
	} elseif ( 'four-star' == $rating ) {
		$out .= '<i class="fo-icon fo-icon-star"></i>
				<i class="fo-icon fo-icon-star"></i>
				<i class="fo-icon fo-icon-star"></i>
				<i class="fo-icon fo-icon-star"></i>
				<i class="fo-icon fo-icon-star-o"></i>';
	} elseif ( 'five-star' == $rating ) {
		$out .= '<i class="fo-icon fo-icon-star"></i>
				<i class="fo-icon fo-icon-star"></i>
				<i class="fo-icon fo-icon-star"></i>
				<i class="fo-icon fo-icon-star"></i>
				<i class="fo-icon fo-icon-star"></i>';
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