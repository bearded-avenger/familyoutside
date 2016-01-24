<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Family_Outside
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo FO_THEME_URL ;?>/assets/icons/apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo FO_THEME_URL ;?>/assets/icons/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo FO_THEME_URL ;?>/assets/icons/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo FO_THEME_URL ;?>/assets/icons/apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php echo FO_THEME_URL ;?>/assets/icons/apple-touch-icon-60x60.png" />
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo FO_THEME_URL ;?>/assets/icons/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo FO_THEME_URL ;?>/assets/icons/apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo FO_THEME_URL ;?>/assets/icons/apple-touch-icon-152x152.png" />
<link rel="icon" type="image/png" href="<?php echo FO_THEME_URL ;?>/assets/icons/favicon-196x196.png" sizes="196x196" />
<link rel="icon" type="image/png" href="<?php echo FO_THEME_URL ;?>/assets/icons/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/png" href="<?php echo FO_THEME_URL ;?>/assets/icons/favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="<?php echo FO_THEME_URL ;?>/assets/icons/favicon-16x16.png" sizes="16x16" />
<link rel="icon" type="image/png" href="<?php echo FO_THEME_URL ;?>/assets/icons/favicon-128.png" sizes="128x128" />
<meta name="application-name" content="&nbsp;"/>
<meta name="msapplication-TileColor" content="#FFFFFF" />
<meta name="msapplication-TileImage" content="<?php echo FO_THEME_URL ;?>/assets/icons/mstile-144x144.png" />
<meta name="msapplication-square70x70logo" content="<?php echo FO_THEME_URL ;?>/assets/icons/mstile-70x70.png" />
<meta name="msapplication-square150x150logo" content="<?php echo FO_THEME_URL ;?>/assets/icons/mstile-150x150.png" />
<meta name="msapplication-wide310x150logo" content="<?php echo FO_THEME_URL ;?>/assets/icons/mstile-310x150.png" />
<meta name="msapplication-square310x310logo" content="<?php echo FO_THEME_URL ;?>/assets/icons/mstile-310x310.png" />

<?php wp_head(); ?>
</head>

<?php
	$name = get_bloginfo( 'name', 'display' );
?>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead" class="header" role="banner">
		<div class="container">

			<div class="header--branding">
				<h1 class="header--title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php echo FO_THEME_URL.'/assets/img/logo.png';?>" alt="<?php echo $name;?>">
						<span>A Family Outside</span>
					</a>
				</h1>
			</div>

			<div class="header--branding__secondary">
				<span>Families that hike together stay together</span>
				<ul class="header--actions">
					<?php if ( is_user_logged_in() ){ ?>
						<li><a href="<?php echo wp_logout_url( get_permalink() );?>">Logout</a></li>
						<li><a href="<?php echo site_url('dashboard');?>" class="btn btn-primary btn-xs">Dashboard</a></li>
					<?php } else { ?>
						<li><a href="#" data-toggle="modal" data-target="#modal--login">Login</a></li>
						<li><a href="#" data-toggle="modal" data-target="#modal--create-account" class="btn btn-primary btn-xs">Signup</a></li>
					<?php } ?>
				</ul>
			</div>

			<div class="header--secondary">
				<nav id="header--navigation" class="header--navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
				</nav>
			</div>

		</div>
	</header>

	<?php if ( ('hikes' == get_post_type() || 'reviews' == get_post_type() || 'activities' == get_post_type() ) && is_single() ) {
		get_template_part('template-parts/object-mast');

	}
	?>
	<div id="content" class="container">
