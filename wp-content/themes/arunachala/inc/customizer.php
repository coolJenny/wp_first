<?php
/**
 * Arunachala Theme Customizer
 *
 * @package Arunachala
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function arunachala_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Add the featured content section in case it's not already there.
	$wp_customize->add_section( 'homepage_category', array(
        'title'          => __( 'Homepage Content Category', 'arunachala'),
		'description'   => __( 'Select a category for homepage.', 'arunachala'),		
        'priority'       => 130,
    ) );
	
	// Add the featured content category setting and control.
	$wp_customize->add_setting( 'category_dropdown_setting', array(
		'default'        => '-1',
		'sanitize_callback' => 'arunachala_sanitize_category',
	) );

	$wp_customize->add_control( new Category_Dropdown_Custom_control( $wp_customize, 'category_dropdown_setting', array(
		'section' => 'homepage_category',
	) ) );

}
add_action( 'customize_register', 'arunachala_customize_register' );

/**
 * Sanitize the Featured Content Category input. 
 */
function arunachala_sanitize_category( $input ) {
	$cat_list = get_terms('category', 'fields=ids');
	if ( ! in_array( $input, $cat_list )) {
		$input = '-1';
		}

	return $input;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function arunachala_customize_preview_js() {
	wp_enqueue_script( 'arunachala_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'arunachala_customize_preview_js' );
