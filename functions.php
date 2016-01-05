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
		add_action('template_redirect', 	array($this,'load_posts'));

		$this->includes();

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
 				'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
 				'nonces'		=> $nonces,
 				'dashboard_url' => site_url('dashboard'),
 				'hike_lat'		=> $lat,
 				'hike_long'		=> $long
 			)
 		);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}


	public function load_posts() {

	 	global $wp_query;

	 	// Add code to index pages.
	 	if ( is_front_page() || is_home() || is_archive() || is_search() ) {
	 		// Queue JS and CSS
	 		wp_enqueue_script('fo-post-loader',FO_THEME_URL.'/assets/js/load-posts.js',array('jquery'),FO_THEME_VERSION,true);

	 		$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

	 		$max = '';

	 		// Add some parameters for the JS.
	 		wp_localize_script(
	 			'fo-post-loader',
	 			'pagi_vars',
	 			array(
	 				'startPage' => $paged,
	 				'loadMore' => 'Load More Posts',
	 				'loading' => 'Loading...',
	 				'nextLink' => next_posts($max, false)
	 			)
	 		);
	 	}
	}
}
new foSetup();
