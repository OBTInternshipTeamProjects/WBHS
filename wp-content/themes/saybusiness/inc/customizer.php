<?php
// ThemeCustomizer functionality
function saybusiness_custom_header_and_background() { 
	$saybusiness_default_background_color =  '#ffffff';
	$saybusiness_default_text_color       = '#007acc';

	//Filter the arguments used when adding 'custom-background' support in theme.
	add_theme_support( 'custom-background', apply_filters( 'saybusiness_custom_background_args', array(
		'default-color' => $saybusiness_default_background_color,
	) ) );

	//Filter the arguments used when adding 'custom-header' support in theme.
	add_theme_support( 'custom-header', apply_filters( 'saybusiness_custom_header_args', array(
		'default-text-color'     => $saybusiness_default_text_color,
		'width'                  => 1200,
		'height'                 => 280,
		'flex-height'            => true,
		'wp-head-callback'       => 'saybusiness_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'saybusiness_custom_header_and_background' );

if ( ! function_exists( 'saybusiness_header_style' ) ) :
//Styles the header text displayed on the site.
function saybusiness_header_style() {
	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		return;
	}

	// If the header text has been hidden.
	?>
	<style type="text/css" id="saybusiness-header-css">
		.site-branding {
			margin: 0 auto 0 0;
		}

		.site-branding .site-title,
		.site-description {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	</style>
	<?php
}
endif; // saybusiness_header_style
 
//Adds postMessage support for site title and description for the Customizer.
function saybusiness_customize_register( $wp_customize ) { 

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'saybusiness_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'saybusiness_customize_partial_blogdescription',
		) );
	}
 
	// Add background color setting and control.
	$wp_customize->add_setting( 'saybusiness_background_color', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color', 
		'type' => 'theme_mod', 
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'saybusiness_background_color', array(
		'label'       => __( 'Background Color', 'saybusiness' ),
		'section'     => 'colors',
		'settings'    => 'saybusiness_background_color',
	) ) );
 
	// Add link color setting and control.
	$wp_customize->add_setting( 'saybusiness_link_color', array(
		'default'           => '#007acc',
		'sanitize_callback' => 'sanitize_hex_color', 
		'type' 				=> 'theme_mod', 
	) );
	
	// Remove the core header textcolor control, as it shares the main text color.
	$wp_customize->remove_control( 'header_textcolor' );
	
	// Remove the core header textcolor control, as it shares the main text color.
	$wp_customize->remove_control( 'background_color' );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'saybusiness_link_color', array(
		'label'       => __( 'Link Color', 'saybusiness' ),
		'section'     => 'colors',
		'settings'   => 'saybusiness_link_color',
	) ) );

	// Add text color setting and control.
	$wp_customize->add_setting( 'saybusiness_text_color', array(
		'default'           => '#686868',
		'sanitize_callback' => 'sanitize_hex_color', 
		'type' => 'theme_mod', 
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'saybusiness_text_color', array(
		'label'       => __( 'Text Color', 'saybusiness' ),
		'section'     => 'colors',
		'settings'   => 'saybusiness_text_color',
	) ) );
 
	// Text sanitization
	function saybusiness_text_sanitize( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}
	// Link sanitization
   function saybusiness_links_sanitize() {
      return false;
   }   
}
add_action( 'customize_register', 'saybusiness_customize_register', 11 );

function saybusiness_customize_register_footer( $wp_customize ) { 	
	// Footer
	$wp_customize->add_panel('saybusiness_footer_options', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 220,
      'title' => __('Footer text', 'saybusiness'),
    ) );
	$wp_customize->add_section( 'saybusiness_footer_section' , array(
		'title' => __('Footer text', 'saybusiness'),
		'priority' => 220,
  		'panel' => 'saybusiness_footer_options',
	) );
	$wp_customize->add_setting( 'saybusiness_copyright_text', array(
		'default' => 'Copyright 2017 by Web Marketing Transylvania. All rights reserved.',  
		'sanitize_callback' => 'saybusiness_footer_text_sanitize',
		'type' => 'theme_mod', 
	) ); 
	$wp_customize->add_control( 'saybusiness_copyright_text', array(
		'label' => __( 'Copyright text', 'saybusiness' ),
		'type' => 'textarea',
		'section' => 'saybusiness_footer_section',
		'settings' => 'saybusiness_copyright_text',
	) ); 
	
	// Text sanitization
	function saybusiness_footer_text_sanitize( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}  
}
add_action( 'customize_register', 'saybusiness_customize_register_footer', 12 );

// Render the site title for the selective refresh partial.
function saybusiness_customize_partial_blogname() {
	bloginfo( 'name' );
}

// Render the site tagline for the selective refresh partial.
function saybusiness_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
 
// Binds JS handlers to make the Customizer preview reload changes asynchronously.
function saybusiness_customize_preview_js() {
	wp_enqueue_script( 'saybusiness-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20170816', true );
}
add_action( 'customize_preview_init', 'saybusiness_customize_preview_js' );

//Enqueues front-end CSS for the background color.
function saybusiness_background_color_css() {  
	$saybusiness_background_color = get_theme_mod( 'saybusiness_background_color', '#fff' ); 
	
	$css = ' 
		body,
		.site,
		.button:hover,
		.woocommerce a.button:hover, 
		input[type="date"]:focus,
		input[type="time"]:focus,
		input[type="datetime-local"]:focus,
		input[type="week"]:focus,
		input[type="month"]:focus,
		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		input[type="tel"]:focus,
		input[type="number"]:focus,
		textarea:focus{
			background-color: '. esc_html($saybusiness_background_color) . ' !important;
		}

		mark, 
		btn,
		button,
		.button, 
		.woocommerce a.button,
		button[disabled]:hover,
		button[disabled]:focus,
		input[type="button"],
		input[type="button"][disabled]:hover,
		input[type="button"][disabled]:focus,
		input[type="reset"],
		input[type="reset"][disabled]:hover,
		input[type="reset"][disabled]:focus,
		input[type="submit"],
		input[type="submit"][disabled]:hover,
		input[type="submit"][disabled]:focus,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
		.pagination .prev,
		.pagination .next,
		.pagination .prev:hover,
		.pagination .prev:focus,
		.pagination .next:hover,
		.pagination .next:focus,
		.pagination .nav-links:before,
		.pagination .nav-links:after,
		.widget_calendar tbody a,
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus,
		.page-links a,
		.page-links a:hover, 
		.site-footer .social-navigation a,
		.saybusiness-filter ul li a:hover,  
		.woocommerce .button:hover,
		.entry-content a.button:hover,
		.woocommerce button.button:hover,
		.button:hover::before, 
		.slider .button:hover,
		.page-links a:focus {
			color: '. esc_html($saybusiness_background_color) .' !important;
		} 
	'; 
	wp_add_inline_style( 'saybusiness-style', $css );
}
add_action( 'wp_enqueue_scripts', 'saybusiness_background_color_css', 10 );
 
//Enqueues front-end CSS for the link color.
function saybusiness_link_color_css() {  
	$saybusiness_link_color = get_theme_mod( 'saybusiness_link_color', '#007acc' ); 
	$css = '    
		.menu-toggle:hover,
		.menu-toggle:focus,
		.site a, 
		.site a:focus, 
		.site a:active,  
		#site-nav .screen-reader-text,
		.dropdown-toggle:hover,
		.dropdown-toggle:focus,
		.social-navigation a:hover:before,
		.social-navigation a:focus:before,
		.post-navigation a:hover .post-title,
		.post-navigation a:focus .post-title,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.site-branding .site-title a:hover,
		.site-branding .site-title a:focus,
		.entry-title a:hover,
		.entry-title a:focus,
		.entry-footer a:hover,
		.entry-footer a:focus, 
		.main-nav li:hover > a, 
		.main-nav li.current_page_item > a, 
		.main-nav li.current-menu-item > a, 
		.main-nav li.current-menu-ancestor > a,
		.main-nav li:hover > a,
		.main-nav li.current_page_item > a,
		.main-nav li.current-menu-item > a,
		.main-nav li.current-menu-ancestor > a,
		.social-navigation a,
		.post-navigation a,
		.comment-metadata a,
		.comment-metadata a:hover,
		.comment-metadata a:focus,
		.pingback .comment-edit-link:hover,
		.pingback .comment-edit-link:focus,
		.comment-form label,
		.form-allowed-tags,
		.widget_calendar tbody a,
		.widget-title a,
		.pagination a:hover,
		.pagination a:focus,
		.widget-title a,
		.site-branding .site-title a, 
		.entry-footer-content a,
		.entry-title a,  
		.entry-footer a,
		.entry-content a.button,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.sub-toggle,
		.search-top .fa.fa-search,
		.icon-caret-down,
		.required,
		.topbar .fa,
		.fa,
		.site-info a {
			color: '. esc_html($saybusiness_link_color) .' !important;
		}

		mark, 
		button:hover,
		button:focus,
		btn:hover,
		btn:focus
		btn:hover,
		btn:focus,  
		input[type="button"]:hover,
		input[type="button"]:focus,
		input[type="reset"]:hover,
		input[type="reset"]:focus,
		input[type="submit"]:hover,
		input[type="submit"]:focus,
		.pagination .prev:hover,
		.pagination .prev:focus,
		.pagination .next:hover,
		.pagination .next:focus,
		.widget_calendar tbody a,
		.page-links a:hover,
		.page-links a:focus,
		.service .fa:hover,
		.counter .fa:hover,
		.woocommerce span.onsale,  
		.saybusiness-filter ul li a:hover, 
		.woocommerce a.button,
		.woocommerce a.button:hover,
		.woocommerce .button:hover,
		.entry-content a.button:hover, 
		.button:hover::before,
		.page-links a:focus {
			background-color: '. esc_html($saybusiness_link_color) .' !important;
		}

		input[type="date"]:focus,
		input[type="time"]:focus,
		input[type="datetime-local"]:focus,
		input[type="week"]:focus,
		input[type="month"]:focus,
		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		input[type="tel"]:focus,
		input[type="number"]:focus, 
		textarea:focus, 
		.button,
		.woocommerce a.button,
		.woocommerce a.button:hover, 
		.woocommerce button.button.alt:hover,
		.tagcloud a:hover,
		.tagcloud a:focus {
			border: 1px solid '. esc_html($saybusiness_link_color) .' !important; 
		}
	'; 
	wp_add_inline_style( 'saybusiness-style', $css );
}
add_action( 'wp_enqueue_scripts', 'saybusiness_link_color_css', 11 );

//Enqueues front-end CSS for text color.
function saybusiness_text_color_css() {  
	$saybusiness_text_color = get_theme_mod( 'saybusiness_text_color', '#555' ); 
	$css = ' 
		html,
		body,
		.site h1,
		.site h2,
		.site h3,
		.site h4,
		.site h5,
		.site h6,
		.site p,
		.site a:hover, 
		blockquote,
		textarea,
		blockquote cite,
		blockquote small, 
		.site-description,
		.menu-toggle:before,  
		.menu-toggle, 
		.dropdown-toggle, 
		.page-links > .page-links-title,
		.comment-author,
		.comment-reply-title small a:hover,
		.comment-reply-title small a:focus,
		.author-bio,
		.post-password-form label,
		.post-navigation .meta-nav, 
		.comment-navigation,
		.comment-reply-title small a:hover,
		.comment-reply-title small a:focus,
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus,
		.widget .widget-title,
		.widget_recent_entries .post-date,
		.widget_rss cite, 
		.widget ul li + a, 
		.entry-content p,
		.sticky-post {
			color: '. esc_html($saybusiness_text_color) .' !important;
		}
		
		.taxonomy-description,
		.entry-caption,
		.pingback .edit-link,
		.entry-footer a:hover,
		.entry-footer a:focus,
		.site-info,		
		.site-info a:hover,
		.site-info a:focus,
		 blockquote, .site-description, 
		 body:not(.search-results) .entry-summary, 
		 body:not(.search-results) .entry-summary blockquote,  
		.comment-author, 
		.comment-metadata a, 
		.comment-notes, 
		.comment-awaiting-moderation,  
		.wp-caption .wp-caption-text, 
		.gallery-caption,
		.widecolumn .mu_register label, 
		.woocommerce ul.products li.product .price .amount, 
		.woocommerce ul.product_list_widget li a:hover,
		.woocommerce ul.products li.product .price,
		.woocommerce .woocommerce-Price-amount.amount,
		.woocommerce .entry-summary .price .amount, 
		.woocommerce div.product p.price, 
		.woocommerce div.product span.price,
		.woocommerce ul.products li.product .price {
			color: '. esc_html($saybusiness_text_color) .' !important;
		}
 
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,    
		.page-links a {
			border: 1px solid '. esc_html($saybusiness_text_color) .' !important;
		}
 
		.wpcf7 input[type="text"]:focus,
		.wpcf7 input[type="email"]:focus,
		.wpcf7 input[type="tel"]:focus,
		.wpcf7 input[type="file"]:focus,
		.wpcf7 textarea:focus {
			border:  1px solid '. esc_html($saybusiness_text_color) .' !important;
		}
	  
		.panel-heading,
		button[disabled]:hover,
		button[disabled]:focus,
		input[type="button"],
		input[type="button"][disabled]:hover,
		input[type="button"][disabled]:focus,
		input[type="reset"],
		input[type="reset"][disabled]:hover,
		input[type="reset"][disabled]:focus,
		input[type="submit"],
		input[type="submit"][disabled]:hover,
		input[type="submit"][disabled]:focus,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,  
		a#scroll-up, 
		hr,
		code,
		.woocommerce button.button, 
		.woocommerce a.button:hover::before,
		.woocommerce input.button,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,  
		.woocommerce input.button.alt {
			background-color: '. esc_html($saybusiness_text_color) .' !important;
		} 
	'; 
	wp_add_inline_style( 'saybusiness-style',  $css );
}
add_action( 'wp_enqueue_scripts', 'saybusiness_text_color_css', 12 );