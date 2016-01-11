<?php
/**
 * Template part for displaying archive posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Family_Outside
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array('class' => 'post--archive')); ?>>
	<?php
	$category 		= fo_return_type_data()['label'];
	$class 			= fo_return_type_data()['class'];
	?>
	<div class="post--archive__image">
		<a href="<?php echo get_permalink();?>">
			<?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail' ); ?>
		</a>
	</div>

	<div class="post--archive__content">
		<?php the_title( '<h4 class="post--archive__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );?>
		<span class="label <?php echo sanitize_html_class( $class );?>"><?php echo esc_html( $category );?></span>
		<div class="post--archive__excerpt">
			<?php the_excerpt(); ?>
		</div>
		<p class="entry--meta">
			<?php family_outside_posted_on(); ?>
		</p>
	</div>

</article>
