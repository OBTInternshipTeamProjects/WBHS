<?php
/**
* Template for displaying search forms in theme
*
*/
?> 
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group">
		<input type="search" id="search-input" class="search-field form-control" placeholder="<?php echo esc_html( 'Search &hellip;', 'saybusiness' ); ?>" value="<?php echo get_search_query(); ?>" name="s" /> 
		 <span class="input-group-btn">
			<button type="submit" class="search-submit"><span class="screen-reader-text"><?php esc_html__( 'Search', 'saybusiness' ); ?></span></button>
		</span>
	</div>
</form>
