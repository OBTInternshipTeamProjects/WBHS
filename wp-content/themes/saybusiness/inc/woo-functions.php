<?php
/**
* Custom hooks and function for woocommerce compatibility
*
*/
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10);
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close' );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open' );
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);

add_action('woocommerce_before_main_content', 'saybusiness_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'saybusiness_theme_wrapper_end', 10);
add_action('saybusiness_woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
add_action('saybusiness_woocommerce_archive_description', 'woocommerce_product_archive_description', 10);
add_action('woocommerce_before_subcategory_title', 'saybusiness_before_subcategory_html', 10);
add_action('woocommerce_after_subcategory_title', 'saybusiness_after_subcategory_html', 10);

function saybusiness_theme_wrapper_start() {
	echo '<div class="container">';
	echo '<header class="entry-header">';
	echo '<div class="woocommerce">'; 
	do_action('saybusiness_woocommerce_archive_description');
	echo '</div>';
	echo '</header>';
	echo '</div>';

	echo '<div class="container"><div class="row">';
	echo '<div id="" class="col-md-9 col-sm-12">';
}

function saybusiness_theme_wrapper_end() {  
  echo '</div>';
  get_sidebar( 'shop' );
  echo '</div></div>';
}

function saybusiness_before_subcategory_html(){
	echo '<div class="saybusiness-title-price clearfix">';
}

function saybusiness_after_subcategory_html(){
	echo '</div>';
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'saybusiness_loop_columns');
if (!function_exists('saybusiness_loop_columns')) {
	function saybusiness_loop_columns() {
		return 3; 
	}
}

// Display 9 products per page.
add_filter( 'loop_shop_per_page', 'saybusiness_product_per_page', 20 );
if (!function_exists('saybusiness_product_per_page')) {
	function saybusiness_product_per_page() {
		return 12; 
	}
}

add_filter( 'woocommerce_show_page_title', '__return_false' );

function saybusiness_update_woo_thumbnail(){
	$catalog = array(
		'width' 	=> '325',	// px
		'height'	=> '380',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '300',	// px
		'height'	=> '300',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '120',	// px
		'height'	=> '120',	// px
		'crop'		=> 1 		// false
	);;
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

add_action( 'init', 'saybusiness_update_woo_thumbnail');

//Change number of related products on product page
add_filter( 'woocommerce_output_related_products_args', 'saybusiness_related_products_args' );
function saybusiness_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 3 related products
	$args['columns'] = 3; // arranged in 3 columns
	return $args;
}

add_filter( 'woocommerce_product_description_heading', '__return_false' );
add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );
add_filter( 'woocommerce_pagination_args', 'saybusiness_change_prev_text');

function saybusiness_change_prev_text( $args ){
	$args['prev_text'] = '&lang;';
	$args['next_text'] = '&rang;';
	return $args;
}

add_filter( 'body_class' , 'woocommerce_column_class');

function woocommerce_column_class($classes){
	$classes[] = 'columns-3';
	return $classes;
}

add_action( 'woocommerce_before_shop_loop_item', 'saybusiness_template_loop_product_link_open' );
function saybusiness_template_loop_product_link_open(){
    echo '<div class="saybusiness-thumb-wrap">';
    echo '<a href="' . get_the_permalink() . '" class="woocommerce-LoopProduct-link thumb-link">';
}


add_action ( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 20 );
add_action( 'woocommerce_before_shop_loop_item_title', 'saybusiness_template_loop_product_link_close', 20 );
function saybusiness_template_loop_product_link_close(){
    echo '</a>';
    echo '</div>';
    echo '<div class="saybusiness-title-price clearfix">';
}