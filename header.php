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
					<li><a href="#" data-toggle="modal" data-target="#modal--login">Login</a></li>
					<li><a href="#" data-toggle="modal" data-target="#modal--create-account" class="btn btn-primary btn-xs">Signup</a></li>
				</ul>
			</div>

			<div class="header--secondary">
				<nav id="header--navigation" class="header--navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
				</nav>
			</div>

		</div>
	</header>

	<?php if ( ('hikes' == get_post_type() || 'reviews' == get_post_type() ) && is_single() ) {
		get_template_part('template-parts/object-mast');

	}
	?>
	<div id="content" class="container">
