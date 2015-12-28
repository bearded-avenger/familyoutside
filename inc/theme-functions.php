<?php

/**
*	Get the current term for an object
*
*	@param $post_id int id of the object to get the terms for
*	@param $as_slug bool return the slug or a span element
*	@param $term string the term to check for (hike_location, hike_rating)
*	@since 1.0
*
*/
function fo_get_term( $post_id = 0, $term = 'hike_location', $as_slug = false ) {

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	$terms = wp_get_object_terms( $post_id, $term , array( 'parent' => 0 ) );
	$terms = $terms ? current( $terms ) : false;

	if ( empty( $terms ) )
		return;

	return true == $as_slug ? $terms->slug : esc_html( $terms->name );

}

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
*	Get the rating of a post object
*
*	@param $post_id int id of the post
*	@param $type string (hike_rating | product_rating)
*	@since 1.0
*/
function fo_get_object_rating( $post_id = 0, $type = 'hike_rating' ){

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	$rating = fo_get_term( $post_id, $type, true );

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
function fo_draw_object_gallery( $post_id = 0, $size = 'full' ) {

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	$files 	= fo_get_gallery_images( $post_id );
	$banner = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'post-banner');
	$class = empty( $files ) ? 'no-gallery' : false;

	echo '<div class="object-mast--media '.$class.'">';
		if ( !empty( $files ) ) {

			echo '<div id="object-gallery">';
			    foreach ( (array) $files as $attachment_id => $attachment_url ) {

			    	$image = wp_get_attachment_image_src( $attachment_id, $size );
			        echo '<img data-src="'.$image[0].'" >';
			    }
		    echo '</div>';

		} else {
			echo '<div class="object-banner" style="background-image:url('.$banner[0].');"></div>';
		}
	echo '</div>';
}