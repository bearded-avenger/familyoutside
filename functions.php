<?php

class foSetup {

	public function __construct(){

		// Set some constants
		define('FO_THEME_VERSION', '0.1');

		define('FO_THEME_DIR', 				get_template_directory());
		define('FO_THEME_URL', 				get_template_directory_uri());

		add_filter( 'wp_mail_from', 		array( $this, 'mail_from' ), 10, 1 );
		add_filter( 'wp_mail_from_name', 	array( $this, 'mail_from_name' ), 10, 1 );
		add_action('init', 					array($this,'dashboard_redirect'));
		add_action('wp_head',				array($this,'typekit'));
		add_action( 'after_setup_theme', 	array($this,'setup'));
		add_action( 'widgets_init', 		array($this,'widgets_init') );
		add_action( 'wp_enqueue_scripts', 	array($this,'scripts') );
		add_filter( 'pre_get_posts',	 	array($this,'custom_feed'));
		add_filter('excerpt_length', 		array($this,'excerpt_length'));
		add_action( 'hike_after_content', 	array($this,'they_said'));

		add_filter('widget_text', 'do_shortcode');

		$this->includes();

	}

	/**
	*	Add post types to main query plus exclude featured
	*
	*	@since 1.0
	*/
	function custom_feed( $query ) {
	 	if ( ( $query->is_main_query() && $query->is_front_page() ) || $query->is_author ) {

	 		// don't exclude featured posts in author archive
	 		if ( !$query->is_author ) {
	 			$query->set('post__not_in', fo_get_featured_ids() );
	 		}

	        $query->set('post_type', array('post', 'hikes','reviews','activities'));

	    }
	}

	/**
	*	Shorten length  of excerpt
	*
	*	@since 1.0
	*/
	function excerpt_length($length) {
		return 22;
	}

	/**
	* Filter the from email fro mails sent with wp_mail
	*	@since 1.0
	*/
	function mail_from( $email ){
		return 'info@afamilyoutside.com';
	}

	/**
	*	Filter the name on outgoing mails sent with wp_mail
	*	@since 1.0
	*/
	function mail_from_name( $name ){
		return 'A Family Outside';
	}
	/**
	*
	*	Redirect any non-administrator to the user dashboard if they visit wp-admin
	*
	*	@since 1.0
	*/
	function dashboard_redirect(){

	  	if ( !current_user_can( 'manage_options' ) && $_SERVER['PHP_SELF'] != '/wp-admin/admin-ajax.php') {
		    if ( is_admin() ) {
		        wp_redirect( home_url() );
		        exit;
		    }
		}

	}
	/**
	*	File includes
	*
	*	@since 1.0
	*/
	function includes(){

		require FO_THEME_DIR.'/inc/post-types.php';

		if ( is_admin() ){
			require FO_THEME_DIR.'/inc/post-meta.php';
		}

		require FO_THEME_DIR.'/inc/segment-tracking.php';
		require FO_THEME_DIR.'/inc/template-tags.php';
		require FO_THEME_DIR.'/inc/jetpack.php';
		require FO_THEME_DIR.'/inc/options.php';

		require FO_THEME_DIR.'/inc/theme-functions.php';
		require FO_THEME_DIR.'/inc/hike-functions.php';
		require FO_THEME_DIR.'/inc/review-functions.php';
		require FO_THEME_DIR.'/inc/social.php';
		require FO_THEME_DIR.'/inc/signup.php';
		require FO_THEME_DIR.'/inc/fo-login.php';
		require FO_THEME_DIR.'/inc/process.bookmarks.php';
		require FO_THEME_DIR.'/inc/process.user-info.php';
		require FO_THEME_DIR.'/inc/class.submissions.php';
	}

	/**
	*	Misc theme setup
	*
	*	@since 1.0
	*/
	function setup() {

		// Theme Supports
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		// Nav Menu
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'family-outside' ),
		) );

		// HTML5
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_filter( 'facetwp_proximity_store_distance', '__return_true' );


	}

	/**
	*
	*	Widgets init
	*
	*	@since 1.0
	*/
	function widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'family-outside' ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar', 'family-outside' ),
			'id'            => 'sidebar-2',
			'description'   => '',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Comments Sidebar', 'family-outside' ),
			'id'            => 'sidebar-comments',
			'description'   => '',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}

	function typekit(){
		?>
		<script src="https://use.typekit.net/vjc7gyu.js"></script>
		<script>try{Typekit.load({ async: true });}catch(e){}</script>
		<?php
	}

	/**
	*
	*	Assets
	*
	*	@since 1.0
	*/
	function scripts() {

		wp_enqueue_script('jquery-form');
		wp_enqueue_style( 'fo-style', FO_THEME_URL.'/assets/css/style.css' );
		wp_enqueue_script( 'fo-scripts', FO_THEME_URL.'/assets/js/scripts.js', array('jquery'), FO_THEME_VERSION, true );

		$location = fo_get_hike_gps_location();
		$lat      = isset( $location['0'] ) ? $location['0'] : false;
		$long      = isset( $location['1'] ) ? $location['1'] : false;

		$nonces = array(
			'bookmark'			=> wp_create_nonce('process_bookmark'),
			'delete_bookmark' 	=> wp_create_nonce('process_delete_bookmarks')
		);

 		wp_localize_script(
 			'fo-scripts',
 			'fo_local_vars',
 			array(
 				'loggedin'			=> is_user_logged_in() ? 'true' : false,
 				'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
 				'nonces'			=> $nonces,
 				'dashboard_url' 	=> site_url('dashboard'),
 				'hike_lat'			=> $lat,
 				'hike_long'			=> $long,
 				'favs_empty_state'	=> fo_empty_state('favorites', true)
 			)
 		);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	public function they_said(){

		$he_said = fo_get_hike_they_said( get_the_ID(), 'he');
		$she_said = fo_get_hike_they_said( get_the_ID(), 'she');

		if ( is_single() && 'hikes' == get_post_type() && ( false !== $he_said || false !== $she_said ) ) {

	        ?>
	        <div class="they-said">
	      		<h4>He said she said</h4>
				<div class="alert alert-they-said alert-he-said">
					<i class="fo-icon fo-icon-male"></i>
					<?php echo apply_filters('the_content',$he_said);?>
				</div>
				<div class="alert alert-they-said alert-she-said">
					<i class="fo-icon fo-icon-female"></i>
					<?php echo apply_filters('the_content',$she_said);?>
				</div>
			</div><?php

	    }

	}
}
new foSetup();
