<?php

class foSetup {

	public function __construct(){

		// Set some constants
		define('FO_THEME_VERSION', '0.1');

		define('FO_THEME_DIR', 				get_template_directory());
		define('FO_THEME_URL', 				get_template_directory_uri());

		add_action('wp_head',				array($this,'typekit'));
		add_action( 'after_setup_theme', 	array($this,'setup'));
		add_action( 'widgets_init', 		array($this,'widgets_init') );
		add_action( 'wp_enqueue_scripts', 	array($this,'scripts') );
				add_action('template_redirect', array($this,'load_posts'));

		$this->includes();

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

		require FO_THEME_DIR.'/inc/template-tags.php';
		require FO_THEME_DIR.'/inc/jetpack.php';
		require FO_THEME_DIR.'/inc/options.php';

		require FO_THEME_DIR.'/inc/theme-functions.php';
		require FO_THEME_DIR.'/inc/hike-functions.php';
		require FO_THEME_DIR.'/inc/review-functions.php';
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
	 				'loadMore' => 'Load More Posts...',
	 				'loading' => 'Loading Posts...',
	 				'nextLink' => next_posts($max, false)
	 			)
	 		);
	 	}
	}
}
new foSetup();
