<?php

class foPostMeta{

	function __construct(){

		add_action('cmb2_init',		array($this,'hiking_meta') );
		add_action('cmb2_init',		array($this,'product_meta') );
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
	        'name'       => 'Product Manufacturer',
	        'desc'       => 'Name of the company who makes the product',
	        'id'         => '_product_company',
	        'type'       => 'text'
	    ) );

	}
}
new foPostMeta;