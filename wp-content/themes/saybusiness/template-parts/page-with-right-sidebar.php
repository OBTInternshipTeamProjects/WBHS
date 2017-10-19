<?php
/*
Template Name: Page with right sidebar
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
						// Include the page content template.
						get_template_part( 'template-parts/content', 'page' ); 
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						} 
						// End of the loop.
					endwhile;
				?>  
			</main>
		</div><!-- .content-area -->
		<div id="secondary" class="col-sm-3">
			<?php dynamic_sidebar('sidebar-1'); ?>
		</div>
	</div>
</div>  
<?php get_footer(); ?> 