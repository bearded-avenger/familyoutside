<?php

/**
*	Get the category of a review
*
*	@param $post_id int id of the post
*	@since 1.0
*/
function fo_get_review_category( $post_id = 0 ){

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	return fo_get_term( $post_id, 'product_category' );

}

/**
*	Get the manufacturer of a product review
*
*	@param $post_id int id of the post
*	@since 1.0
*/
function fo_get_review_manufacturer( $post_id = 0 ){

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	$ret = get_post_meta( $post_id, '_product_company', true );

	return $ret ? $ret : false;

}

/**
*	Get the price of a product review
*
*	@param $post_id int id of the post
*	@since 1.0
*/
function fo_get_review_price( $post_id = 0 ){

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	$ret = get_post_meta( $post_id, '_product_price', true );

	return $ret ? $ret : false;

}

/**
*	Get the summary of a product review
*
*	@param $post_id int id of the post
*	@since 1.0
*/
function fo_get_review_summary( $post_id = 0 ){

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	$ret = get_post_meta( $post_id, '_product_summary', true );

	return $ret ? apply_filters('the_content',$ret) : false;

}
