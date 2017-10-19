<?php
/**
 * The template for displaying the footer
 *
 */
?> 
	</div><!-- .site-content --> 
	<div class="clear"></div> 
	<div class="container">
		<div class="row"> 
			<?php if ( is_active_sidebar( 'footer' ) ) { ?>
				<div class="footer-widgets">
					<?php dynamic_sidebar( 'footer' ); ?>
				</div>
			<?php } ?> 
			<footer id="colophon" class="site-footer col-sm-12">  
				<?php if ( has_nav_menu( 'social' ) ) : ?>
					<nav class="social-navigation hidden-xs" aria-label="<?php esc_html__( 'Footer Social links Menu', 'saybusiness' ); ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'social',
								'menu_class'     => 'social-links-menu',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>',
							) );
						?>
					</nav><!-- .social-navigation -->
				<?php endif; ?> 
				<div class="site-info"> 
					<span class="site-title">
						<?php 
							$saybusiness_copyright_text = esc_html(get_theme_mod('saybusiness_copyright_text'));
							if($saybusiness_copyright_text):
								echo esc_html($saybusiness_copyright_text);  
							endif;
						?>
						<a target="_blank" href="<?php echo esc_url( esc_html( 'https://wordpress.org/', 'saybusiness' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'saybusiness' ), 'WordPress' ); ?>.</a> 
					</span>
				</div><!-- .site-info --> 
			</footer><!-- .site-footer -->
			<a href="#masthead" id="scroll-up"><i class="fa fa-angle-up" aria-hidden="true"></i></a> 
		</div>
	</div>
</div><!-- .site --> 
<?php wp_footer(); ?>
</body>
</html>