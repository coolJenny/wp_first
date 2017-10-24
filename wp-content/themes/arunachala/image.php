<?php
/**
 * The template for displaying image attachments.
 *
 * @package Arunachala
 * @since Arunachala 1.0
 */
 // Retrieve attachment metadata.
$metadata = wp_get_attachment_metadata();
 
get_header();
?>
 
        <div id="primary" class="content-area image-attachment">
            <div id="content" class="site-main" role="main">
 
            <?php while ( have_posts() ) : the_post(); ?>
 
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
 
                        <div class="entry-meta">
						<span class="entry-date"><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></span>

						<span class="full-size-link"><a href="<?php echo wp_get_attachment_url(); ?>"><?php echo $metadata['width']; ?> &times; <?php echo $metadata['height']; ?></a></span>

						<span class="parent-post-link"><a href="<?php echo get_permalink( $post->post_parent ); ?>" rel="gallery"><?php echo get_the_title( $post->post_parent ); ?></a></span>
						<?php edit_post_link( __( 'Edit', 'arunachala' ), '</span> <span class="edit-link">', '</span>' ); ?>
                        </div><!-- .entry-meta -->
                         
                    </header><!-- .entry-header -->
					
					<nav id="image-navigation" class="site-navigation">
						<span class="previous-image"><?php previous_image_link( false, __( '&laquo; Previous', 'arunachala' ) ); ?></span>
						<span class="next-image"><?php next_image_link( false, __( 'Next &raquo;', 'arunachala' ) ); ?></span>
					</nav><!-- #image-navigation -->
                    
					<div class="entry-content">
 
                        <div class="entry-attachment">
                            <div class="attachment">
                                <?php
                                    /**
                                     * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
                                     * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
                                     */
                                    $attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
                                    foreach ( $attachments as $k => $attachment ) {
                                        if ( $attachment->ID == $post->ID )
                                            break;
                                    }
                                    $k++;
                                    // If there is more than 1 attachment in a gallery
                                    if ( count( $attachments ) > 1 ) {
                                        if ( isset( $attachments[ $k ] ) )
                                            // get the URL of the next image attachment
                                            $next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
                                        else
                                            // or get the URL of the first image attachment
                                            $next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
                                    } else {
                                        // or, if there's only 1 image, get the URL of the image
                                        $next_attachment_url = wp_get_attachment_url();
                                    }
                                ?>
 
                                <a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
                                    $attachment_size = apply_filters( 'arunachala_attachment_size', array( 1200, 1200 ) ); // Filterable image size.
                                    echo wp_get_attachment_image( $post->ID, $attachment_size );
                                ?></a>
                            </div><!-- .attachment -->
 
                            <?php if ( ! empty( $post->post_excerpt ) ) : ?>
                            <div class="entry-caption">
                                <?php the_excerpt(); ?>
                            </div><!-- .entry-caption -->
                            <?php endif; ?>
                        </div><!-- .entry-attachment -->
 
                        <?php the_content(); ?>
                        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'arunachala' ), 'after' => '</div>' ) ); ?>
						
                    </div><!-- .entry-content -->
 
                    <footer class="entry-meta">
                        <?php if ( comments_open() && pings_open() ) : // Comments and trackbacks open ?>
                            <?php printf( __( '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'arunachala' ), get_trackback_url() ); ?>
                        <?php elseif ( ! comments_open() && pings_open() ) : // Only trackbacks open ?>
                            <?php printf( __( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'arunachala' ), get_trackback_url() ); ?>
                        <?php elseif ( comments_open() && ! pings_open() ) : // Only comments open ?>
                            <?php _e( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', 'arunachala' ); ?>
                        <?php elseif ( ! comments_open() && ! pings_open() ) : // Comments and trackbacks closed ?>
                            <?php _e( 'Both comments and trackbacks are currently closed.', 'arunachala' ); ?>
                        <?php endif; ?>
                        <?php edit_post_link( __( 'Edit', 'arunachala' ), ' <span class="edit-link">', '</span>' ); ?>
                    </footer><!-- .entry-meta -->
                </article><!-- #post-<?php the_ID(); ?> -->
 
                <?php comments_template(); ?>
 
            <?php endwhile; // end of the loop. ?>
 
            </div><!-- #content .site-content -->
        </div><!-- #primary .content-area .image-attachment -->
 
<?php get_footer(); ?>