<?php

class foPostMeta{

	function __construct(){

		add_action('cmb2_init',		array($this,'hiking_meta') );
		add_action('cmb2_init',		array($this,'product_meta') );
		add_action('cmb2_init',		array($this,'activity_meta') );
	}

	// Hike Metaboxes
	public static function hiking_meta(){

	    $cmb = new_cmb2_box( array(
	        'id'            => 'hike_meta',
	        'title'         => __( 'Hike Details', 'cmb2' ),
	        'object_types'  => array( 'hikes' ),
	        'context'       => 'normal',
	        'priority'      => 'high',
	        'show_names'    => true,
	    ) );

	    $cmb->add_field( array(
	        'name'       => 'Hike Length',
	        'desc'       => 'Length of the hike in miles (ex: 2.2)',
	        'id'         => '_hike_length',
	        'type'       => 'text'
	    ) );

	    $cmb->add_field( array(
	        'name'       => 'Hike Time',
	        'desc'       => 'Time it takes to complete the hike in minutes (ex: 120)',
	        'id'         => '_hike_time',
	        'type'       => 'text'
	    ) );

    	$cmb->add_field( array(
	        'name'       => 'Hike Location',
	        'desc'       => 'GPS Coordinates for Hike Location',
	        'id'         => '_hike_location',
	        'type'       => 'text'
	    ) );

    	$cmb->add_field( array(
	        'name'       => 'Hike Location Description',
	        'desc'       => 'Description of how to get to hike area',
	        'id'         => '_hike_location_desc',
	        'type'       => 'textarea'
	    ) );

    	$cmb->add_field( array(
	        'name'       => 'He Said',
	        'desc'       => 'The hike according to Nick',
	        'id'         => '_hike_he_said',
	        'type'       => 'textarea'
	    ) );

    	$cmb->add_field( array(
	        'name'       => 'She Said',
	        'desc'       => 'The hike according to Brandi',
	        'id'         => '_hike_she_said',
	        'type'       => 'textarea'
	    ) );

		$cmb->add_field( array(
		    'name' => 'Hike Gallery Images',
		    'desc' => 'Upload some images for this hike',
		    'id'   => '_object_gallery',
		    'type' => 'file_list',
		    'options' => array(
		        'add_upload_files_text' 	=> 'Add or Upload Images', // default: "Add or Upload Files"
		        'file_text' 				=> 'Image', // default: "File:"
		    )
		) );

		$cmb->add_field( array(
	        'name'       => 'Featured Image Background Positioning (optional)',
	        'desc'       => 'Positioning for featured image',
	        'id'         => '_feat_img_position',
	        'type'       => 'text'
	    ) );

	}

	// Product Review Metaboxes
	public static function product_meta(){

	    $cmb = new_cmb2_box( array(
	        'id'            => 'product_meta',
	        'title'         => __( 'Product Review Details', 'cmb2' ),
	        'object_types'  => array( 'reviews' ),
	        'context'       => 'normal',
	        'priority'      => 'high',
	        'show_names'    => true,
	    ) );

	    $cmb->add_field( array(
	        'name'       => 'Product Price',
	        'desc'       => 'Price of the product (ex: 25)',
	        'id'         => '_product_price',
	        'type'       => 'text'
	    ) );

	    $cmb->add_field( array(
	        'name'       => 'Product Manufacturer',
	        'desc'       => 'Name of the company who makes the product',
	        'id'         => '_product_company',
	        'type'       => 'text'
	    ) );

	    $cmb->add_field( array(
	        'name'       => 'Product TLDR;',
	        'desc'       => 'Give a summary, for those users who are too lazy to read the whole review.',
	        'id'         => '_product_summary',
	        'type'       => 'wysiwyg'
	    ) );

		$cmb->add_field( array(
	        'name'       => 'Featured Image Background Positioning (optional)',
	        'desc'       => 'Positioning for featured image',
	        'id'         => '_feat_img_position',
	        'type'       => 'text'
	    ) );

		$cmb->add_field( array(
		    'name' => 'Hike Gallery Images',
		    'desc' => 'Upload some images for this hike',
		    'id'   => '_object_gallery',
		    'type' => 'file_list',
		    'options' => array(
		        'add_upload_files_text' 	=> 'Add or Upload Images', // default: "Add or Upload Files"
		        'file_text' 				=> 'Image', // default: "File:"
		    )
		) );

	}

	// Activities Metaboxes
	public static function activity_meta(){

	    $cmb = new_cmb2_box( array(
	        'id'            => 'activity_meta',
	        'title'         => __( 'Activity Details', 'cmb2' ),
	        'object_types'  => array( 'activities' ),
	        'context'       => 'normal',
	        'priority'      => 'high',
	        'show_names'    => true,
	    ) );

    	$cmb->add_field( array(
	        'name'       => 'Hike Location',
	        'desc'       => 'GPS Coordinates for Hike Location',
	        'id'         => '_hike_location',
	        'type'       => 'text'
	    ) );

    	$cmb->add_field( array(
	        'name'       => 'Hike Location Description',
	        'desc'       => 'Description of how to get to hike area',
	        'id'         => '_hike_location_desc',
	        'type'       => 'textarea'
	    ) );

		$cmb->add_field( array(
	        'name'       => 'Featured Image Background Positioning (optional)',
	        'desc'       => 'Positioning for featured image',
	        'id'         => '_feat_img_position',
	        'type'       => 'text'
	    ) );

		$cmb->add_field( array(
		    'name' => 'Gallery Images',
		    'desc' => 'Upload some images for this hike',
		    'id'   => '_object_gallery',
		    'type' => 'file_list',
		    'options' => array(
		        'add_upload_files_text' 	=> 'Add or Upload Images', // default: "Add or Upload Files"
		        'file_text' 				=> 'Image', // default: "File:"
		    )
		) );

	}
}
new foPostMeta;