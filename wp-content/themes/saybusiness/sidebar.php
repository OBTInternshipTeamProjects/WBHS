<?php
/**
 * The template for the sidebar containing the main widget area
 *
 */ 
if (is_active_sidebar('sidebar-1')) : ?>
	<aside class="sidebar widget-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
