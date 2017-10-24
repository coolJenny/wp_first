<?php
/**
 * @package Nitro
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-6 col-sm-6 grid grid_2_column nitro-grid'); ?>>

		<div class="featured-thumb col-md-12">
			<?php if (has_post_thumbnail()) : ?>	
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><?php the_post_thumbnail('nitro-pop-thumb'); ?></a>
			<?php else: ?>
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/placeholder2.jpg"; ?>"></a>
			<?php endif; ?>
			
			<div class="postedon"><?php nitro_posted_on_icon('date'); ?></div>
			
			<div class="out-thumb">
				<h1 class="entry-title title-font"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			</div>
		</div><!--.featured-thumb-->
			
					
</article><!-- #post-## -->