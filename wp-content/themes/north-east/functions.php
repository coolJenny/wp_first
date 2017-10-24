<?php
/**
 * Theme functions and definitions
 * 
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 */
 
	if ( ! isset( $content_width ) ) {
		$content_width = 1009;
	}

	/**
	 * Only works in WordPress 4.1 or later.
	 */
	if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
		require get_template_directory() . '/inc/back-compat.php';
	}

if ( ! function_exists( 'northeast_init' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 */
function northeast_init() {

	load_theme_textdomain( 'north-east', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );
		
		// Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 356, 325, true );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'north-east' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list'
		) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css') );
	
		add_image_size('northeast-recent_post_image',86,94, true); // // 86 pixels wide by 94 pixels tall, hard crop mode 
		add_image_size('northeast-related-post-image-sidebar',225,145, true); // // 225 pixels wide by 145 pixels tall, hard crop mode   
				
				
}
endif; // navthemes_init
add_action( 'after_setup_theme', 'northeast_init' );

	/**
	 * Sidebars.
	 *
	 */
	function northeast_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Default Widget Area', 'north-east' ),
			'id'            => 'main-sidebar',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'north-east' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s"  itemscope itemtype="http://schema.org/WPSideBar">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title heading" itemprop="about">',
			'after_title'   => '</h3>',
		) );
		
		register_sidebar( array(
			'name'          => __( 'Footer Sidebar', 'north-east' ),
			'id'            => 'footer-sidebar',
			'description'   => __( 'Add widgets here to appear in your footer area.', 'north-east' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s col-md-4 col-sm-4">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title heading" itemprop="about">',
			'after_title'   => '</h3>',
		) );
	}
	add_action( 'widgets_init', 'northeast_widgets_init' );

	/**
	 * Enqueue scripts and styles.
	 *
	 */
	function northeast_scripts() {
		global $wp_styles;
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
			
	
		// Loads our bootstrap.
		wp_enqueue_style( 'northeast-bootstrap-style', get_template_directory_uri(). '/assets/bootstrap/css/bootstrap.min.css' );
	
		// Loads the Font Awesome.
		wp_enqueue_style( 'northeast-fontawesome', get_template_directory_uri() . '/assets/custom/css/font-awesome.min.css', array( 'northeast-style' ));
	
		// Loads our main stylesheet.
		wp_enqueue_style( 'northeast-style', get_stylesheet_uri(), array( 'northeast-bootstrap-style' ) );
		
	   //Load html5Shiv
		wp_enqueue_script('northeast-html5',  get_template_directory_uri() . '/js/html5.js');
		wp_script_add_data('northeast-html5', 'conditional', 'lt IE 9');
		
		// Adds bootstrap JavaScript.
		wp_enqueue_script( 'northeast-bootstrap-js', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array( 'jquery' ) );
	
		// Adds JavaScript for handling the navigation menu hide-and-show behavior.
		wp_enqueue_script( 'northeast-navigation', get_template_directory_uri() . '/assets/menu/script.js', array( 'jquery' ), '20150217', true );
	
		// Custom JS
		wp_enqueue_script( 'northeast-custom', get_template_directory_uri() . '/assets/custom/js/custom.js');
	}
	
	add_action( 'wp_enqueue_scripts', 'northeast_scripts' );

if ( ! function_exists( 'northeast_fonts_url' ) ) :

function northeast_fonts_url() {
    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $Montserrat = _x( 'on', 'Montserrat font: on or off', 'north-east' );
 
    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $open_sans = _x( 'on', 'Open Sans font: on or off', 'north-east' );
 
    if ( 'off' !== $Montserrat || 'off' !== $open_sans ) {
        $font_families = array();
 
        if ( 'off' !== $Montserrat ) {
            $font_families[] = 'Montserrat';
        }
 
        if ( 'off' !== $open_sans ) {
            $font_families[] = 'Open Sans:700italic,400,800,600';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}

endif;

function northeast_scripts_styles() {
    wp_enqueue_style( 'northeast-fonts', northeast_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'northeast_scripts_styles' );	

	/**
	 * Add a `screen-reader-text` class to the search form's submit button.
	 */
	function northeast_search_form_modify( $html ) {
		return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
	}
	add_filter( 'get_search_form', 'northeast_search_form_modify' );
 

 
/* -----------------------------------------------------
 	Custom Functions
 -----------------------------------------------------
 */ 
	 // Navthemes Custom Function File
	require_once( dirname( __FILE__ ) . '/navthemes-functions.php' );
	
	/* -----------------------------------------------------
		Custom Excerpt
	   -----------------------------------------------------
	*/
	function northeast_custom_excerpt_length( $length ) {
		return 15;
	}
	add_filter( 'excerpt_length', 'northeast_custom_excerpt_length', 999 );