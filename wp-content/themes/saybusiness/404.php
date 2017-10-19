<?php
/**
* The template for displaying 404 pages (not found)
*
*/ 
get_header(); 
?> 
<div class="container">
	<div class="row">
		<div id="primary" class="col-sm-9">
			<main id="main" class="site-main">
				<section class="error-404 not-found">
					<header class="page-header"> 
						<h1 class="page-title"><?php echo esc_html( 'Oops! That page can&rsquo;t be found.','saybusiness'); ?></h1>
					</header><!-- .page-header -->
					<div class="page-content">
						<p><?php echo esc_html( 'It looks like nothing was found at this location. Maybe try a search?','saybusiness'); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .page-content -->
				</section><!-- .error-404 -->
			</main><!-- .site-main -->
		</div><!-- .content-area -->
		<div id="secondary" class="col-sm-3">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div> 
<?php get_footer(); ?>