<?php
/**
 * The template used for displaying page content
 * 
 */
 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Post thumbnail.
		northeast_navthemes_post_thumbnail('full');
	?>

	<div class="entry-content">
   
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'north-east' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'north-east' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
    
	</div><!-- .entry-content -->

	<?php edit_post_link( __( 'Edit', 'north-east' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>
	<div class="clearboth"></div>
</article><!-- #post-## -->
 