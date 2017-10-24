<?php
/**
 * The template for displaying the footer
 *
 * 
 */ 
?>
	 	</div> <!-- Row End here -->
          </div> <!--.container-->
            </div> <!--.middle_wrapper-->
           <!--Middle wrapper End Here-->  
          
           <!--Footer wrapper Start Here--> 
          <footer class="footer_wrapper" itemscope itemtype="http://schema.org/WPFooter">
       	    <div class="container">
              <?php if(is_active_sidebar('footer-sidebar')): ?>
               <div id="footer-widget-area">    
                	<?php dynamic_sidebar('footer-sidebar'); ?>
                <div class="clearboth"></div>
                </div>
			<?php endif; ?>
                <div class="clearboth"></div>
		  </div><!--.container-->
		           	<div class="copy_right"><a target="_blank" href="<?php echo esc_url("http://www.navthemes.com/north-east-free-blog-theme/");?>"><?php _e('North East Blog Theme', 'north-east'); ?></a> <?php _e('By', 'north-east') ?> <?php _e('NavThemes', 'north-east'); ?>   </div> 
              <!--Footer wrapper End Here--> 
	     </footer> 	  
	 </div>
    <!--.main_container end-->
	<?php wp_footer(); ?>
    </body>
    </html>