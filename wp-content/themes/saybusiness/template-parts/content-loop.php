<?php
/**
 * The template for displaying archive pages
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>  
	<?php if( has_post_thumbnail() ) { ?>
		<div class="entry-header">
			<div class="article-cover">
			 <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail(); ?> 
			 </a>
				<div class="entry-footer-absolute">
					<?php saybusiness_entry_meta(); ?>
				</div><!-- .entry-footer -->  
			</div>
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_title(); ?>
				</a>
			</h2>
		</div><!-- .entry-header --> 
	<?php } else { ?>
		<div class="entry-header">  
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_title(); ?>
				</a>
			</h2>
		</div><!-- .entry-header --> 
		<div class="entry-footer-relative">
			<?php saybusiness_entry_meta(); ?>
		</div><!-- .entry-footer -->						
	<?php } ?>
	<div class="entry-content"> 
		<?php the_excerpt(); ?>
		<a class="button" href="<?php the_permalink(); ?>"><?php echo esc_html('Read More','saybusiness'); ?></a> 
	</div><!-- .entry-content --> 
</article><!-- #post-## -->