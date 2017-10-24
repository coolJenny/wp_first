	<?php
/**
 * The template for displaying the header
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js"  itemscope itemtype="http://schema.org/Blog">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
 	<?php wp_head(); ?>
</head>

<body id="blog" <?php body_class(); ?>>  
    <!--.main_container-->
    	<div class="main_container">
        	<!--header wrapper Start Here-->
            	<header class="header_wrapper" itemscope itemtype="http://schema.org/WPHeader">
                	<div class="container">
                    	<div class="row">
                          <div id="logo" class="logo pull-left">
                          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                          <?php 
								$logotag = northeast_logo_tag();
								$description_tag = northeast_description_tag();
						  	?>
						  <?php echo $logotag['open']; ?> class="site-title">
                           <?php 
							   bloginfo( 'name' ); 
						  echo $logotag['close']; ?>   
                        </a>   
                    		 <?php echo $description_tag['open']; ?> class="site-description"><?php bloginfo( 'description' ); ?> <?php echo $description_tag['close']; ?>
                            </div>
                    	 
                          </div>
                    </div>
                    
                <div class="container no-padding">
                     <div id="primary_menu" class="gray_bg">
                        <nav id="primary-menu" class="main-navigation navmenu container" role="navigation">
                                    <?php if ( has_nav_menu( 'primary' ) ) { ?>
                                   <?php wp_nav_menu( 
                                            array( 
                                                    'theme_location' => 'primary', 
                                                    'items_wrap'=> '<ul itemscope itemtype="https://schema.org/SiteNavigationElement" id="%1$s" class="%2$s">%3$s</ul>', 
                                                    'container' => 'none', 
                                            ) ); 
                                  ?>
                                  <?php } else { ?>  
                                    <ul class="menu clearfix">
                                            <?php wp_list_categories('title_li='); ?>
                                        </ul>
                                     <?php
                                        }
                                      ?>
                                  
                         </nav><!-- #primary_menu -->
                    </div>    
   			 </div>
  
         </header>
  			 <!--header wrapper End Here-->
       
            <div class="clearboth"></div>
			
            <!-- BreadCrumbs -->
            <?php if(!is_front_page() || !is_home()): ?>
				     
            	<div class="breadcrumbs">
					<div class="container">
                      <div class="row">
						<?php northeast_breadcrumbs(); ?>
                       </div>
                    </div>
                </div>
           
           <?php endif; ?>
   
     	<!--Middle wrapper Start Here--> 
            <div class="middle_wrapper">
            	<div class="container no-padding">
                	<div class="row">