<?php
/**
* Theme functions and definitions
*
*/ 
if ( version_compare( $GLOBALS['wp_version'], '4.4', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}
if ( ! function_exists( 'saybusiness_setup' ) ) :

// Sets up theme defaults and registers support for various WordPress features.
function saybusiness_setup() {
	// Make theme available for translation.
	load_theme_textdomain( 'saybusiness', get_template_directory() . '/languages');
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links');
	
	//Support for woocommerce
	add_theme_support( 'woocommerce');
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	
	// Let WordPress manage the document title.
	add_theme_support( 'title-tag');
	
	// Screen reader text
	add_theme_support( 'screen-reader-text' );
	
	// Support excerpt in page
	add_post_type_support( 'page', 'excerpt' );
	
	// Enable support for custom logo.
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'flex-width' => true,
	) );
	
	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails');
	set_post_thumbnail_size( 1200, 6999 );
	
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'saybusiness' ),
		'social'  => esc_html__( 'Social Links Menu', 'saybusiness' ),
	) );
	
	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 
		'html5', 
		array(
			'search-form',
			'comment-form',
			'comment-list', 
			'caption',
		) );
 
	// This theme styles the visual editor to resemble the theme style, specifically font, colors, icons, and column width.
	add_editor_style( array( 'css/editor-style.css') );
	
	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets');
 
}
endif; // saybusiness_setup
add_action( 'after_setup_theme', 'saybusiness_setup');
 
// remove emoji icons
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
 
// Sets the content width in pixels, based on the theme's design and stylesheet.
function saybusiness_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'saybusiness_content_width', 840 );
}
add_action( 'after_setup_theme', 'saybusiness_content_width', 0 );
 
// Registers a widget area.
function saybusiness_widgets_init() { 
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'saybusiness' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'saybusiness' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'saybusiness' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'saybusiness' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home Page', 'saybusiness' ),
		'id'            => 'sidebar-homepage',
		'description'   => esc_html__( 'Build your Homepage with widgets', 'saybusiness' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="entry-title text-center"><h3>',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'saybusiness' ),
		'id'            => 'shop-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Contact Page Sidebar', 'saybusiness' ),
		'id'            => 'sidebar-contact',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Multi language (header)', 'saybusiness' ),
		'id'            => 'sidebar-ml',
		'description'   => esc_html__( 'Add here the multi-language switcher widget', 'saybusiness' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '',
		'after_title'   => '',
	) ); 
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'saybusiness' ),
		'id'            => 'footer',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'saybusiness' ),
		'before_widget' => '<div id="%1$s" class="widget col-md-3 col-sm-6 col-xs-12 footer-col %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'saybusiness_widgets_init');
 
// Handles JavaScript detection.
function saybusiness_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'saybusiness_javascript_detection', 0 );

// Enqueues scripts and styles.
function saybusiness_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'saybusiness-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300', array(), null );

	// Add Bootstrap used in the main stylesheet.
	wp_register_style('saybusiness-bootstrap',  get_template_directory_uri() . '/css/bootstrap.css', false);
	wp_enqueue_style('saybusiness-bootstrap');
 
	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons/genericons.css', array(), '3.4.1');

	// Add Lightbox
	wp_register_style( 'saybusiness-lightbox', get_template_directory_uri() . '/css/lightbox.css', array(), '2.0');
	wp_enqueue_style( 'saybusiness-lightbox');
 
	// Add Font Awesome, used in the main stylesheet.
	wp_enqueue_style( 'saybusiness-fontawesome', get_template_directory_uri() . '/fonts/awesome/awesome.css', array(), '4.7.0');

	// Theme stylesheet.
	wp_enqueue_style( 'saybusiness-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'saybusiness-ie', get_template_directory_uri() . '/css/ie.css', array( 'saybusiness-style' ), '20170816');
	wp_style_add_data( 'saybusiness-ie', 'conditional', 'lt IE 10');

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'saybusiness-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'saybusiness-style' ), '20170816');
	wp_style_add_data( 'saybusiness-ie8', 'conditional', 'lt IE 9');

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'saybusiness-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'saybusiness-style' ), '20170816');
	wp_style_add_data( 'saybusiness-ie7', 'conditional', 'lt IE 8');

	// Load the html5 shiv.
	wp_enqueue_script( 'saybusiness-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3');
	wp_script_add_data( 'saybusiness-html5', 'conditional', 'lt IE 9');

	// Load Isotope 
	wp_enqueue_script( 'saybusiness-isotope', get_template_directory_uri() . '/js/isotope.js', array(), '3.0.4');

	// Load lightbox 
	wp_enqueue_script( 'saybusiness-lightbox', get_template_directory_uri() . '/js/lightbox.js', array(), '2.0');

	// Load Carousel 
	wp_enqueue_script( 'saybusiness-owl-carousel', get_template_directory_uri() . '/js/owl-carousel.js', array(), '1.0');
	
	// Load Stellar
	wp_enqueue_script( 'saybusiness-stellar', get_template_directory_uri() . '/js/stellar.js', array(), '1.0');
 
	// Bootstrap 
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array(), '3.3.7');
 
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply');
	} 
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'saybusiness-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20170816');
	} 
	wp_enqueue_script( 'saybusiness-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '20170816', true ); 
}
add_action( 'wp_enqueue_scripts', 'saybusiness_scripts');

// Adds custom classes to the array of body classes.
function saybusiness_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}
	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	return $classes;
}
add_filter( 'body_class', 'saybusiness_body_classes');
 
// Theme Manager
require get_template_directory() . '/inc/theme-manager.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Customizer additions.
require get_template_directory() . '/inc/customizer.php';
 
// Slider
require get_template_directory() . '/inc/customizer-slider.php';
require get_template_directory() . '/inc/slider.php';

 // Page Template List
require get_template_directory() . '/inc/page-template.php';
 
 // Load Woocommerce additions
require get_template_directory() . '/inc/woo-functions.php';

// Add custom image sizes attribute to enhance responsive image functionality for content images
function saybusiness_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];
	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}
	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'saybusiness_content_image_sizes_attr', 10 , 2 );

//* Add custom image sizes attribute to enhance responsive image functionality for post thumbnails
function saybusiness_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'saybusiness_post_thumbnail_sizes_attr', 10 , 3 );

// Modifies tag cloud widget arguments to have all tags in the widget same font size.
function saybusiness_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'saybusiness_widget_tag_cloud_args');
  
add_filter('wp_get_attachment_link', 'saybusiness_add_rel_attribute');
function saybusiness_add_rel_attribute($link) {  
	global $post;  
	return str_replace('<a href', '<a rel="lightbox[1]" data-lightbox="lightbox[1]" title="'. get_the_title($post->ID) .'" href', $link);
}

// Display breadcrumb on header.
if ( ! function_exists( 'saybusiness_breadcrumb' ) ) : 
	function saybusiness_breadcrumb() { 
		if ( is_front_page() || is_home() ) {
			return;
		}
		if ( ! function_exists( 'breadcrumb_trail' ) ) {
			require_once trailingslashit( get_template_directory() ) . 'inc/breadcrumbs.php';
		} 
		$breadcrumb_args = array(
			'container'   => 'div',
			'show_browse' => false,
		); 
		breadcrumb_trail( $breadcrumb_args ); 
	}
add_action( 'saybusiness_action_breadcrumb', 'saybusiness_breadcrumb' );
endif;
 
// Menu Fallback 
function saybusiness_primary_menu_fallback( $args ) {
	if ( current_user_can( 'manage_options' ) ) {
		extract( $args );
		$fallback_output = null;
		if ( $container ) {
			$fallback_output = '<' . $container . '>';
		}
		$fallback_output .= '<ul>';
		$fallback_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">' . esc_html__('Add a menu','saybusiness') .'</a></li>';
		$fallback_output .= '</ul>';
		if ( $container )
			$fallback_output .= '</' . $container . '>'; 
		echo $fallback_output;    
	}
}
	
// Upsell button
require_once( trailingslashit( get_template_directory() ) . 'inc/upsell/class-customize.php' );

// Declare explicit theme support for LifterLMS course and lesson sidebars 
function saybusiness_llms_theme_support(){
	add_theme_support( 'lifterlms-sidebars' );
}
add_action( 'after_setup_theme', 'saybusiness_llms_theme_support' );

remove_action( 'lifterlms_before_main_content', 'lifterlms_output_content_wrapper', 10 );
remove_action( 'lifterlms_after_main_content', 'lifterlms_output_content_wrapper_end', 10 );
add_action( 'lifterlms_before_main_content', 'saybusiness_llms_wrapper_open', 10 );
add_action( 'lifterlms_after_main_content', 'saybusiness_llms_wrapper_close', 10 );

function saybusiness_llms_wrapper_open() {
	echo '<section class="my-wrapper-class" id="main"><div class="container"><div class="row"><div class="col-sm-9">';
}
function saybusiness_llms_wrapper_close() {
	echo '</div><div class="col-sm-3">';
	echo get_sidebar();
	echo '</div></div></div></section>';
} 
?>