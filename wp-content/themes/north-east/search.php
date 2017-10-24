<?php
/**
 * The template for displaying search results pages.
 * 
 */

get_header(); ?>


    <header class="page-header">
        <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'north-east' ), get_search_query() ); ?></h1>
    </header><!-- .page-header -->
 
 <div class="content-wrapper">
   	<div class="col-md-8 col-sm-12">

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
 
		<?php if ( have_posts() ) : ?>

		<div class="loop-items">
	
    		<?php
			// Start the loop.
			while ( have_posts() ) : the_post();
		
        		get_template_part( 'content', 'search' );

			// End the loop.
			endwhile;
		?>
			</div>
			<?php
			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'north-east' ),
				'next_text'          => __( 'Next page', 'north-east' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'north-east' ) . ' </span>',
			) );
	
		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>
	  
		</main><!-- .site-main -->
 	</section><!-- .content-area -->
  </div><!-- .col -->  
  

    
	<?php get_sidebar(); ?>
    <div class="clearfix"></div>
 </div> <!--.content wrapper end-->
<?php get_footer(); ?>
