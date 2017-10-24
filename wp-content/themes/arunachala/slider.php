<?php
/**
 * @package Arunachala
 */
?>
<?php
	// Create array of all the sticky_posts
	$stickies = get_option( 'sticky_posts' );
	// Count how many there are, if any
	$count = count( $stickies );

	// Create a set of arguments to pass
	$args = array(
		'post__in' => $stickies,
		'post_type' => 'post',
		'nopaging' => true
		);
	$featured = new WP_Query( $args );
?>
<?php
	// If there is one or more sticky post we create our new slider
	if ( $count > 0 ) : 
?>
	<div id="slider">
			<div class="tcycle" data-speed=2000>
				<?php while( $featured->have_posts() ) : $featured->the_post(); ?>
						<article>
							<div class="slider-content">
								<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
								<div class="entry-summary"><?php the_excerpt(); ?></div>
							</div>
							<div class="featured-image"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
							<?php the_post_thumbnail('slider-thumb'); ?>
							</a></div>
						</article>
				<?php endwhile; wp_reset_query(); ?>
				<?php endif; // end the featured posts ?>
			</div><!-- end of our featured article slider -->
	</div>
