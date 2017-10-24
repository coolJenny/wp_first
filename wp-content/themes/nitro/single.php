<?php
/**
 * The template for displaying all single posts.
 *
 * @package nitro
 */

get_header(); ?>

	<header class="entry-header single-entry-header col-md-12">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		
		
		<div class="entry-meta">
			<?php wp_reset_postdata();
				nitro_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
	
	<div id="primary-mono" class="content-area <?php do_action('nitro_primary-width') ?>">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
