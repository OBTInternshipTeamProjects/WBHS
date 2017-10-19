<?php
/**
* The template for displaying all single posts and attachments
*
*/
get_header(); ?>
<div class="container">
	<div class="row">
		<div id="primary" class="col-sm-9">
			<main id="main" class="site-main">
				<?php
				// Start the loop.
				while ( have_posts() ) : the_post();
					// Include the single post content template.
					get_template_part( 'template-parts/content', 'single' );
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					if ( is_singular( 'attachment' ) ) {
						// Parent post navigation.
						the_post_navigation( array(
							'prev_text' => esc_html__( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'saybusiness' ),
						) );
					} elseif ( is_singular( 'post' ) ) {
						// Previous/next post navigation.
						the_post_navigation( array(
							'next_text' => '<span class="meta-nav screen-reader-text" aria-hidden="true">' . esc_html__( 'Next', 'saybusiness' ) . '</span> ',
							'prev_text' => '<span class="meta-nav screen-reader-text" aria-hidden="true">' . esc_html__( 'Previous', 'saybusiness' ) . '</span> ',
						) );
					}
					// End of the loop.
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