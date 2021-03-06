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
*	GEt custom positioning of featured image if available
*
*	@since 1.0
*/
function fo_get_featured_img_pos( $post_id = 0 ){

	if ( empty ( $post_id ) )
		$post_id = get_the_ID();

	$positioning = get_post_meta( $post_id, '_feat_img_position', true );

	return $positioning ? $positioning : false;

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

			    	$image 	= wp_get_attachment_image_src( $attachment_id, $size );
			    	$alt     = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
			        echo '<img data-src="'.$image[0].'" alt="'.$alt.'" >';
			    }
		    echo '</div>';

		} else {
			echo '<div class="object-banner" style="background-image:url('.$banner[0].');"></div>';
		}
	echo '</div>';
}

/**
*
*	A global pagionation function
*	@since 5.0.4
*/
function fo_pagination(){

	$bignum = 999999999;

	global $wp_query;

	if ( $wp_query->max_num_pages <= 1 )
		return;

	$big = 9999;

	echo '<nav class="fo-pagination">';

		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages
		) );

	echo '</nav>';
}
/**
*	Draw social sharing buttons - sharing done though js
*
*	@param $class 	string 	optional css class to pass through
*	@param $postid 	int 	the id of the post for bookmarking
*/
function fo_social_sharing( $class = '', $post_id = 0 ){

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );

	?>
		<ul class="<?php echo sanitize_html_class( $class );?> fo-share--wrap">

			<?php
				if ( function_exists('fo_has_user_bookmarked') && fo_has_user_bookmarked( get_current_user_ID(), $post_id ) ) { ?>
					<li><a href="#" data-postid="<?php echo absint( $post_id );?>" class="fo-bookmark-it fo-bookmark--unbookmark" title="Remove from favorites"><i class="fo-icon fo-icon-heart"></i></a></li>
				<?php } else { ?>
					<li><a href="#" data-postid="<?php echo absint( $post_id );?>" class="fo-bookmark-it" title="Add to favorites"><i class="fo-icon fo-icon-heart-o"></i></a></li>
				<?php }
			?>

			<li><a href="#" class="fo--share__twitter" title="Share on Twitter" ><i class="fo-icon fo-icon-twitter-square"></i></a></li>
			<li><a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink());?>&media=<?php echo $feat_image[0];?>&description=<?php echo the_title();?>" class="pin-it-button" title="Share on Pinterest" count-layout="horizontal"  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=350,width=800');return false;" target="_blank" ><i class="fo-icon fo-icon-pinterest"></i></a></li>
			<li><a href="#" class="fo--share__fb" title="Share on Facebook"><i class="fo-icon fo-icon-facebook-square"></i></a></li>
		</ul>
	<?php
}

/**
*	Return a human readable text for a specific post type
*
*	@param $post_id int id of the post
*	@since 1.0
*	@return array
*/
function fo_return_type_data( $post_id = 0 ){

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	$type = get_post_type( $post_id );

	switch ( $type ) {
		case 'hikes':
			$label = 'Hike';
			$class = 'label-hike';
			break;
		case 'reviews':
			$label = 'Review';
			$class = 'label-review';
			break;
		case 'activities':
			$label = 'Activity';
			$class = 'label-activity';
			break;
		case 'post':
			$label = 'Article';
			$class = 'label-article';
			break;
	}

	$out = array(
		'label' => $label,
		'class' => $class
	);

	return is_array( $out ) ? $out : false;

}

/**
*	Determines if a user has completed teh user info
*
*	@param $user_id int id of the user
*	@since 1.0
*	@return bool
*/
function fo_user_info_completed( $user_id = 0 ) {

	if ( empty( $user_id ) )
		$user_id = get_current_user_ID();

	$status = get_user_meta( $user_id, 'user_info_completed', true );

	return $status ? true : false;

}


/**
*
*	Calculate hours based on total minutes
*
*	@param $minutes int time in minutes
*	@since 6.2
*/
function fo_calculate_total_time( $minutes = 0 ) {

	if ( empty ( $minutes ) )
		return;

	$hours 			= floor( $minutes / 60 );
	$hours			= $hours > 0 ? sprintf('%shrs ', $hours) : false;
	$minutes 		= $minutes % 60;
	$minutes 		= $minutes > 0 ? sprintf('%smin', $minutes) : false;

	return sprintf('%s%s', $hours, $minutes);
}

/**
*	Provide an empty state notification
*
*	@since 1.0
*/
function fo_empty_state( $type = 'favorites', $buffer = false ) {

	if ( true == $buffer ) { ob_start(); }

	switch ( $type ) {
		case 'favorites':
			$icon = 'heart-o';
			$text = 'You currently do not have any favorited items.';
			break;
	}

	?><div class="fo-empty-state well">

		<i class="fo-icon fo-icon-<?php echo $icon;?>"></i>

		<p><?php echo $text;?></p>

	</div><?php

	if ( true == $buffer ) { return ob_get_clean(); }

}

/**
*
*	Get some random posts for hikes or reviews
*
*	@since 1.2
*/
function fo_related_posts( $count = 3 ){

	$type 	= get_post_type();
	$current = get_the_ID();

	$args = array(
		'post_type' 	=> $type,
		'posts_per_page' => $count,
		'orderby'		=> 'rand',
		'post__not_in' 	=> array( $current )
	);

	$q = new wp_query( $args );

	if( $q->have_posts() ) :

		echo '<h3 class="container">You might also enjoy:</h3>';

		echo '<ul class="fo-post-grid fo-post-grid-'.$count.' fo-post-grid--related container">';

			while ( $q->have_posts() ) : $q->the_post();

				echo fo_build_post_grid_item( get_the_ID() );

			endwhile;

		echo '</ul>';

	endif;wp_reset_postdata();wp_reset_query();

}

/**
*	Build a single post in a grid style design
*
*	@param $id int the id of the post
*	@since since 1.2
*/
function fo_build_post_grid_item( $id = 0 ) {

	$featured = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large' );


	?>
		<li id="<?php get_the_ID();?>" <?php post_class( array('class' => 'fo-post-grid--item') );?> >
			<div class="fo-post-grid--item__inner">
				<a href="<?php echo get_permalink();?>">
					<div class="fo-post-grid--item__image" style="background-image:url(<?php echo $featured[0];?>);"></div>
				</a>
				<div class="fo-post-grid--item__entry">
					<?php echo the_title('<h4 class="fo-post-grid--item__title">','</h4>');?>
					<?php echo the_excerpt();?>
					<a class="btn btn-primary btn-sm" href="">Read More</a>
				</div>
			</div>

		</li>
	<?php

}