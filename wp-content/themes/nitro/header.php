<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package nitro
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
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'nitro' ); ?></a>
	<div id="jumbosearch">
		<span class="fa fa-remove closeicon"></span>
		<div class="form">
			<?php get_search_form(); ?>
		</div>
	</div>	
	
	<div id="top-bar">
		<div class="container">
			<div class="social-icons">
				<?php get_template_part('social', 'fa'); ?>	 
			</div>
			
			<div id="woocommerce-zone">
			<?php if (class_exists('woocommerce')) : ?>
				<div id="top-cart">
					<div class="top-cart-icon">
	
		 
						<span class="cart-contents" title="<?php _e('View your shopping cart', 'nitro'); ?>">
							<div class="count"><?php echo sprintf(_n('%d item', '%d items', esc_html( WC()->cart->cart_contents_count, 'nitro') ), esc_html( WC()->cart->cart_contents_count) );?></div>
							<div class="total"> <?php echo esc_html(WC()->cart->get_cart_total()); ?> </div>
							
							<a class="links" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>"><?php _e('Go to Cart','nitro'); ?></a>
							<a class="links" href="<?php echo esc_url( WC()->cart->get_checkout_url() ); ?>"><?php _e('Checkout','nitro'); ?></a>
						</span>
						
						
						
						<i class="fa fa-shopping-bag"></i>
						</div>
				</div>
				
				<div id="userlinks">
					<?php if ( is_user_logged_in() ) { ?>
					 	<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php _e('My Account','nitro'); ?>"><?php _e('My Account','nitro'); ?></a>
					 <?php } 
					 else { ?>
					 	<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php _e('Login / Register','nitro'); ?>"><?php _e('Login / Register','nitro'); ?></a>
					<?php } ?>
				</div>
					
			<?php endif; ?>
				

			</div>
			
		
		
			<div id="top-menu">
				<?php wp_nav_menu( array( 'theme_location' => 'top' ) ); ?>
			</div>
			
		</div>	
			
	</div>
	
	<header id="masthead" class="site-header" role="banner">
		<div class="container masthead-container">
			<div class="site-branding">
				<?php if ( nitro_has_logo() ) : ?>					
					<div id="site-logo">
						<?php nitro_logo() ?>
					</div>
				<?php endif; ?>
				<div id="text-title-desc">
				<h1 class="site-title title-font"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				</div>
			</div>	
			
			<div id="slickmenu"></div>
			<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php $walker = new Nitro_menu_with_Icon;
						if (!has_nav_menu('primary')) { $walker = ''; }
					wp_nav_menu( array( 'theme_location' => 'primary', 'walker' => $walker ) ); ?>
			</nav><!-- #site-navigation -->
			
			<div id="searchicon">
				<i class="fa fa-search"></i>
			</div>
			
		</div>	
		
	</header><!-- #masthead -->
	<?php if ( is_front_page() && (get_header_image())) : ?>
	<div id="header-image">
		<div class="image">
			<img src="<?php echo header_image(); ?>" width="100%">
		</div>	
		<div class="header-data" data-stellar-ratio="1.3" data-stellar-vertical-offset="0">
			<div class="header-title">
				<?php echo esc_html(get_theme_mod('nitro_header_title')); ?>
			</div>
			<div class="description">
				<?php echo esc_html(get_theme_mod('nitro_header_desc')); ?>
			</div>
			<div class="buttons">
				<?php if (get_theme_mod('nitro_header_btn1')) : ?>
					<div class="button1">
						<a href="<?php echo esc_url( get_theme_mod('nitro_header_btn1_url') ); ?>"><?php echo esc_html(get_theme_mod('nitro_header_btn1')); ?></a>
					</div>
				<?php endif;
					if (get_theme_mod('nitro_header_btn2')) : ?>
					<div class="button2">
						<a href="<?php echo esc_url( get_theme_mod('nitro_header_btn2_url') ); ?>"><?php echo esc_html(get_theme_mod('nitro_header_btn2')); ?></a>
					</div>	
				<?php endif; ?>
			</div>	
		</div>
		
	</div>
	
	<?php endif; ?>
	<?php if( class_exists('rt_slider') ) {
		 rt_slider::render('slider', 'swiper' ); 
	} ?>
	<?php get_template_part('slider', 'overlap'); ?>
	<?php get_template_part('featured', 'showcase'); ?>
	
	<div class="mega-container">
		
		<?php if (class_exists('woocommerce')) : ?>	
		<?php get_template_part('coverflow', 'product'); ?>
		<?php get_template_part('featured', 'products'); ?>
		<?php endif; ?>
		<?php get_template_part('coverflow', 'posts'); ?>
		<?php get_template_part('featured', 'posts'); ?>
	
		<div id="content" class="site-content container">