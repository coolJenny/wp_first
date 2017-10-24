<?php
/* The Template to Render the showcase
*
*/

//Define all Variables.
if ( get_theme_mod('nitro_showcase_enable' ) && is_front_page() ) : 


		
		?>
		<div id="showcase">
			<div class="container">
			
				<div class="section-title">
					<span><?php echo esc_html(get_theme_mod('nitro_showcase_title',__('SHOWCASE','nitro'))); ?></span>
				</div>
				
				<div class="showcase-container">
			            <?php
			            for ( $i = 1; $i <= 3; $i++ ) :
	
							$url = esc_url ( get_theme_mod('nitro_showcase_url'.$i) );
							$img = esc_url ( get_theme_mod('nitro_showcase_img'.$i) );
							$title = esc_html( get_theme_mod('nitro_showcase_title'.$i) );
							$desc = esc_html( get_theme_mod('nitro_showcase_desc'.$i) );
							 
							
							?>
							<div class="showcase-item col-md-4 col-sm-4 col-xs-12">
				            	<a href="<?php echo $url; ?>">
				            		<img src="<?php echo $img ?>" data-thumb="<?php echo $img ?>" title="<?php echo $title." - ".$desc ?>" />
				            	
				            	<div class="showcase-caption">
					                
					                <?php if ($title) : ?>
						                <div class="showcase-title"><?php echo $title ?></div>
						                <div class="showcase-desc"><span><?php echo $desc ?></span></div>
						            <?php endif; ?> 
						            
								</div>
								
								</a>

				            </div>
			             <?php endfor; ?>
			               			         
			        </div>
			</div> 
		</div>
	<?php	
	
endif;	?>	   