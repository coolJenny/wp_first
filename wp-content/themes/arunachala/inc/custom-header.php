<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>

 *
 * @package Arunachala
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses arunachala_header_style()
 * @uses arunachala_admin_header_style()
 * @uses arunachala_admin_header_image()
 *
 * @package Arunachala
 */
function arunachala_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'arunachala_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'fff',
		'width'                  => 960,
		'height'                 => 100,
		'flex-height'            => true,
		'wp-head-callback'       => 'arunachala_header_style',
		'admin-head-callback'    => 'arunachala_admin_header_style',
		'admin-preview-callback' => 'arunachala_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'arunachala_custom_header_setup' );

if ( ! function_exists( 'arunachala_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see arunachala_custom_header_setup().
 */
function arunachala_header_style() {
	$text_color = get_header_textcolor();

	// If no custom color for text is set, let's bail.
	if ( display_header_text() && $text_color === get_theme_support( 'custom-header', 'default-text-color' ) )
		return;

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a {
			color: #<?php echo $text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // arunachala_header_style

if ( ! function_exists( 'arunachala_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see arunachala_custom_header_setup().
 */
function arunachala_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			background: #222;
			border: none;
			padding: 10px;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
			font-size: 20px;
			font-size: 2rem;
			margin: 0;
			
		}
		#headimg h1 a {
			color: #fff;
			text-decoration: none;
			text-transform: uppercase;
		}
		#desc {
			color: #ccc!important;
			margin-bottom: 10px;
		}
		#headimg img {
			width: 100%;
		}
	</style>
<?php
}
endif; // arunachala_admin_header_style

if ( ! function_exists( 'arunachala_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see arunachala_custom_header_setup().
 */
function arunachala_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // arunachala_admin_header_image