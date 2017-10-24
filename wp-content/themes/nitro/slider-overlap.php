<?php if (get_theme_mod('nitro_overlap_enable') && is_front_page() ) : ?>
<div id="overlap-slider" class="container">
	<div class="section-title title-font">
		<?php echo esc_html( get_theme_mod('nitro_overlap_cat_title','Featured Posts') ); ?>
	</div>
	<div class="slider-overlap-posts col-md-12">
	        <div class="overlap-wrapper">
	        	 <?php
			        $args = array( 
			        	'post_type' => 'post',
			        	'posts_per_page' => 5, 
			        	'cat' => esc_html( get_theme_mod('nitro_overlap_cat',0) ),
			        	'ignore_sticky_posts' => true,
					    
			        );
			       
			        $loop = new WP_Query( $args );
			        while ( $loop->have_posts() ) : 
			        
			        	$loop->the_post(); 	
			        	?>
					
						<div class="slide">
							<a href="<?php echo esc_url(get_permalink( $loop->post->ID )) ?>">
							<div class="image">
								<?php the_post_thumbnail('nitro-overlap-thumb'); ?>
							</div>	
							<div class="post-details">
								<h3><?php the_title(); ?></h3>
							</div>
							</a>
						</div>
												
					 <?php endwhile; ?>
					 <?php wp_reset_query(); ?>	
	            
	        </div>
	        <!-- Add Pagination -->
	        
	    </div>
</div>
<?php endif; ?>