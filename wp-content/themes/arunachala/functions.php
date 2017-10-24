<?php
/**
 * Arunachala functions and definitions
 *
 * @package Arunachala
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 670; /* pixels */
}

if ( ! function_exists( 'arunachala_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function arunachala_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Arunachala, use a find and replace
	 * to change 'arunachala' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'arunachala', get_template_directory() . '/languages' );
	
	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css' ) );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'slider-thumb', 500, 300, true );
	add_image_size( 'featured-thumb', 300, 200, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'arunachala' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'arunachala_custom_background_args', array(
		'default-color' => 'fff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
}
endif; // arunachala_setup
add_action( 'after_setup_theme', 'arunachala_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function arunachala_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'arunachala' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'arunachala_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function arunachala_scripts() {
	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );

	wp_enqueue_style( 'arunachala-style', get_stylesheet_uri(), array( 'genericons' ) );

	wp_enqueue_script( 'arunachala-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	if ( is_front_page() || is_home () ) {
		wp_enqueue_script( 'arunachala-jquery-cycle', get_template_directory_uri() . '/js/jquery.tcycle.js', array( 'jquery' )  );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'arunachala_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/homepage-content.php';
/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
* Replaces the excerpt "more" text by a link
*/
function new_excerpt_more($more) {
       global $post;
	return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
* Setting escerpt length and read more link
*/
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function excerpt_read_more_link($output) {
 global $post;
 return $output . '<a class="more-link" href="'. get_permalink($post->ID) . '"> '.__("Read more", "arunachala").'</a>';
}
add_filter('the_excerpt', 'excerpt_read_more_link');

/**
* Modifying default query for homepage
*/
function arunachala_filter_pre_get_posts( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
        $sticky = get_option( 'sticky_posts' );
        $cat = get_theme_mod( 'category_dropdown_setting');
        //  Exclude sticky posts
        $query->set( 'ignore_sticky_posts', 1 );
        $query->set( 'post__not_in', $sticky );
		//  Display selected category posts from customizer
        $query->set( 'category__in', $cat );
    }
}
add_action( 'pre_get_posts', 'arunachala_filter_pre_get_posts' );