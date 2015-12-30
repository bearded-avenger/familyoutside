<?php

class foLogin {

	function __construct(){
		add_action( 'wp_footer', 						array( $this, 'draw_modal' ) );
		add_action( 'login_enqueue_scripts', 			array(  $this, 'assets' ) );
		add_filter( 'login_headerurl', 					array(  $this, 'logo_url' ) );
		add_filter( 'login_headertitle', 				array(  $this, 'logo_url_title' ) );
		add_filter( 'show_admin_bar', 					array( $this, 'admin_bar_admins_only' ) );
				add_action('admin_init', 			array($this,'dashboard_redirect'));
	}

	/**
	*	Custom login style sheet
	*
	*	@since 1.0
	*/
	function assets(){
		wp_enqueue_style( 'fo-login', FO_THEME_URL.'/assets/css/login.css' );
	}

	/**
	*	Link login logo to home
	*
	*	@since 1.0
	*/
	function logo_url(){
		return site_url();
	}

	/**
	*	Rename login image title
	*
	*	@since 1.0
	*/
	function logo_url_title(){
		return 'A Family Outside';
	}

	/**
	*
	*	Hide admin bar for all but administrators
	*	@since 1.0
	*/
	function admin_bar_admins_only( $content ) {
	    return ( current_user_can("administrator") ) ? $content : false;
	}

	/**
	*
	*	Redirect any non-administrator to the user dashboard if they visit wp-admin
	*
	*	@since 1.0
	*/
	function dashboard_redirect(){

		if ( !current_user_can( 'publish_posts' ) || defined('DOING_AJAX') && !DOING_AJAX ) {
			wp_redirect( site_url() );
			exit;
		}

	}
	/**
	*
	*	Return a modal for logging in
	*
	*	@since 1.0
	*/
	function draw_modal(){

		if ( !is_user_logged_in() ): ?>

		<div class="modal fade modal--login" id="modal--login" tabindex="-1" role="dialog">
		    <div class="modal-dialog modal-sm">
			  	<div class="modal-content">
			  		<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        				<h4 class="modal-title" id="gridSystemModalLabel">Login</h4>
					</div>
					<div class="modal-body">
						<?php wp_login_form();?>

					</div>
					<div class="modal-footer">
						<p class="modal--terms">Forgot password? Click <a href="<?php echo site_url('wp-login.php?action=lostpassword');?>">here</a> to reset it.</p>
					</div>
				</div>
			</div>
		</div>

		<?php endif;
	}
}
new foLogin;