<?php

/**
*	Return an array of featured posts to use for teh index featured posts area
*
*	@since 1.0
*/
function fo_get_featured_ids(){

	$ids 	= get_theme_mod('featured_posts');

	return $ids ? array_map('intval', explode( ',', $ids ) ) : false;

}

/**
*
*	Get the gallery images from a post
*
*	@param $post_id int id of the post
*	@since 1.0
*/
function fo_get_gallery_images( $post_id = 0 ){

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	$files = get_post_meta( $post_id, '_object_gallery', true );

	return $files ? $files : false;

}

/**
*	Draw a gallery for an object
*
*	@param $post_id int id of the post
*	@since 1.0
*/
function fo_draw_object_gallery( $post_id = 0, $size = 'medium' ) {

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	$files = fo_get_gallery_images( $post_id );

	if ( empty ( $files ) )
		return false;

	echo '<ul>';
	    foreach ( (array) $files as $attachment_id => $attachment_url ) {
	        echo '<li>';
	        	echo wp_get_attachment_image( $attachment_id, $size );
	        echo '</li>';
	    }
    echo '</ul>';
}