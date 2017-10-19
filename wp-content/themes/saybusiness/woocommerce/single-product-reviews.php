<?php  
/**  
 * Display single product reviews (comments)  
 *  
 */   
global $product;  
if ( ! defined( 'ABSPATH' ) ) {  
	exit; // Exit if accessed directly  
}  
if ( ! comments_open() ) {  
	return;  
}  
?>  
<div id="reviews">  
	<div id="comments">  
		<?php if ( have_comments() ) : ?>  
			<ol class="commentlist">  
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>  
			</ol>  
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  
				echo '<nav class="woocommerce-pagination">';  
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(  
					'prev_text' => '&lang;',  
					'next_text' => '&rang;',  
					'type'      => 'list',  
				) ) );  
				echo '</nav>';  
			endif; ?>  
		<?php else : ?>  
			<p class="woocommerce-noreviews"><?php esc_html__( 'There are no reviews yet', 'saybusiness' ); ?></p>  
		<?php endif; ?>  
	</div>  
	<?php global $product;
		  $hf_user = wp_get_current_user();
		  $hf_username = $hf_user->user_login;
		  if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', $hf_username, $product->get_id() ) ) : ?>  
		<div id="review_form_wrapper">  
			<div id="review_form">  
				<?php  
					$commenter = wp_get_current_commenter();  
					$comment_form = array(  
						'title_reply'          => have_comments() ? esc_html__( 'Add a review', 'saybusiness' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'saybusiness' ), get_the_title() ),  
						'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'saybusiness' ),  
						'comment_notes_before' => '',  
						'comment_notes_after'  => '',  
						'fields'               => array(  
							'author' => '<div class="comment-form-author-email clearfix"><p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" placeholder="'. esc_html__( 'Name*', 'saybusiness' ).'" /></p>',  
							'email'  => '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" placeholder="'. esc_html__( 'Email*', 'saybusiness'  ).'"/></p></div>',  
						),  
						'label_submit'  => esc_html__( 'Submit', 'saybusiness' ),  
						'logged_in_as'  => '',  
						'comment_field' => ''  
					);  
					if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {  
						$comment_form['must_log_in'] = '<p class="must-log-in">' .  sprintf( esc_html__( 'You must be <a href="%s">logged in</a> to post a review', 'saybusiness' ), esc_url( $account_page_url ) ) . '</p>';  
					}  
					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {  
						$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . esc_html__( 'Your Rating', 'saybusiness') .'</label><select name="rating" id="rating">  
							<option value="">' . esc_html__( 'Rate&hellip;', 'saybusiness' ) . '</option>  
							<option value="5">' . esc_html__( 'Perfect', 'saybusiness' ) . '</option>  
							<option value="4">' . esc_html__( 'Good', 'saybusiness' ) . '</option>  
							<option value="3">' . esc_html__( 'Average', 'saybusiness' ) . '</option>  
							<option value="2">' . esc_html__( 'Not that bad', 'saybusiness' ) . '</option>  
							<option value="1">' . esc_html__( 'Very poor', 'saybusiness' ) . '</option>  
						</select></p>';  
					}  
					$comment_form['comment_field'] .= '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="'.esc_html__( 'Your Review', 'saybusiness' ) .'"></textarea></p>';  
					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );  
				?>  
			</div>  
		</div>  
	<?php else : ?>  
		<p class="woocommerce-verification-required"><?php esc_html__( 'Only logged in customers who have purchased this product may leave a review', 'saybusiness' ); ?></p>  
	<?php endif; ?>  
	<div class="clear"></div>  
</div>  