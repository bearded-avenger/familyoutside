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

		$this->includes();

	}

	/**
	*	File includes
	*
	*	@since 1.0
	*/
	function includes(){

		require FO_THEME_DIR.'/inc/post-types.php';
		require FO_THEME_DIR.'/inc/theme-functions.php';
		require FO_THEME_DIR.'/inc/template-tags.php';
		require FO_THEME_DIR.'/inc/extras.php';
		require FO_THEME_DIR.'/inc/jetpack.php';
		require FO_THEME_DIR.'/inc/options.php';

		if ( is_admin() ){
			require FO_THEME_DIR.'/inc/post-meta.php';
		}
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
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
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
}
new foSetup();
