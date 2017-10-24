<?php
/**
 * NavThemes Custom Functions
 *
 */
   
	/* ----------------------------------------------------------------------------------- */
	/* Logo Tags 
	/* ----------------------------------------------------------------------------------- */

   function northeast_logo_tag(){
	   
	   $logo_tag = array();
	   
	   if(!is_home() || !is_front_page()):
	   
	   	$logo_tag['open'] = "<p itemprop='name'";
	   	$logo_tag['close'] = "</p>";
	   
	   else:
	  
	  	$logo_tag['open'] = "<h1 itemprop='name'";
	   	$logo_tag['close'] = "</h1>";
	   
	   endif;
	   
	   return $logo_tag; 
	   
   }
   
   	/* ----------------------------------------------------------------------------------- */
	/* Description Tags 
	/* ----------------------------------------------------------------------------------- */

   function northeast_description_tag(){
	   
	   $description_tag = array();
	   
	   if(!is_home() || !is_front_page()):
	   
	   	$description_tag['open'] = "<h3 itemprop='description'";
	   	$description_tag['close'] = "</h3>";
	   
	   else:
	  
	   	$description_tag['open'] = "<h2 itemprop='description'";
	   	$description_tag['close'] = "</h2>";
	   
	   endif;
	   
	   return $description_tag;
	   
   }
   
   if ( ! function_exists( 'northeast_navthemes_entry_meta' ) ) :
   
/**
 * Set up post entry meta.
 */
function northeast_navthemes_entry_meta() {
	
	// Translators: used between list items, there is a space after the comma.
	$categories_list = '<span class="category" itemprop="articleSection">'. get_the_category_list( __( ' ', 'north-east' ) ) . "</span>";
  

	$date = sprintf( '<span class="date"><i class="fa fa-clock-o"></i> <a href="%1$s" title="%2$s" rel="bookmark"><time itemprop="datePublished" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span itemprop="author"><i class="fa fa-user"></i> <span class="author"><a href="%1$s" title="%2$s" rel="">%3$s</a></span></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'north-east' ), get_the_author() ) ),
		get_the_author()
	);
	
	$comment_number = get_comments_number();
	$comment_number = sprintf( _n( '1 Comment', '%s Comments', $comment_number, 'north-east' ), $comment_number );
	$comment_number =  sprintf( ' <span class="comments" itemprop="interactionCount"> <i class="fa fa-comment"></i><a href="%1$s" title="%2$s" rel="comments">%2$s</a></span>',
		get_comments_link(),
		$comment_number
	);

  
  	// Translators: used between list items, there is a space after the comma.
	$tag_list = '<span class="tags"> <i class="fa fa-tags"></i> '. get_the_tag_list( '', __( ', ', 'north-east' ) ). '</span>';

	$utility_text = __( ' %1$s %3$s %4$s %5$s %2$s ', 'north-east' );	
	
  	// Translators: 1 is category, 2 is tag, 3 is the date, 4 is the author's name and 5 is comments.
	echo $categories_list ;
	echo $date ;
	echo $author ;
	echo $comment_number ;
	echo $tag_list ;
 }



endif;
 
 
 if ( ! function_exists( 'northeast_navthemes_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function northeast_navthemes_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php echo comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'north-east' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'north-east' ), '<span class="edit-link">', '</span>' ); ?></p>
        </li>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
     
     <li class="comment_block" id="comment-<?php comment_ID(); ?>">
     
         <div class="col-md-10 col-sm-10">
            <div class=" col-md-2 col-sm-2"><?php echo get_avatar( $comment, 44 ); ?></div>
            <div class="col-md-10 col-sm-10 no-padding">
                <h3><?php printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
                            get_comment_author_link(),
                            // If current post author is also comment author, make it known visually.
                            ( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'north-east' ) . '</span>' : ''
                        ); ?>
             </h3>
            <span><?php
                        printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                            esc_url( get_comment_link( $comment->comment_ID ) ),
                            get_comment_time( 'c' ),
                            /* translators: 1: date, 2: time */
                            sprintf( __( '%1$s at %2$s', 'north-east' ), get_comment_date(), get_comment_time() )
                        );
                    ?></span>
                    
            <?php if ( '0' == $comment->comment_approved ) : ?>
                    <i class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'north-east' ); ?></i>
                <?php endif; ?>
            
            <p> 		<?php comment_text(); ?>
                    <?php edit_comment_link( __( 'Edit', 'north-east' ), '<p class="edit-link">', '</p>' ); ?>  
             </p>
            </div>
        </div>
        <div class="col-md-2 col-sm-2"><?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'north-east' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>
      <div class="clearfix"></div>
          
       
          
          </li>                 
                                 
	<?php
		break;
	endswitch; // end comment_type check
}
endif;
 
   
   /* ----------------------------------------------------------------------------------- */
   /* Breadcrumbs 
   /* ----------------------------------------------------------------------------------- */

function northeast_breadcrumbs() {
    $delimiter = '&raquo;';
    $home = __('Home', 'north-east'); // text for the 'Home' link
    $before = '<span class="current">'; // tag before the current crumb
    $after = '</span>'; // tag after the current crumb
    echo '<div id="breadcrumbs" itemprop="breadcrumb">';
    global $post;
    $homeLink = esc_url( home_url() );
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
	
    if (is_category()) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
        if ($thisCat->parent != 0)
            echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
            echo $before . __('Archive by category "','north-east') . single_cat_title('', false) . '"' . $after;
    } elseif (is_day()) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
        echo $before . get_the_time('d') . $after;
    } elseif (is_month()) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        echo $before . get_the_time('F') . $after;
    } elseif (is_year()) {
        echo $before . get_the_time('Y') . $after;
    } elseif (is_single() && !is_attachment()) {
		
        if (get_post_type() == 'portfolio') {
				
				$taxonomy = 'portfolios';
				$tax_terms = get_terms($taxonomy);
				 
				$terms = get_the_terms( $post->id, $taxonomy );
				if ( $terms && ! is_wp_error( $terms ) ) { 
					foreach ( $terms as $term ) {
						$tree = '<a href="'.get_term_link($term->slug,  $taxonomy).'">'. $term->name .'</a>';
						$parents = get_ancestors( $term->term_id,  $taxonomy );
						foreach ($parents as $parent) {
							$term = get_term($parent,  $taxonomy);
							$tree = '<a href="'.get_term_link($term->slug,  $taxonomy).'">'.$term->name.'</a>'.$tree;
					   }
					echo $tree . ' '. $delimiter . ' ';
					echo $before . get_the_title(). $after;
				}
				
			}
		}
		
        else if (get_post_type() != 'post') {
		    $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
           echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
       } 
	   else {
            $cat = get_the_category();
            $cat = $cat[0];
          	echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo $before .  get_the_title()  . $after;
			
        }
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_page() && !$post->post_parent) {
       echo $before . get_the_title()   . $after;
    } elseif (is_page() && $post->post_parent) {
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb)
            echo $crumb . ' ' . $delimiter . ' ';
        echo $before . get_the_title()  . $after;
    } elseif (is_search()) {
        echo $before . __('Search results for "','north-east') . get_search_query() . '"' . $after;
    } elseif (is_tag()) {
        echo $before . __('Posts tagged "','north-east') . single_tag_title('', false) . '"' . $after;
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . __('Articles posted by ','north-east') . $userdata->display_name . $after;
    } elseif (is_404()) {
        echo $before . __('Error 404', 'north-east') . $after;
    }

    if (get_query_var('paged')) {
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            echo ' (';
        echo __('Page', 'north-east') . ' ' . get_query_var('paged');
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            echo ')';
    }

    echo '</div>';
}

	/* ----------------------------------------------------------------------------------- */
	/* Add Footer
	/* ----------------------------------------------------------------------------------- */

if ( ! function_exists( 'northeast_footer' ) ) :

	function northeast_footer(){
				echo '<div class="top_btn">
					  <a class="cd-top" href="#0"></a>
								</div>';
				
	}

endif;

	add_action('wp_footer','northeast_footer');
	

	/* ----------------------------------------------------------------------------------- */
	/* Pagination
	/* ----------------------------------------------------------------------------------- */

if ( ! function_exists( 'northeast_number_post_nav' ) ) :

	
	function northeast_number_post_nav() {

			if( is_singular() )
				return;
		
			global $wp_query;
		
			/** Stop execution if there's only 1 page */
			if( $wp_query->max_num_pages <= 1 )
				return;
		
			$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
			$max   = intval( $wp_query->max_num_pages );
		
			/**	Add current page to the array */
			if ( $paged >= 1 )
				$links[] = $paged;
		
			/**	Add the pages around the current page to the array */
			if ( $paged >= 3 ) {
				$links[] = $paged - 1;
				$links[] = $paged - 2;
			}
		
			if ( ( $paged + 2 ) <= $max ) {
				$links[] = $paged + 2;
				$links[] = $paged + 1;
			}
		
			echo '<div class="clearbothc clearfix"></div> <div class="navigation pagination"><ul>' . "\n";
		
			/**	Previous Post Link */
			if ( get_previous_posts_link() )
				printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
		
			/**	Link to first page, plus ellipses if necessary */
			if ( ! in_array( 1, $links ) ) {
				$class = 1 == $paged ? ' class="active"' : '';
		
				printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
		
				if ( ! in_array( 2, $links ) )
					echo '<li>&middot; &middot; &middot;</li>';
			}
		
			/**	Link to current page, plus 2 pages in either direction if necessary */
			sort( $links );
			foreach ( (array) $links as $link ) {
				$class = $paged == $link ? ' class="active"' : '';
				printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
			}
		
			/**	Link to last page, plus ellipses if necessary */
			if ( ! in_array( $max, $links ) ) {
				if ( ! in_array( $max - 1, $links ) )
					echo '<li>&middot; &middot; &middot;</li>' . "\n";
		
				$class = $paged == $max ? ' class="active"' : '';
				printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
			}
		
			/**	Next Post Link */
			if ( get_next_posts_link() )
				printf( '<li>%s</li>' . "\n", get_next_posts_link() );
		
			echo '</ul></div>' . "\n";
			
			echo ' <div style="clear:both;"></div> ';

		}
	
	endif;	

 	
	if ( ! function_exists( 'northeast_navthemes_post_thumbnail' ) ) :
	/**
	 * Display an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 */
	function northeast_navthemes_post_thumbnail($image = null ) {
		if ( post_password_required() || is_attachment() ) {
			return;
		}
		
	  if(has_post_thumbnail()):		
		
		if ( is_singular() && $image == null) :
		?>
	
		<div class="post-thumbnail">
			<?php the_post_thumbnail( 'large'); ?>
		</div><!-- .post-thumbnail -->
			
		<?php elseif ($image != null) : ?>
        	
		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
				the_post_thumbnail( $image , array( 'alt' => get_the_title() ) );
			?>
		</a>
            
        <?php else : ?>
	
		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
				the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
			?>
		</a>
	
		<?php endif; // End is_singular()
		
	   else: 
	   	
			$noImage = (is_single()) ? "no-image-single.jpg" : "no-image.jpg";
	   
	    // show blank image only on post
		if(!is_page()) : ?>
            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
                <?php
                    echo '<img src="' . get_template_directory_uri() . '/images/'.$noImage.'" />';
                ?>
            </a>
	   <?php endif; ?>	 
        
        
      <?php  endif; // !has post thumbnails	
		}
	endif;
	
 
// Menu Microdata

 function northeast_nav_description( $item_output, $item, $depth, $args ) {

$item_output = str_replace( '>' . $args->link_before . $item->title, ' itemprop="url" >' . $args->link_before. '<span itemprop="name">' . $item->title . '</span>', $item_output );
	
	return $item_output;
}

add_filter( 'walker_nav_menu_start_el', 'northeast_nav_description', 10, 4 );
