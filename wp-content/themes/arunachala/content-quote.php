<?php
/**
 * The template for displaying posts in the Quote post format
 * @package Arunachala
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( has_post_thumbnail()) : ?>
		<?php if ( is_singular () ) : // Display large thumbnail on single posts/pages without permalink ?>
		<?php the_post_thumbnail('large'); ?>
		<?php else : ?>
		<?php if ( is_home () ) : // Display featured thumbnail on homepage with permalink ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
		<?php the_post_thumbnail('featured-thumb'); ?></a>
		<?php else : ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
		<?php the_post_thumbnail('featured-thumb'); ?></a>
		<?php endif; ?>
		<?php endif; ?>
	 <?php endif; ?>
	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			endif;
		?>

		<?php if ( 'post' == get_post_type() && !is_home() ) : ?>
		<div class="entry-meta">
			<span class="post-format">
				<a class="entry-format" href="<?php echo esc_url( get_post_format_link( 'quote' ) ); ?>"><?php echo get_post_format_string( 'quote' ); ?></a>
			</span>
			<?php arunachala_posted_on(); ?>
			<?php edit_post_link( __( 'Edit', 'arunachala' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() || is_home() ) : // Display Excerpts for Search and Homepage. ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Read more', 'arunachala' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'arunachala' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() && !is_home() ) : // Hide category and tag text for pages on Search and Homepage ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'arunachala' ) );
				if ( $categories_list && arunachala_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( '%1$s', 'arunachala' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'arunachala' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( '%1$s', 'arunachala' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'arunachala' ), __( '1 Comment', 'arunachala' ), __( '% Comments', 'arunachala' ) ); ?></span>
		<?php endif; ?>
		
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
