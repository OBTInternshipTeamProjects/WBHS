<?php
/**
 * The template part for displaying an Author biography
 */
?> 
<div class="author-info">
	<div class="author-avatar">
		<?php
			//* Filter the author bio avatar size
			$author_bio_avatar_size = apply_filters( 'saybusiness_author_bio_avatar_size', 64 ); 
			echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div><!-- .author-avatar --> 
	<div class="author-description">
		<h2 class="author-title">
			<span class="author-heading"><?php esc_html__( 'Author:', 'saybusiness' ); ?></span> 
			<?php echo get_the_author(); ?>
		</h2>
		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?> 
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( esc_html__( 'View all posts by %s', 'saybusiness' ), get_the_author() ); ?>
			</a>
		</p><!-- .author-bio -->
	</div><!-- .author-description -->
</div><!-- .author-info --> 