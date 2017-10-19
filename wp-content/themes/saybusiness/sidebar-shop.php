<?php
/**
 * The sidebar containing the shop widget area.
 *
 */ 
if ( ! is_active_sidebar( 'shop-sidebar' ) ) {
	return;
}
?>
<aside class="widget-area col-md-3 col-sm-12 col-xs-12">
	<?php dynamic_sidebar( 'shop-sidebar' ); ?>
</aside><!-- #secondary -->
