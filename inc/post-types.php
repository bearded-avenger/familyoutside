<?php

class foPostTypes{

	function __construct(){

		add_action( 'init', 	array($this,'hike_type') );
		add_action( 'init', 	array($this,'review_type') );
	}


	function hike_type() {

		// Hikes
		$hike_labels = array(
			'name'                		=> 'Hikes',
			'singular_name'       		=> 'Hike',
			'menu_name'           		=> 'Hikes',
			'parent_item_colon'   		=> __( 'Parent Hike:', 'cgc-core' ),
			'all_items'           		=> __( 'All Hikes', 'cgc-core' ),
			'view_item'           		=> __( 'View Hike', 'cgc-core' ),
			'add_new_item'        		=> __( 'Add New Hike', 'cgc-core' ),
			'add_new'             		=> __( 'New Hike', 'cgc-core' ),
			'edit_item'           		=> __( 'Edit Hike', 'cgc-core' ),
			'update_item'         		=> __( 'Update Hike', 'cgc-core' ),
			'search_items'        		=> __( 'Search Hikes', 'cgc-core' ),
			'not_found'           		=> __( 'No Hikes found', 'cgc-core' ),
			'not_found_in_trash'  		=> __( 'No Hikes found in Trash', 'cgc-core' ),
		);
		$hike_args = array(
			'label'               		=> __( 'Hikes', 'cgc-core' ),
			'description'         		=> __( 'Create hiking reviews', 'cgc-core' ),
			'labels'              		=> $hike_labels,
			'supports'            		=> array( 'editor','title', 'comments', 'thumbnail'),
			'public'              		=> true,
 			'show_ui' 					=> true,
			'query_var' 				=> true,
			'can_export' 				=> true,
			'has_archive'				=> 'hikes',
			'taxonomies' 				=> array('hike_difficulty','hike_rating','hike_ages'),
			'rewrite'					=> array('with_front' => false, 'slug' => 'hike'),
			'capability_type' 			=> 'post'
		);

		register_post_type( 'hikes', $hike_args );


		//////////
		// Hike Difficulty
		///////////
		$hike_difficulty = array(
			'name'              => _x( 'Hike Difficulty', 'taxonomy general name' ),
			'singular_name'     => _x( 'Hike Difficulty', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Difficulties' ),
			'all_items'         => __( 'All Difficulties' ),
			'parent_item'       => __( 'Parent Difficulty' ),
			'parent_item_colon' => __( 'Parent Difficulty:' ),
			'edit_item'         => __( 'Edit Difficulty' ),
			'update_item'       => __( 'Update Difficulty' ),
			'add_new_item'      => __( 'Add New Difficulty' ),
			'new_item_name'     => __( 'New Difficulty' ),
			'menu_name'         => __( 'Hike Difficulty' ),
		);
		$hike_difficulty_args = array(
			'hierarchical'      => true,
			'labels'            => $hike_difficulty,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
		);

		register_taxonomy( 'hike_difficulty', 'hikes' ,$hike_difficulty_args );

		//////////
		// Hike Rating
		///////////
		$hike_rating = array(
			'name'              => _x( 'Hike Rating', 'taxonomy general name' ),
			'singular_name'     => _x( 'Hike Rating', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Ratings' ),
			'all_items'         => __( 'All Ratings' ),
			'parent_item'       => __( 'Parent Rating' ),
			'parent_item_colon' => __( 'Parent Rating:' ),
			'edit_item'         => __( 'Edit Rating' ),
			'update_item'       => __( 'Update Rating' ),
			'add_new_item'      => __( 'Add New Rating' ),
			'new_item_name'     => __( 'New Rating' ),
			'menu_name'         => __( 'Hike Rating' ),
		);
		$hike_rating_args = array(
			'hierarchical'      => true,
			'labels'            => $hike_rating,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
		);

		register_taxonomy( 'hike_rating', 'hikes' ,$hike_rating_args );

		//////////
		// Hike Ages
		///////////
		$hike_ages = array(
			'name'              => _x( 'Hike Age', 'taxonomy general name' ),
			'singular_name'     => _x( 'Hike Age', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Ages' ),
			'all_items'         => __( 'All Ages' ),
			'parent_item'       => __( 'Parent Age' ),
			'parent_item_colon' => __( 'Parent Age:' ),
			'edit_item'         => __( 'Edit Age' ),
			'update_item'       => __( 'Update Age' ),
			'add_new_item'      => __( 'Add New Age' ),
			'new_item_name'     => __( 'New Age' ),
			'menu_name'         => __( 'Hike Ages' ),
		);
		$hike_ages_args = array(
			'hierarchical'      => true,
			'labels'            => $hike_ages,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
		);

		register_taxonomy( 'hike_ages', 'hikes' ,$hike_ages_args );

	}

	function review_type() {

		// Reviews
		$labels = array(
			'name'                		=> 'Reviews',
			'singular_name'       		=> 'Review',
			'menu_name'           		=> 'Reviews',
			'parent_item_colon'   		=> __( 'Parent Review:', 'cgc-core' ),
			'all_items'           		=> __( 'All Reviews', 'cgc-core' ),
			'view_item'           		=> __( 'View Review', 'cgc-core' ),
			'add_new_item'        		=> __( 'Add New Review', 'cgc-core' ),
			'add_new'             		=> __( 'New Review', 'cgc-core' ),
			'edit_item'           		=> __( 'Edit Review', 'cgc-core' ),
			'update_item'         		=> __( 'Update Review', 'cgc-core' ),
			'search_items'        		=> __( 'Search Reviews', 'cgc-core' ),
			'not_found'           		=> __( 'No Reviews found', 'cgc-core' ),
			'not_found_in_trash'  		=> __( 'No Reviews found in Trash', 'cgc-core' ),
		);
		$args = array(
			'label'               		=> __( 'Reviews', 'cgc-core' ),
			'description'         		=> __( 'Create product reviews', 'cgc-core' ),
			'labels'              		=> $labels,
			'supports'            		=> array( 'editor','title', 'comments', 'thumbnail'),
			'public'              		=> true,
 			'show_ui' 					=> true,
			'query_var' 				=> true,
			'can_export' 				=> true,
			'has_archive'				=> 'product-reviews',
			'taxonomies' 				=> array('product_rating','product_category'),
			'rewrite'					=> array('with_front' => false, 'slug' => 'product-review'),
			'capability_type' 			=> 'post'
		);

		register_post_type( 'reviews', $args );


		//////////
		// Product Category
		///////////
		$cat_labels = array(
			'name'              => _x( 'Product Category', 'taxonomy general name' ),
			'singular_name'     => _x( 'Product Category', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Categories' ),
			'all_items'         => __( 'All Categories' ),
			'parent_item'       => __( 'Parent Category' ),
			'parent_item_colon' => __( 'Parent Category:' ),
			'edit_item'         => __( 'Edit Category' ),
			'update_item'       => __( 'Update Category' ),
			'add_new_item'      => __( 'Add New Category' ),
			'new_item_name'     => __( 'New Category' ),
			'menu_name'         => __( 'Product Category' ),
		);
		$cat_args = array(
			'hierarchical'      => true,
			'labels'            => $cat_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
		);

		register_taxonomy( 'product_category', 'reviews' ,$cat_args );

		//////////
		// Product Rating
		///////////
		$product_rating = array(
			'name'              => _x( 'Product Rating', 'taxonomy general name' ),
			'singular_name'     => _x( 'Product Rating', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Ratings' ),
			'all_items'         => __( 'All Ratings' ),
			'parent_item'       => __( 'Parent Rating' ),
			'parent_item_colon' => __( 'Parent Rating:' ),
			'edit_item'         => __( 'Edit Rating' ),
			'update_item'       => __( 'Update Rating' ),
			'add_new_item'      => __( 'Add New Rating' ),
			'new_item_name'     => __( 'New Rating' ),
			'menu_name'         => __( 'Product Rating' ),
		);
		$product_rating_args = array(
			'hierarchical'      => true,
			'labels'            => $product_rating,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
		);

		register_taxonomy( 'product_rating', 'reviews' ,$product_rating_args );


	}


}
new foPostTypes;