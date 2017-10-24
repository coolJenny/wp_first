<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package nitro
 */
?>

	</div><!-- #content -->

	<?php get_sidebar('footer'); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			<?php printf( __( 'Powered by %1$s.', 'nitro' ), '<a href="'.esc_url("https://rohitink.com/2015/05/21/nitro-woocommerce-theme/").'" rel="nofollow">Nitro Theme</a>' ); ?>
			<span class="sep"></span>
			<?php echo ( get_theme_mod('nitro_footer_text') == '' ) ? ('&copy; '.date('Y').' '.get_bloginfo('name').__('. All Rights Reserved. ','nitro')) : esc_html( get_theme_mod('nitro_footer_text') ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	
</div><!-- #page -->


<?php wp_footer(); ?>

</body>
</html>
