<?php
/**
 * The default template for displaying content
 *
 */
 
?>   
	<?php if(is_single()) $col = "col-md-12"; else $col = "col-md-6 col-sm-6"; ?>
           
 <article class="<?php echo $col; ?>" id="post-<?php the_ID(); ?>" itemscope="" itemtype="http://schema.org/BlogPosting">

	<header class="entry-header">
    	
      <div class="clearboth"></div>
      <?php
		// Post thumbnail.
		northeast_navthemes_post_thumbnail();
	?>

	</header><!-- .entry-header -->

	<div class="entry-content">
    <div class="header">
   
        <?php 
	 	// Post Meta
		northeast_navthemes_entry_meta(); 
	 ?> 
   
   <div class="clearboth height10"></div>
   
   	<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>
    
   </div>
   
		<?php
			if ( is_single() ) :
		 
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s', 'north-east' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'north-east' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'north-east' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		
    else:
			the_excerpt();
	
	endif;
	?>
    
     
     <?php 
	 	if ( !is_single() ) : 
     ?>
     	 <a href="<?php echo esc_url(get_the_permalink()); ?>" class="read_more"><?php _e('Read More', 'north-east'); ?></a> 
        
     <?php endif ;?>
     
 	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'north-east' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
      
      
  	</div><!-- .entry-content -->
 
 <div class="clearboth"></div> 
	</article><!-- #post-## -->
          
            <?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>
 