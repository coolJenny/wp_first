<?php
/**
 * nitro Theme Customizer
 *
 * @package nitro
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function nitro_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	
	//Header Settings
	$wp_customize->add_panel( 'nitro_header_panel', array(
	    'priority'       => 35,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => 'Header Settings',
	) );
	
	
	$wp_customize->add_section( 'header_image' , array(
	    'title'      => __( 'Header Image', 'nitro' ),
	    'panel' => 'nitro_header_panel',
	    'priority'   => 1,
	) );
	
	$wp_customize->add_section( 'nitro_header_text' , array(
	    'title'      => __( 'Header Text', 'nitro' ),
	    'panel' => 'nitro_header_panel',
	    'description' => __('This section will work only if an Header Image is set.','nitro'),
	    'priority'   => 2,
	) );
	
	$wp_customize->add_setting(
		'nitro_header_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'nitro_header_title', array(
		    'settings' => 'nitro_header_title',
		    'label'    => __( 'Main Header Title','nitro' ),
		    'section'  => 'nitro_header_text',
		    'type'     => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'nitro_header_desc',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'nitro_header_desc', array(
		    'settings' => 'nitro_header_desc',
		    'label'    => __( 'Header Description','nitro' ),
		    'section'  => 'nitro_header_text',
		    'type'     => 'textarea',
		)
	);
	
	$wp_customize->add_setting(
		'nitro_header_btn1',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'nitro_header_btn1', array(
		    'settings' => 'nitro_header_btn1',
		    'label'    => __( 'Button 1 Text','nitro' ),
		    'section'  => 'nitro_header_text',
		    'type'     => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'nitro_header_btn1_url',
		array( 'sanitize_callback' => 'esc_url_raw' )
	);
	
	$wp_customize->add_control(
			'nitro_header_btn1_url', array(
		    'settings' => 'nitro_header_btn1_url',
		    'label'    => __( 'Button 1 URL','nitro' ),
		    'section'  => 'nitro_header_text',
		    'type'     => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'nitro_header_btn2',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'nitro_header_btn2', array(
		    'settings' => 'nitro_header_btn2',
		    'label'    => __( 'Button 2 Text','nitro' ),
		    'section'  => 'nitro_header_text',
		    'type'     => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'nitro_header_btn2_url',
		array( 'sanitize_callback' => 'esc_url_raw' )
	);
	
	$wp_customize->add_control(
			'nitro_header_btn2_url', array(
		    'settings' => 'nitro_header_btn2_url',
		    'label'    => __( 'Button 2 URL','nitro' ),
		    'section'  => 'nitro_header_text',
		    'type'     => 'text',
		)
	);
	
	
	
	
	
	
	
	//Logo Settings
	$wp_customize->add_section( 'title_tagline' , array(
	    'title'      => __( 'Title, Tagline & Logo', 'nitro' ),
	    'priority'   => 30,
	) );
	
	$wp_customize->add_setting( 'nitro_logo_resize' , array(
	    'default'     => 100,
	    'sanitize_callback' => 'nitro_sanitize_positive_number',
	) );
	$wp_customize->add_control(
	        'nitro_logo_resize',
	        array(
	            'label' => __('Resize & Adjust Logo','nitro'),
	            'section' => 'title_tagline',
	            'settings' => 'nitro_logo_resize',
	            'priority' => 6,
	            'type' => 'range',
	            'active_callback' => 'nitro_logo_enabled',
	            'input_attrs' => array(
			        'min'   => 30,
			        'max'   => 200,
			        'step'  => 5,
			    ),
	        )
	);
	
	function nitro_logo_enabled($control) {
		$option = $control->manager->get_setting('custom_logo');
		return $option->value() == true;
	}
	
	
	
	//Replace Header Text Color with, separate colors for Title and Description
	//Override nitro_site_titlecolor
	$wp_customize->remove_control('display_header_text');
	$wp_customize->remove_setting('header_textcolor');
	$wp_customize->add_setting('nitro_site_titlecolor', array(
	    'default'     => '#333333',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'nitro_site_titlecolor', array(
			'label' => __('Site Title Color','nitro'),
			'section' => 'colors',
			'settings' => 'nitro_site_titlecolor',
			'type' => 'color'
		) ) 
	);
	
	$wp_customize->add_setting('nitro_header_desccolor', array(
	    'default'     => '#777777',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'nitro_header_desccolor', array(
			'label' => __('Site Tagline Color','nitro'),
			'section' => 'colors',
			'settings' => 'nitro_header_desccolor',
			'type' => 'color'
		) ) 
	);
	
	//Settings For Logo Area
	
	$wp_customize->add_setting(
		'nitro_hide_title_tagline',
		array( 'sanitize_callback' => 'nitro_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'nitro_hide_title_tagline', array(
		    'settings' => 'nitro_hide_title_tagline',
		    'label'    => __( 'Hide Title and Tagline.', 'nitro' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		)
	);
		
	function nitro_title_visible( $control ) {
		$option = $control->manager->get_setting('nitro_hide_title_tagline');
	    return $option->value() == false ;
	}
	
	//OVERLAP SLIDER
	$wp_customize->add_section(
	    'nitro_overlap_slider',
	    array(
	        'title'     => __('OverLap Slider','nitro'),
	        'priority'  => 35,
	    )
	);
	
	$wp_customize->add_setting(
		'nitro_overlap_cat_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'nitro_overlap_cat_title', array(
		    'settings' => 'nitro_overlap_cat_title',
		    'label'    => __( 'Title for the Slider', 'nitro' ),
		    'section'  => 'nitro_overlap_slider',
		    'type'     => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'nitro_overlap_enable',
		array( 'sanitize_callback' => 'nitro_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'nitro_overlap_enable', array(
		    'settings' => 'nitro_overlap_enable',
		    'label'    => __( 'Enable', 'nitro' ),
		    'section'  => 'nitro_overlap_slider',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		    'nitro_overlap_cat',
		    array( 'sanitize_callback' => 'nitro_sanitize_category' )
		);
	
		
	$wp_customize->add_control(
	    new Nitro_WP_Customize_Category_Control(
	        $wp_customize,
	        'nitro_overlap_cat',
	        array(
	            'label'    => __('Category','nitro'),
	            'settings' => 'nitro_overlap_cat',
	            'section'  => 'nitro_overlap_slider'
	        )
	    )
	);
		
	
	//CUSTOM SHOWCASE
	$wp_customize->add_panel( 'nitro_showcase_panel', array(
	    'priority'       => 35,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => 'Custom Showcase',
	) );
	
	$wp_customize->add_section(
	    'nitro_sec_showcase_options',
	    array(
	        'title'     => __('Enable/Disable','nitro'),
	        'priority'  => 0,
	        'panel'     => 'nitro_showcase_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'nitro_showcase_enable',
		array( 'sanitize_callback' => 'nitro_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'nitro_showcase_enable', array(
		    'settings' => 'nitro_showcase_enable',
		    'label'    => __( 'Enable Showcase on Front Page.', 'nitro' ),
		    'section'  => 'nitro_sec_showcase_options',
		    'type'     => 'checkbox',
		)
	);
	
		
	$wp_customize->add_setting(
		'nitro_showcase_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'nitro_showcase_title', array(
		    'settings' => 'nitro_showcase_title',
		    'label'    => __( 'Title','nitro' ),
		    'section'  => 'nitro_sec_showcase_options',
		    'type'     => 'text',
		)
	);

	
	for ( $i = 1 ; $i <= 3 ; $i++ ) :
		
		//Create the settings Once, and Loop through it.
		$wp_customize->add_section(
		    'nitro_showcase_sec'.$i,
		    array(
		        'title'     => 'ShowCase '.$i,
		        'priority'  => $i,
		        'panel'     => 'nitro_showcase_panel',
		        
		    )
		);	
		
		$wp_customize->add_setting(
			'nitro_showcase_img'.$i,
			array( 'sanitize_callback' => 'esc_url_raw' )
		);
		
		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'nitro_showcase_img'.$i,
		        array(
		            'label' => '',
		            'section' => 'nitro_showcase_sec'.$i,
		            'settings' => 'nitro_showcase_img'.$i,			       
		        )
			)
		);
		
		$wp_customize->add_setting(
			'nitro_showcase_title'.$i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'nitro_showcase_title'.$i, array(
			    'settings' => 'nitro_showcase_title'.$i,
			    'label'    => __( 'Showcase Title','nitro' ),
			    'section'  => 'nitro_showcase_sec'.$i,
			    'type'     => 'text',
			)
		);
		
		$wp_customize->add_setting(
			'nitro_showcase_desc'.$i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'nitro_showcase_desc'.$i, array(
			    'settings' => 'nitro_showcase_desc'.$i,
			    'label'    => __( 'Showcase Description','nitro' ),
			    'section'  => 'nitro_showcase_sec'.$i,
			    'type'     => 'text',
			)
		);
		
		
		$wp_customize->add_setting(
			'nitro_showcase_url'.$i,
			array( 'sanitize_callback' => 'esc_url_raw' )
		);
		
		$wp_customize->add_control(
				'nitro_showcase_url'.$i, array(
			    'settings' => 'nitro_showcase_url'.$i,
			    'label'    => __( 'Target URL','nitro' ),
			    'section'  => 'nitro_showcase_sec'.$i,
			    'type'     => 'url',
			)
		);
		
	endfor;	
		
		
	//WOOCOMMERCE ENABLED STUFF
	if ( class_exists('woocommerce') ) :
	// CREATE THE fcp PANEL
	$wp_customize->add_panel( 'nitro_fcp_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => 'Featured Product Showcase',
	    'description'    => '',
	) );
	
	
	//SQUARE BOXES
	$wp_customize->add_section(
	    'nitro_fc_boxes',
	    array(
	        'title'     => 'Square Boxes',
	        'priority'  => 10,
	        'panel'     => 'nitro_fcp_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'nitro_box_enable',
		array( 'sanitize_callback' => 'nitro_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'nitro_box_enable', array(
		    'settings' => 'nitro_box_enable',
		    'label'    => __( 'Enable Square Boxes & Posts Slider.', 'nitro' ),
		    'section'  => 'nitro_fc_boxes',
		    'type'     => 'checkbox',
		)
	);
	
 
	$wp_customize->add_setting(
		'nitro_box_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'nitro_box_title', array(
		    'settings' => 'nitro_box_title',
		    'label'    => __( 'Title for the Boxes','nitro' ),
		    'section'  => 'nitro_fc_boxes',
		    'type'     => 'text',
		)
	);
 
 	$wp_customize->add_setting(
	    'nitro_box_cat',
	    array( 'sanitize_callback' => 'nitro_sanitize_product_category' )
	);
	
	$wp_customize->add_control(
	    new Nitro_WP_Customize_Product_Category_Control(
	        $wp_customize,
	        'nitro_box_cat',
	        array(
	            'label'    => __('Product Category.','nitro'),
	            'settings' => 'nitro_box_cat',
	            'section'  => 'nitro_fc_boxes'
	        )
	    )
	);
	
		
	//SLIDER
	$wp_customize->add_section(
	    'nitro_fc_slider',
	    array(
	        'title'     => __('3D Cube Products Slider','nitro'),
	        'priority'  => 10,
	        'panel'     => 'nitro_fcp_panel',
	        'description' => 'This is the Posts Slider, displayed left to the square boxes.',
	    )
	);
	
	
	$wp_customize->add_setting(
		'nitro_slider_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'nitro_slider_title', array(
		    'settings' => 'nitro_slider_title',
		    'label'    => __( 'Title for the Slider', 'nitro' ),
		    'section'  => 'nitro_fc_slider',
		    'type'     => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'nitro_slider_count',
		array( 'sanitize_callback' => 'nitro_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'nitro_slider_count', array(
		    'settings' => 'nitro_slider_count',
		    'label'    => __( 'No. of Posts(Min:3, Max: 10)', 'nitro' ),
		    'section'  => 'nitro_fc_slider',
		    'type'     => 'range',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 10,
		        'step'  => 1,
		        'class' => 'test-class test',
		        'style' => 'color: #0a0',
		    ),
		)
	);
		
	$wp_customize->add_setting(
		    'nitro_slider_cat',
		    array( 'sanitize_callback' => 'nitro_sanitize_product_category' )
		);
		
	$wp_customize->add_control(
	    new Nitro_WP_Customize_Product_Category_Control(
	        $wp_customize,
	        'nitro_slider_cat',
	        array(
	            'label'    => __('Category For Slider.','nitro'),
	            'settings' => 'nitro_slider_cat',
	            'section'  => 'nitro_fc_slider'
	        )
	    )
	);
	
	
	
	//COVERFLOW
	
	$wp_customize->add_section(
	    'nitro_fc_coverflow',
	    array(
	        'title'     => __('Top CoverFlow Slider','nitro'),
	        'priority'  => 5,
	        'panel'     => 'nitro_fcp_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'nitro_coverflow_enable',
		array( 'sanitize_callback' => 'nitro_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'nitro_coverflow_enable', array(
		    'settings' => 'nitro_coverflow_enable',
		    'label'    => __( 'Enable', 'nitro' ),
		    'section'  => 'nitro_fc_coverflow',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'nitro_coverflow_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'nitro_coverflow_title', array(
		    'settings' => 'nitro_box_title',
		    'label'    => __( 'Title for the Boxes','nitro' ),
		    'section'  => 'nitro_fc_boxes',
		    'type'     => 'text',
		)
	);
	
	$wp_customize->add_setting(
		    'nitro_coverflow_cat',
		    array( 'sanitize_callback' => 'nitro_sanitize_product_category' )
		);
	
		
	$wp_customize->add_control(
	    new Nitro_WP_Customize_Product_Category_Control(
	        $wp_customize,
	        'nitro_coverflow_cat',
	        array(
	            'label'    => __('Category For Image Grid','nitro'),
	            'settings' => 'nitro_coverflow_cat',
	            'section'  => 'nitro_fc_coverflow'
	        )
	    )
	);
	
	$wp_customize->add_setting(
		'nitro_coverflow_pc',
		array( 'sanitize_callback' => 'nitro_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'nitro_coverflow_pc', array(
		    'settings' => 'nitro_coverflow_pc',
		    'label'    => __( 'Max No. of Posts in the Grid. Min: 5.', 'nitro' ),
		    'section'  => 'nitro_fc_coverflow',
		    'type'     => 'number',
		    'default'  => '0'
		)
	);
	
	endif; //end class exists woocommerce
	
	
	//Extra Panel for Users, who do and dont have WooCommerce
	
	// CREATE THE fcp PANEL
	$wp_customize->add_panel( 'nitro_a_fcp_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => 'Featured Posts Showcase',
	    'description'    => '',
	) );
	
	
	//SQUARE BOXES
	$wp_customize->add_section(
	    'nitro_a_fc_boxes',
	    array(
	        'title'     => 'Square Boxes',
	        'priority'  => 10,
	        'panel'     => 'nitro_a_fcp_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'nitro_a_box_enable',
		array( 'sanitize_callback' => 'nitro_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'nitro_a_box_enable', array(
		    'settings' => 'nitro_a_box_enable',
		    'label'    => __( 'Enable Square Boxes & Posts Slider.', 'nitro' ),
		    'section'  => 'nitro_a_fc_boxes',
		    'type'     => 'checkbox',
		)
	);
	
 
	$wp_customize->add_setting(
		'nitro_a_box_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'nitro_a_box_title', array(
		    'settings' => 'nitro_a_box_title',
		    'label'    => __( 'Title for the Boxes','nitro' ),
		    'section'  => 'nitro_a_fc_boxes',
		    'type'     => 'text',
		)
	);
 
 	$wp_customize->add_setting(
	    'nitro_a_box_cat',
	    array( 'sanitize_callback' => 'nitro_sanitize_product_category' )
	);
	
	$wp_customize->add_control(
	    new Nitro_WP_Customize_Category_Control(
	        $wp_customize,
	        'nitro_a_box_cat',
	        array(
	            'label'    => __('Posts Category.','nitro'),
	            'settings' => 'nitro_a_box_cat',
	            'section'  => 'nitro_a_fc_boxes'
	        )
	    )
	);
	
		
	//SLIDER
	$wp_customize->add_section(
	    'nitro_a_fc_slider',
	    array(
	        'title'     => __('3D Cube Products Slider','nitro'),
	        'priority'  => 10,
	        'panel'     => 'nitro_a_fcp_panel',
	        'description' => 'This is the Posts Slider, displayed left to the square boxes.',
	    )
	);
	
	
	$wp_customize->add_setting(
		'nitro_a_slider_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'nitro_a_slider_title', array(
		    'settings' => 'nitro_a_slider_title',
		    'label'    => __( 'Title for the Slider', 'nitro' ),
		    'section'  => 'nitro_a_fc_slider',
		    'type'     => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'nitro_a_slider_count',
		array( 'sanitize_callback' => 'nitro_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'nitro_a_slider_count', array(
		    'settings' => 'nitro_a_slider_count',
		    'label'    => __( 'No. of Posts(Min:3, Max: 10)', 'nitro' ),
		    'section'  => 'nitro_a_fc_slider',
		    'type'     => 'range',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 10,
		        'step'  => 1,
		        'class' => 'test-class test',
		        'style' => 'color: #0a0',
		    ),
		)
	);
		
	$wp_customize->add_setting(
		    'nitro_a_slider_cat',
		    array( 'sanitize_callback' => 'nitro_sanitize_product_category' )
		);
		
	$wp_customize->add_control(
	    new Nitro_WP_Customize_Category_Control(
	        $wp_customize,
	        'nitro_a_slider_cat',
	        array(
	            'label'    => __('Category For Slider.','nitro'),
	            'settings' => 'nitro_a_slider_cat',
	            'section'  => 'nitro_a_fc_slider'
	        )
	    )
	);
	
	
	
	//COVERFLOW
	
	$wp_customize->add_section(
	    'nitro_a_fc_coverflow',
	    array(
	        'title'     => __('Top CoverFlow Slider','nitro'),
	        'priority'  => 5,
	        'panel'     => 'nitro_a_fcp_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'nitro_a_coverflow_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'nitro_a_coverflow_title', array(
		    'settings' => 'nitro_a_coverflow_title',
		    'label'    => __( 'Title for the Coverflow', 'nitro' ),
		    'section'  => 'nitro_a_fc_coverflow',
		    'type'     => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'nitro_a_coverflow_enable',
		array( 'sanitize_callback' => 'nitro_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'nitro_a_coverflow_enable', array(
		    'settings' => 'nitro_a_coverflow_enable',
		    'label'    => __( 'Enable', 'nitro' ),
		    'section'  => 'nitro_a_fc_coverflow',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		    'nitro_a_coverflow_cat',
		    array( 'sanitize_callback' => 'nitro_sanitize_category' )
		);
	
		
	$wp_customize->add_control(
	    new Nitro_WP_Customize_Category_Control(
	        $wp_customize,
	        'nitro_a_coverflow_cat',
	        array(
	            'label'    => __('Category For Image Grid','nitro'),
	            'settings' => 'nitro_a_coverflow_cat',
	            'section'  => 'nitro_a_fc_coverflow'
	        )
	    )
	);
	
	$wp_customize->add_setting(
		'nitro_a_coverflow_pc',
		array( 'sanitize_callback' => 'nitro_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'nitro_a_coverflow_pc', array(
		    'settings' => 'nitro_a_coverflow_pc',
		    'label'    => __( 'Max No. of Posts in the Grid. Min: 5.', 'nitro' ),
		    'section'  => 'nitro_a_fc_coverflow',
		    'type'     => 'number',
		    'default'  => '0'
		)
	);
	
	
	// Layout and Design
	$wp_customize->add_panel( 'nitro_design_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Design & Layout','nitro'),
	) );
	
	$wp_customize->add_section(
	    'nitro_design_options',
	    array(
	        'title'     => __('Blog Layout','nitro'),
	        'priority'  => 0,
	        'panel'     => 'nitro_design_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'nitro_blog_layout',
		array( 'sanitize_callback' => 'nitro_sanitize_blog_layout' )
	);
	
	function nitro_sanitize_blog_layout( $input ) {
		if ( in_array($input, array('grid','grid_2_column','nitro','nitro_3_column','store','store_3_column') ) )
			return $input;
		else 
			return '';	
	}
	
	$wp_customize->add_control(
		'nitro_blog_layout',array(
				'label' => __('Select Layout','nitro'),
				'settings' => 'nitro_blog_layout',
				'section'  => 'nitro_design_options',
				'type' => 'select',
				'choices' => array(
						'grid' => __('Standard Blog Layout','nitro'),
						'nitro' => __('Nitro Theme Layout','nitro'),
						'nitro_3_column' => __('Nitro Theme Layout (3 Columns)','nitro'),
						'grid_2_column' => __('Grid - 2 Column','nitro'),
						'store' => __('Store Theme Layouts','nitro'),
						'store_3_column' => __('Store Theme Layout (3 Column)','nitro'),
					)
			)
	);
	
	$wp_customize->add_section(
	    'nitro_sidebar_options',
	    array(
	        'title'     => __('Sidebar Layout','nitro'),
	        'priority'  => 0,
	        'panel'     => 'nitro_design_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'nitro_disable_sidebar',
		array( 'sanitize_callback' => 'nitro_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'nitro_disable_sidebar', array(
		    'settings' => 'nitro_disable_sidebar',
		    'label'    => __( 'Disable Sidebar Everywhere.','nitro' ),
		    'section'  => 'nitro_sidebar_options',
		    'type'     => 'checkbox',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'nitro_disable_sidebar_home',
		array( 'sanitize_callback' => 'nitro_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'nitro_disable_sidebar_home', array(
		    'settings' => 'nitro_disable_sidebar_home',
		    'label'    => __( 'Disable Sidebar on Home/Blog.','nitro' ),
		    'section'  => 'nitro_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'nitro_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'nitro_disable_sidebar_front',
		array( 'sanitize_callback' => 'nitro_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'nitro_disable_sidebar_front', array(
		    'settings' => 'nitro_disable_sidebar_front',
		    'label'    => __( 'Disable Sidebar on Front Page.','nitro' ),
		    'section'  => 'nitro_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'nitro_show_sidebar_options',
		    'default'  => false
		)
	);
	
	
	$wp_customize->add_setting(
		'nitro_sidebar_width',
		array(
			'default' => 4,
		    'sanitize_callback' => 'nitro_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'nitro_sidebar_width', array(
		    'settings' => 'nitro_sidebar_width',
		    'label'    => __( 'Sidebar Width','nitro' ),
		    'description' => __('Min: 25%, Default: 33%, Max: 40%','nitro'),
		    'section'  => 'nitro_sidebar_options',
		    'type'     => 'range',
		    'active_callback' => 'nitro_show_sidebar_options',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 5,
		        'step'  => 1,
		        'class' => 'sidebar-width-range',
		        'style' => 'color: #0a0',
		    ),
		)
	);
	
	/* Active Callback Function */
	function nitro_show_sidebar_options($control) {
	   
	    $option = $control->manager->get_setting('nitro_disable_sidebar');
	    return $option->value() == false ;
	    
	}
	
	class Nitro_Custom_CSS_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	                <textarea rows="8" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	            </label>
	        <?php
	    }
	}
	
	$wp_customize-> add_section(
    'nitro_custom_codes',
    array(
    	'title'			=> __('Custom CSS','nitro'),
    	'description'	=> __('Enter your Custom CSS to Modify design.','nitro'),
    	'priority'		=> 11,
    	'panel'			=> 'nitro_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'nitro_custom_css',
	array(
		'default'		=> '',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'wp_filter_nohtml_kses',
		'sanitize_js_callback' => 'wp_filter_nohtml_kses'
		)
	);
	
	$wp_customize->add_control(
	    new Nitro_Custom_CSS_Control(
	        $wp_customize,
	        'nitro_custom_css',
	        array(
	            'section' => 'nitro_custom_codes',
	            'settings' => 'nitro_custom_css'
	        )
	    )
	);
	
	function nitro_sanitize_text( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}
	
	$wp_customize-> add_section(
    'nitro_custom_footer',
    array(
    	'title'			=> __('Custom Footer Text','nitro'),
    	'description'	=> __('Enter your Own Copyright Text.','nitro'),
    	'priority'		=> 11,
    	'panel'			=> 'nitro_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'nitro_footer_text',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'nitro_footer_text',
	        array(
	            'section' => 'nitro_custom_footer',
	            'settings' => 'nitro_footer_text',
	            'type' => 'text'
	        )
	);	
	
	
	//Select the Default Theme Skin
	$wp_customize->add_section(
	    'nitro_skin_options',
	    array(
	        'title'     => __('Choose Skin','nitro'),
	        'priority'  => 39,
	    )
	);
	
	$wp_customize->add_setting(
		'nitro_skin',
		array(
			'default'=> 'default',
			'sanitize_callback' => 'nitro_sanitize_skin' 
			)
	);
	
	$skins = array( 'default' => __('Default(Orange/Brown)','nitro'),
					'orange' =>  __('Orange/Blue','nitro'),
					'brown' =>  __('Fade Green/Brown','nitro'),
					'green' => __('Brick/Fade Green','nitro'),
					'grayscale' => __('GrayScale','nitro') );
	
	$wp_customize->add_control(
		'nitro_skin',array(
				'settings' => 'nitro_skin',
				'section'  => 'nitro_skin_options',
				'type' => 'select',
				'choices' => $skins,
			)
	);
	
	function nitro_sanitize_skin( $input ) {
		if ( in_array($input, array('default','orange','brown','green','grayscale') ) )
			return $input;
		else
			return '';
	}
	
	
	//Fonts
	$wp_customize->add_section(
	    'nitro_typo_options',
	    array(
	        'title'     => __('Google Web Fonts','nitro'),
	        'priority'  => 41,
	        'description' => __('Defaults: Open Sans.','nitro')
	    )
	);
	
	$font_array = array('Open Sans','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','Source Sans Pro','PT Sans','Ubuntu','Lobster','Arimo','Bitter','Noto Sans');
	$fonts = array_combine($font_array, $font_array);
	
	$wp_customize->add_setting(
		'nitro_title_font',
		array(
			'default'=> 'Lato',
			'sanitize_callback' => 'nitro_sanitize_gfont' 
			)
	);
	
	function nitro_sanitize_gfont( $input ) {
		if ( in_array($input, array('Open Sans','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','Source Sans Pro','PT Sans','Ubuntu','Lobster','Arimo','Bitter','Noto Sans') ) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_control(
		'nitro_title_font',array(
				'label' => __('Title','nitro'),
				'settings' => 'nitro_title_font',
				'section'  => 'nitro_typo_options',
				'type' => 'select',
				'choices' => $fonts,
			)
	);
	
	$wp_customize->add_setting(
		'nitro_body_font',
			array(	'default'=> 'Open Sans',
					'sanitize_callback' => 'nitro_sanitize_gfont' )
	);
	
	$wp_customize->add_control(
		'nitro_body_font',array(
				'label' => __('Body','nitro'),
				'settings' => 'nitro_body_font',
				'section'  => 'nitro_typo_options',
				'type' => 'select',
				'choices' => $fonts
			)
	);
	
	// Social Icons
	$wp_customize->add_section('nitro_social_section', array(
			'title' => __('Social Icons','nitro'),
			'priority' => 44 ,
	));
	
	$social_networks = array( //Redefinied in Sanitization Function.
					'none' => __('-','nitro'),
					'facebook' => __('Facebook','nitro'),
					'twitter' => __('Twitter','nitro'),
					'google-plus' => __('Google Plus','nitro'),
					'instagram' => __('Instagram','nitro'),
					'rss' => __('RSS Feeds','nitro'),
					'vine' => __('Vine','nitro'),
					'vimeo-square' => __('Vimeo','nitro'),
					'youtube' => __('Youtube','nitro'),
					'flickr' => __('Flickr','nitro'),
				);
				
	$social_count = count($social_networks);
				
	for ($x = 1 ; $x <= ($social_count - 3) ; $x++) :
			
		$wp_customize->add_setting(
			'nitro_social_'.$x, array(
				'sanitize_callback' => 'nitro_sanitize_social',
				'default' => 'none'
			));

		$wp_customize->add_control( 'nitro_social_'.$x, array(
					'settings' => 'nitro_social_'.$x,
					'label' => __('Icon ','nitro').$x,
					'section' => 'nitro_social_section',
					'type' => 'select',
					'choices' => $social_networks,			
		));
		
		$wp_customize->add_setting(
			'nitro_social_url'.$x, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'nitro_social_url'.$x, array(
					'settings' => 'nitro_social_url'.$x,
					'description' => __('Icon ','nitro').$x.__(' Url','nitro'),
					'section' => 'nitro_social_section',
					'type' => 'url',
					'choices' => $social_networks,			
		));
		
	endfor;
	
	function nitro_sanitize_social( $input ) {
		$social_networks = array(
					'none' ,
					'facebook',
					'twitter',
					'google-plus',
					'instagram',
					'rss',
					'vine',
					'vimeo-square',
					'youtube',
					'flickr'
				);
		if ( in_array($input, $social_networks) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_section(
	    'nitro_sec_upgrade',
	    array(
	        'title'     => __('Nitro Theme - Help & Support','nitro'),
	        'priority'  => 45,
	    )
	);
	
	$wp_customize->add_setting(
			'nitro_upgrade',
			array( 'sanitize_callback' => 'esc_textarea' )
		);
			
	$wp_customize->add_control(
	    new Nitro_WP_Customize_Upgrade_Control(
	        $wp_customize,
	        'nitro_upgrade',
	        array(
	            'label' => __('Thank You','nitro'),
	            'description' => __('Thank You for Choosing Nitro Theme by Rohitink.com. Nitro is a Powerful Wordpress theme which also supports WooCommerce in the best possible way. It is "as we say" the last theme you would ever need. It has all the basic and advanced features needed to run a gorgeous looking site. For any Help related to this theme, please visit  <a href="https://rohitink.com/2016/01/05/nitro-multipurpose-theme/">Nitro Help & Support</a>.','nitro'),
	            'section' => 'nitro_sec_upgrade',
	            'settings' => 'nitro_upgrade',			       
	        )
		)
	);
	
	
	/* Sanitization Functions Common to Multiple Settings go Here, Specific Sanitization Functions are defined along with add_setting() */
	function nitro_sanitize_checkbox( $input ) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}
	
	function nitro_sanitize_positive_number( $input ) {
		if ( ($input >= 0) && is_numeric($input) )
			return $input;
		else
			return '';	
	}
	
	function nitro_sanitize_category( $input ) {
		if ( term_exists(get_cat_name( $input ), 'category') )
			return $input;
		else 
			return '';	
	}
	
	function nitro_sanitize_product_category( $input ) {
		if ( get_term( $input, 'product_cat' ) )
			return $input;
		else 
			return '';	
	}
	
	
}
add_action( 'customize_register', 'nitro_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function nitro_customize_preview_js() {
	wp_enqueue_script( 'nitro_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'nitro_customize_preview_js' );
