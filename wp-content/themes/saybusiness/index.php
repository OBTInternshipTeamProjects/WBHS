<?php
/**
 * The main template file
 *
 */
get_header(); ?> 
<div class="container-fluid">
	<?php if ( is_active_sidebar( 'sidebar-homepage' )  ) : ?>
		<?php dynamic_sidebar( 'sidebar-homepage' ); ?> 
	<?php endif; ?> 
</div>
<div class="container">
	<div class="row">
		<div id="primary" class="col-sm-9">
			<main id="main" class="site-main">
				<?php if ( have_posts() ) : ?>
					<?php if (!is_home() && !is_front_page() ) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
					<?php endif; ?>
					<?php
						// Start the loop.
						while ( have_posts() ) : the_post();
							// Include the Post-Format-specific template for the content.
							get_template_part( 'template-parts/content', 'loop' );
						// End the loop.
						endwhile;
						// Previous/next page navigation.
						the_posts_pagination( array(
							'prev_text'          => esc_html__( 'Previous page', 'saybusiness' ),
							'next_text'          => esc_html__( 'Next page', 'saybusiness' ),
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'saybusiness' ) . ' </span>',
						) );
						// If no content, include the "No posts found" template.
						else :
							get_template_part( 'template-parts/content', 'none' );
						endif;
					?>
			</main><!-- .site-main -->
		</div><!-- .content-area --> 
		<div id="secondary" class="col-sm-3">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div> 
<?php get_footer(); ?>