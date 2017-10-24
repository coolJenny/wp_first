<?php
/**
 * The template for displaying all single posts and attachments
 * 
 */
	
get_header(); ?>

<div class="content-wrapper"> 	
	<div class="col-md-8 col-sm-12 no-padding">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
   
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			get_template_part( 'content', get_post_format() );
		?>
       
            <div class="clearfix"></div>
            <div class="height30"></div>
            <div class="clearfix"></div>
            
        	<div class="post-links">
                <div class="col-md-6" align="left"><?php next_post_link( '<strong> <i class="fa fa-angle-double-left"></i> %link</strong>' ); ?></div>
                <div class="col-md-6" align="right"><?php previous_post_link( '<strong>%link <i class="fa fa-angle-double-right"></i></strong>' ); ?></div>
			</div>
       	
        	<?php
				
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->
  </div><!-- .col -->  
    
		  <?php get_sidebar(); ?> 
             
    <div class="clearfix"></div>     
 </div>  
<?php get_footer(); ?>