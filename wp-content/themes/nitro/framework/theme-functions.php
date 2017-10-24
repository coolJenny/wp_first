<?php
/*
 * @package nitro, Copyright Rohit Tripathi, rohitink.com
 * This file contains Custom Theme Related Functions.
 */
 
 
class Nitro_Menu_With_Description extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$fontIcon = ! empty( $item->attr_title ) ? ' <i class="fa ' . esc_attr( $item->attr_title ) .'">' : '';
		$attributes = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>'.$fontIcon.'</i>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '<br /><span class="menu-desc">' . $item->description . '</span>';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
	}
}

class Nitro_Menu_With_Icon extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$fontIcon = ! empty( $item->attr_title ) ? ' <i class="fa ' . esc_attr( $item->attr_title ) .'">' : '';
		$attributes = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>'.$fontIcon.'</i>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
	}
}

/*
 * Pagination Function. Implements core paginate_links function.
 */
function nitro_pagination() {
	the_posts_pagination(array('mid_size'=> 2));
}

/*
** Customizer Controls 
*/
if (class_exists('WP_Customize_Control')) {
	class Nitro_WP_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;', 'nitro' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
 
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
} 

if ( class_exists('WP_Customize_Control') && class_exists('woocommerce') ) {
	class Nitro_WP_Customize_Product_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;', 'nitro' ),
                    'option_none_value' => '0',
                    'taxonomy'          => 'product_cat',
                    'selected'          => $this->value(),
                )
            );
 
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
}    
if (class_exists('WP_Customize_Control')) {
	class Nitro_WP_Customize_Upgrade_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
             printf(
                '<label class="customize-control-upgrade"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $this->description
            );
        }
    }
}

/*
** Function to check if Sidebar is enabled on Current Page 
*/

function nitro_load_sidebar() {
	$load_sidebar = true;
	if ( get_theme_mod('nitro_disable_sidebar') ) :
		$load_sidebar = false;
	elseif( get_theme_mod('nitro_disable_sidebar_home') && is_home() )	:
		$load_sidebar = false;
	elseif( get_theme_mod('nitro_disable_sidebar_front') && is_front_page() ) :
		$load_sidebar = false;
	endif;
	
	return  $load_sidebar;
}

/*
**	Determining Sidebar and Primary Width
*/
function nitro_primary_class() {
	$sw = esc_html(get_theme_mod('nitro_sidebar_width',4));
	$class = "col-md-".(12-$sw);
	
	if ( !nitro_load_sidebar() ) 
		$class = "col-md-12";
	
	echo $class;
}
add_action('nitro_primary-width', 'nitro_primary_class');

function nitro_secondary_class() {
	$sw = esc_html(get_theme_mod('nitro_sidebar_width',4));
	$class = "col-md-".$sw;
	
	echo $class;
}
add_action('nitro_secondary-width', 'nitro_secondary_class');


/*
**	Helper Function to Convert Colors
*/
function nitro_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
}
function nitro_fade($color, $val) {
	return "rgba(".nitro_hex2rgb($color).",". $val.")";
}


/*
** Function to Get Theme Layout 
*/
function nitro_get_blog_layout(){
	$ldir = 'framework/layouts/content';
	if (get_theme_mod('nitro_blog_layout') ) :
		get_template_part( $ldir , get_theme_mod('nitro_blog_layout') );
	else :
		get_template_part( $ldir ,'grid');	
	endif;	
}
add_action('nitro_blog_layout', 'nitro_get_blog_layout');

/*
** Function to Set Main Class 
*/
function nitro_get_main_class(){
	
	$layout = get_theme_mod('nitro_blog_layout');
	if (strpos($layout,'nitro') !== false) {
	    	echo 'nitro-main';
	}		
}
add_action('nitro_main-class', 'nitro_get_main_class');

/*
** Load WooCommerce Compatibility FIle
*/
if ( class_exists('woocommerce') ) :
	require get_template_directory() . '/framework/woocommerce.php';
endif;


/*
** Load Custom Widgets
*/

require get_template_directory() . '/framework/widgets/recent-posts.php';


