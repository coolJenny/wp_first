<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Arunachala
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="header-main">
			<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<h1 class="menu-toggle"><?php _e( 'Menu', 'arunachala' ); ?></h1>
				<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'arunachala' ); ?></a>

				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #site-navigation -->
		</div>
			<?php $header_image = get_header_image();
			if ( ! empty( $header_image ) ) : ?>
				<div class="header-image">
					<a href="<?php echo home_url(); ?>"><img src="<?php echo esc_url( $header_image ); ?>" alt="<?php esc_attr( bloginfo( 'name' ) ); ?>" /></a>
				</div>
			<?php endif; ?>
	</header><!-- #masthead -->
	<?php 
			if( is_front_page() || is_home () ) {
			get_template_part( 'slider' );
		}
	?>

	<div id="content" class="site-content">
