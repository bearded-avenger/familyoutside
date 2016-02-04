<?php

/**
*
*
*	This class is responsible for the social sharing functionality and integration
*
*	@since 0.1
*/

class foSocial{


	public function __construct(){
		add_action( 'wp_head', 					array( $this, 'card_meta' ) );
		add_action( 'wp_head', 					array( $this, 'sharing' ) );
	}

	/**
	*
	*	This function inserts Facebook Open Graph and Twitter Card Meta in the header
	*	@since 1.0
	*/
	public static function card_meta(){

		$author = get_post_field( 'post_author', get_the_ID() );
		?>

		<?php if ( !is_front_page() ) { ?>
		<!-- Standard Meta -->
		<meta name="description" content="<?php echo esc_attr( self::excerpt() );?>">
		<meta name="robots" content="index, follow" />
		<?php } ?>

		<!-- Facebook Open Graph -->
		<meta property="og:url" content="<?php echo esc_url( get_permalink() );?>">
		<meta property="og:title" content="<?php echo esc_attr( get_the_title() );?>">
		<meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo('name') );?>">
		<meta property="og:description" content="<?php echo esc_attr( self::excerpt() );?>">
		<meta property="og:type" content="website">
		<?php echo !is_404() ? self::get_img('property','og', 'fb') : false;?>
		<meta property="og:locale" content="en_us">
		<meta property="fb:app_id" content="490314757815079" />

		<!-- Twitter Card Meta -->
		<meta name="twitter:card" content="summary">
		<meta name="twitter:creator" content="@afamilyoutside">
		<meta name="twitter:site" content="@afamilyoutside">
		<meta name="twitter:title" content="<?php echo esc_attr( get_the_title() );?>">
		<meta name="twitter:description" content="<?php echo esc_attr( self::excerpt() );?>">
		<meta name="twitter:domain" content="<?php echo esc_url( get_permalink() );?>">
		<?php echo !is_404() ? self::get_img('name','twitter', 'twitter') : false;?>

		<?php
	}

	/**
	*
	*	Main fucntion responsible for rich sharing to Facebook and Twitter
	*	@since 1.0
	*/
	public static function sharing(){

		if ( is_single() || is_page('signup-success') ):

		$img 		= wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
		?>
		<script>

			function fbAsyncInit() {
				FB.init({
			     	appId      : '490314757815079',
			      	xfbml      : true,
			      	version    : 'v2.5'
				});

			  	jQuery('.fo--share__fb').click(function(e){
			  		e.preventDefault();

				    FB.ui({
				    	method: 'share',
						href: '<?php esc_url( the_permalink() );?>'
				    });

			  	});
			}

			jQuery(document).ready(function($){
				$('.fo--share__twitter').attr('href', "https://twitter.com/intent/tweet?text=<?php echo esc_attr( the_title() );?>&nbsp;<?php esc_url( the_permalink() );?>&url=<?php esc_url( the_permalink() );?>");
			});

		</script>
		<?php

		endif;
	}

	/**
	*
	*	Get the image attached to a post and return the data for either facebook or twitter
	*	@todo - need to set a default if no post image??
	*	@param name string twitter or facebook
	*	@param prop string twitter or og
	*	@param vendor string twitter or fb
	*	@return a meta card specific to a social network
	*
	*	@since 1.0
	*/
	public static function get_img($name = '',$prop = '', $vendor = ''){

		$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full');

		return has_post_thumbnail() ? sprintf( '<meta %s="%s:image" content="%s">', $name, $prop, $imgsrc[0] ) : false;
	}

	/**
	*
	*	If has an excerpt, then return it, else return the blog description beause we're probably not on a post
	*	@since 1.0
	*/
	public static function excerpt(){

		global $post;

		if ( !isset( $post ) )
			return;

		return get_the_excerpt() ? sprintf( '%s', get_the_excerpt() ) : sprintf( '%s', get_bloginfo( 'description' ) );
	}
}

new foSocial;