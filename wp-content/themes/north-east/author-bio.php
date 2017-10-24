<?php
/**
 * The template for displaying Author bios
 * 
 */
?>

<div class="author-info" itemscope itemtype="http://schema.org/Person">
	<h2 class="author-heading"><?php _e( 'Published by', 'north-east' ); ?></h2>
	<div class="author-avatar">
		<?php
		/**
		 * Filter the author bio avatar size.
		 */
		echo get_avatar( get_the_author_meta( 'user_email' ), 56 );
		?>
	</div><!-- .author-avatar -->

	<div class="author-description">
		<h3 class="author-title" itemprop="name"><?php echo get_the_author(); ?></h3>
		<p class="author-bio" itemprop="description">
			<?php the_author_meta( 'description' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( 'View all posts by %s', 'north-east' ), get_the_author() ); ?>
			</a>
		</p><!-- .author-bio -->

	</div><!-- .author-description -->
</div><!-- .author-info -->
