<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Family_Outside
 */

if ( ! is_active_sidebar( 'sidebar-comments' ) ) {
	return;
}
?>

<div class="widget-area--ads">
		<?php dynamic_sidebar( 'sidebar-comments' ); ?>
</div>

