<?php
/**
 * The template used for displaying page content
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>   
	<header class="entry-header"> 
		<h1 class="entry-title"> 
			<?php the_title(); ?> 
		</h1>
	</header><!-- .entry-header -->   
	<div class="entry-content"> 
		<?php 
			the_content( null, true ); 
			wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'saybusiness' ),
			'after'  => '</div>',
			));
		?>
	</div><!-- .entry-content --> 
	<footer class="entry-footer">
		<?php saybusiness_entry_meta(); ?>
	</footer><!-- .entry-footer -->  
</article><!-- #post-## -->