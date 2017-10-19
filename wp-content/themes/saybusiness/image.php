<?php
/**
 * The template for displaying image attachments
 *
 */ 
get_header(); 
?>
<div class="container">
	<div class="row">
		<div id="primary" class="col-sm-9">
			<main id="main" class="site-main">
				<?php
					// Start the loop.
					while ( have_posts() ) : the_post();
				?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
						<header class="entry-header">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						</header><!-- .entry-header -->
						<div class="entry-content">
							<div class="entry-attachment">
								<?php
									//Filter the default image attachment size.
									$image_size = apply_filters( 'saybusiness_attachment_size', 'large' );
									echo wp_get_attachment_image( get_the_ID(), $image_size );
								?>
								<?php the_excerpt( 'entry-caption' ); ?>
							</div><!-- .entry-attachment -->
							<?php
								the_content();
								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'saybusiness' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
									'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'saybusiness' ) . ' </span>%',
									'separator'   => '<span class="screen-reader-text">, </span>',
								) );
							?>
						</div><!-- .entry-content -->
						<footer class="entry-footer">
							<?php saybusiness_entry_meta(); ?>
							<?php
								// Retrieve attachment metadata.
								$metadata = wp_get_attachment_metadata();
								if ( $metadata ) {
									printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
										esc_html__( 'Full size', 'saybusiness' ),
										esc_url( wp_get_attachment_url() ),
										absint( $metadata['width'] ),
										absint( $metadata['height'] )
									);
								}
							?>
						</footer><!-- .entry-footer -->
						<nav id="image-navigation" class="navigation image-navigation">
							<div class="nav-links">
								<div class="nav-previous"><?php previous_image_link( false, esc_html__( 'Previous Image: ', 'saybusiness' ) ); ?></div>
								<div class="nav-next"><?php next_image_link( false, esc_html__( 'Next Image: ', 'saybusiness' ) ); ?></div>
							</div><!-- .nav-links -->
						</nav><!-- .image-navigation -->
					</article><!-- #post-## -->
					<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						} 
					// End the loop.
					endwhile;
				?>
			</main><!-- .site-main -->
		</div><!-- .content-area --> 
		<div id="secondary" class="col-sm-3">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>