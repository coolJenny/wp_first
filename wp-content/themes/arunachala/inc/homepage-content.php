<?php
/**
 * Arunachala Featured Content
 *
 * This module allows you to select a category of posts to be displayed
 * in the theme's homepage.
 */
if ( class_exists( 'WP_Customize_Control' ) ) {

     class Category_Dropdown_Custom_Control extends WP_Customize_Control {
     
          public function render_content() {
     
               $dropdown = wp_dropdown_categories(
                    array(
                         'name'             => 'homepage-category',
                         'echo'             => 0,
						 'show_option_none' => __( 'Select All', 'arunachala' ),
                         'selected'         => '-1',
                         'class'            => 'homepage-cats',
                    )
               );

               // Add in the data link parameter.
               $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

               printf(
                    '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                    $this->label,
                    $dropdown
               );

          }

     }

}
?>