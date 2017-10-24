<?php
/**
 * The Main Index template file
 *
 */ 
get_header(); ?>
 

    <div class="content-wrapper">    
	<div class="col-md-8 col-sm-12 no-padding">
	 <div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
         
	    <?php if ( have_posts() ) : ?>
			<?php if ( is_home() && !is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>
   
        <div class="loop-items">
        
                <?php
				 $i = 0;
				// Start the loop.
				while ( have_posts() ) : the_post();
					$i++;
					get_template_part( 'content', get_post_format() );
			
					if($i%2 == 0) echo '<div class="clearboth"></div>';
	
				// End the loop.
				endwhile;
					
				// Post Nav
				northeast_number_post_nav();
	
        
            // If no content, include the "No posts found" template.
            else :
                get_template_part( 'content', 'none' );
    
            endif;
            ?>
        </div>

		</main><!-- .site-main -->
	</div><!-- .content-area -->
  
  </div>  
 
		  <?php get_sidebar(); ?> 
	 
 
 	<div class="clearfix"></div>
 </div>  <!-- .content-wrapper -->	

<?php get_footer(); ?>
