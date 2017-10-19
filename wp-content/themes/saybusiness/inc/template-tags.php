<?php
//Custom theme template tags
if ( ! function_exists( 'saybusiness_post_thumbnail' ) ) :
// Displays an optional post thumbnail.
function saybusiness_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}
	if ( is_singular() ) :
	?>
	<div class="">
		<a class="post-thumbnail" rel="lightbox" href="<?php the_post_thumbnail_url(); ?>" aria-hidden="true">
			<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
		</a>
	</div><!-- .post-thumbnail -->
	<?php else : ?>
	<div class="">
	<a class="post-thumbnail" rel="lightbox" href="<?php the_post_thumbnail_url(); ?>" aria-hidden="true">
		<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
	</a>
	</div><!-- .post-thumbnail -->
	
	<?php endif; // End is_singular()
}
endif;
 
// Determines whether blog/site has more than one category.
if ( ! function_exists( 'saybusiness_categorized_blog' ) ) :
	function saybusiness_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'saybusiness_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				// We only need to know if there is more than one category.
				'number'     => 2,
			) );
			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );
			set_transient( 'saybusiness_categories', $all_the_cool_cats );
		}
		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so saybusiness_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so saybusiness_categorized_blog should return false.
			return false;
		}
	}
endif;

// Flushes out the transients used in saybusiness_categorized_blog().
function saybusiness_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'saybusiness_categories' );
}
add_action( 'edit_category', 'saybusiness_category_transient_flusher' );
add_action( 'save_post',     'saybusiness_category_transient_flusher' );

if ( ! function_exists( 'saybusiness_the_custom_logo' ) ) :
// Displays the optional custom logo.
function saybusiness_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

// Shows meta information of post.
if ( ! function_exists( 'saybusiness_entry_meta' ) ) :
function saybusiness_entry_meta() {
   if ( 'post' == get_post_type() ) :
      echo '<span class="entry-footer-content">'; 
	  echo '<span class="entry-meta">'; 
      ?>
		<?php if(!is_singular() ) { ?> 
			<span class="authorentry"><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php esc_html(the_author()); ?></a></span>
		<?php } ?>
			<span class="dateentry"><?php the_date('d-m-Y, H:i', '', ''); ?></span>
		<?php if( has_category() ) { ?>
			<span class="catsentry"><?php the_category(', '); ?></span>
		<?php } ?>
		<?php if( has_tag() ) { ?>
			<span class="tagsentry"><?php the_tags(''); ?></span>
		<?php } ?> 
			<a href="<?php comments_link(); ?>"><span class="commentry"><?php esc_html__('Leave a comment','saybusiness'); ?> </span></a>
		<?php
			echo '</span>';
			$post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); 
   endif;
}
endif;