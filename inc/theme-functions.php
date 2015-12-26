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