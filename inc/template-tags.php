<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Family_Outside
 */

if ( ! function_exists( 'family_outside_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function family_outside_posted_on() {


	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	$author_id 			= get_post_field ('post_author', $post_id);
	$author 			= get_user_by('id', $author_id );
	$author_posts_url 	= esc_url( get_author_posts_url( $author_id ) );

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'family-outside' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'family-outside' ),
		'<span class="author vcard"><a class="url fn n" href="' . $author_posts_url . '">' . esc_html( $author->display_name ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'family_outside_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function family_outside_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'family-outside' ) );
		if ( $categories_list && family_outside_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'family-outside' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'family-outside' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'family-outside' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'family-outside' ), esc_html__( '1 Comment', 'family-outside' ), esc_html__( '% Comments', 'family-outside' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'family-outside' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function family_outside_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'family_outside_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'family_outside_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so family_outside_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so family_outside_categorized_blog should return false.
		return false;
	}
}