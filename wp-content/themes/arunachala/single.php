<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Arunachala
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

			<?php the_post_navigation( array(
				'next_text' => '<span class="screen-reader-text">' . __( 'Next post:', 'arunachala' ) . '</span> ' .
					'<span class="post-title">%title</span>' . '<span class="meta-nav" aria-hidden="true">' . __( '&nbsp;&raquo', 'arunachala' ) . '</span> ',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( '&laquo;&nbsp;', 'arunachala' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'arunachala' ) . '</span> ' .
					'<span class="post-title">%title</span>',
        ) );
				?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php if ( 'image' != get_post_format() && 'gallery' != get_post_format() )
	get_sidebar();
?>
<?php get_footer(); ?>
