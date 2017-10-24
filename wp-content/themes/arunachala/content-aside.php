<?php
/**
 * The template for displaying posts in the Aside post format
 * @package Arunachala
 */
?>
 
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( is_home () && has_post_thumbnail()) : ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
		<?php the_post_thumbnail('featured-thumb'); ?></a>
	<?php endif; ?>

    <header class="entry-header">
        <?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			endif;
		?>
		<div class="entry-meta">
			<span class="post-format">
				<a class="entry-format" href="<?php echo esc_url( get_post_format_link( 'aside' ) ); ?>"><?php echo get_post_format_string( 'aside' ); ?></a>
			</span>
			<span class="posted-on"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'arunachala' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php echo get_the_date(); ?></a></span>
	        <?php edit_post_link( __( 'Edit', 'arunachala' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
		
	</header><!-- .entry-header -->
 
    <?php if ( is_search() || is_home() ) : // Display Excerpts for Search and Homepage. ?>
    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->
    <?php else : ?>
    <div class="entry-content">
        <?php the_content( __( 'Read more', 'arunachala' ) ); ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'arunachala' ), 'after' => '</div>' ) ); ?>
    </div><!-- .entry-content -->
    <?php endif; ?>
 
    <footer class="entry-meta">
        <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
        <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'arunachala' ), __( '1 Comment', 'arunachala' ), __( '% Comments', 'arunachala' ) ); ?></span>
        <?php endif; ?>
 
    </footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->