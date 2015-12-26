<?php

class themeOptions {


	// add new options to new section
	public static function register($wp_customize){

		$wp_customize->add_section( 'fo_options', array(
			'title' => __( 'FO Options', 'novella' )
		) );

		$wp_customize->add_setting( 'featured_posts', array(
			'type' 		=> 'theme_mod',
		) );
		$wp_customize->add_control( 'featured_posts', array(
			'label' 	=> 'Featured Posts',
			'section' 	=> 'fo_options',
			'transport' => 'postMessage',
			'settings' 	=> 'featured_posts'
		) );

	}


}
// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'themeOptions' , 'register' ) );
