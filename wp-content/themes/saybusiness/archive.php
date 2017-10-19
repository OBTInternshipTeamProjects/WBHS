<?php
/**
 * The template for displaying posts archive.
 *
 */
get_header(); ?>
<div class="container">
	<div class="row">
		<div id="primary" class="col-sm-9">
			<main id="main" class="site-main">
			<?php if ( have_posts() ) : ?>
				<header class="page-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->
				<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();
					// Include the Post-Format-specific template for the content.
					get_template_part( 'template-parts/content', 'loop' );   
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