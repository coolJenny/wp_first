<?php
/**
 * The template for displaying archive pages
 *  
 */

get_header(); ?>

      <header class="page-header">
        <div class="page-title">
			<?php
                the_archive_title( '<h1 class="">', '</h1>' );
                the_archive_description( '<div class="taxonomy-description">', '</div>' );
            ?>
       </div> 
    </header><!-- .page-header -->   
   
 	<div class="col-md-8 col-sm-12 no-padding">
	 <section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
	
    <div class="loop-items">
    
		<?php if ( have_posts() ) : ?>
			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();
			
				get_template_part( 'content', get_post_format() );

			// End the loop.
			endwhile;
			
			northeast_number_post_nav();

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>
	
    </div>

		</main><!-- .site-main -->
	</section><!-- .content-area -->
  </div><!-- .col-md-8 .col-sm-8 -->  
    
       <?php get_sidebar(); ?> 
    
    <div class="clearfix"></div>
</div>

<?php get_footer(); ?>
