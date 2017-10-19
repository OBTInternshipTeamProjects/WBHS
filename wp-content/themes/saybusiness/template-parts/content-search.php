<?php
/**
 * The template part for displaying results in search pages
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
	</header><!-- .entry-header --> 
	<div class="entry-content">
		<?php the_excerpt(); ?>
		<a class="button" href="<?php the_permalink(); ?>"><?php echo esc_html('Read More','saybusiness'); ?></a> 
	</div> 
</article><!-- #post-## --> 