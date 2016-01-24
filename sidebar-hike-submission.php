<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Family_Outside
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<div class="submission-help-widget widget-area--inner">
		<h4>Submission Criteria</h4>
		<ol>
			<li>Be sure that your post content is descriptive. For example, if the trail has a fork, describe this and describe which way the hiker should take.</li>
			<li>Keep it family oriented! Remember, we are a website that caters to families who hike.</li>
			<li>If possible, try to include at least one image of your entire family! This is typically displayed as the last image in the gallery.</li>
		</ol>
	</div>
</aside><!-- #secondary -->
