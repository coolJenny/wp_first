<?php
/*
** WooCommerce Compatibility File for Nitro Theme
** Created by Rohit Tripathi, Rohitink.com (c) 2015
** @package nitro
*/

// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'nitro_dequeue_woocommerce_styles' );
function nitro_dequeue_woocommerce_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	//unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	//unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

/**
 * Set Default Thumbnail Sizes for Woo Commerce Product Pages, on Theme Activation
 */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) 			
	add_action( 'init', 'nitro_woocommerce_image_dimensions', 1 );
/**
 * Define image sizes
 */
function nitro_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '600',	// px
		'height'	=> '600',	// px
		'crop'		=> 1 		// true
	);
	$single = array(
		'width' 	=> '600',	// px
		'height'	=> '600',	// px
		'crop'		=> 1 		// true
	);	 
	$thumbnail = array(
		'width' 	=> '600',	// px
		'height'	=> '600',	// px
		'crop'		=> 0 		// false
	);	 
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

//Custom Hooking for Product Loop Page Items.
function nitro_before_wc_title() {
	echo "<div class='product-desc'>";
}
add_action('woocommerce_before_shop_loop_item_title', 'nitro_before_wc_title', 15);

function nitro_after_wc_title() {
	echo "</div>";
}
add_action('woocommerce_after_shop_loop_item_title', 'nitro_after_wc_title');

/**
 * Remove the "shop" title on the main shop page
*/
function nitro_woo_hide_page_title() {
	return false;
}
add_filter( 'woocommerce_show_page_title' , 'nitro_woo_hide_page_title' );

/**
 * Change the Breadcrumb
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'nitro_change_breadcrumb_delimiter' );
function nitro_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>>'
	$defaults['delimiter'] = ' <i class="fa fa-angle-right"></i> ';
	return $defaults;
}

/*
 * WooCommerce Output Wrappers for for Single Product(single-product.php) and Product Archives(archive-product.php)
 */
add_action('woocommerce_before_main_content', 'nitro_single_custom_header', 1 );

function nitro_single_custom_header() {
    if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
        <div class="header-title col-md-12">
            <span><?php woocommerce_page_title(); ?></span>
        </div>
    <?php endif; ?>

    <div id="primary-mono" class="content-area <?php do_action('nitro_primary-width') ?>">
        <main id="main" class="site-main" role="main">
    <?php
}

add_action( 'woocommerce_after_main_content', 'nitro_single_custom_footer', 50 );

function nitro_single_custom_footer() {
    echo "</main></div>";
}


/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */ 
add_filter( 'woocommerce_output_related_products_args', 'nitro_change_related_products_count' );

function nitro_change_related_products_count( $args ) {
     $args['posts_per_page'] = 3;
     $args['columns'] = 3;

     return $args;
}

//Product Gallery Size 
function nitro_gallery_four_columns(  ){
    return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'nitro_gallery_four_columns');

// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter( 'woocommerce_add_to_cart_fragments', 'nitro_header_add_to_cart_fragment' );

function nitro_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
			<span class="cart-contents" title="<?php _e('View your shopping cart', 'nitro'); ?>">
							<div class="count"><?php echo sprintf(_n('%d item', '%d items', esc_html( WC()->cart->cart_contents_count, 'nitro') ), esc_html( WC()->cart->cart_contents_count) );?></div>
							<div class="total"> <?php echo esc_html(WC()->cart->get_cart_total()); ?> </div>
							
							<a class="links" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>"><?php _e('Go to Cart','nitro'); ?></a>
							<a class="links" href="<?php echo esc_url( WC()->cart->get_checkout_url() ); ?>"><?php _e('Checkout','nitro'); ?></a>
						</span>
	<?php
	
	$fragments['span.cart-contents'] = ob_get_clean();
	
	return $fragments;
}
