<?php
// SayBusiness back compat functionality
function saybusiness_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME ); 
	unset( $_GET['activated'] ); 
	add_action( 'admin_notices', 'saybusiness_upgrade_notice' );
}
add_action( 'after_switch_theme', 'saybusiness_switch_theme' );

// Adds a message for unsuccessful theme switch.
function saybusiness_upgrade_notice() {
	$message = sprintf( esc_html( 'SayBusiness requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'saybusiness' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

// Prevents the Customizer from being loaded on WordPress versions prior to 4.4.
function saybusiness_customize() {
	wp_die( sprintf( esc_html( 'SayBusiness requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'saybusiness' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'saybusiness_customize' );

// Prevents the Theme Preview from being loaded on WordPress versions prior to 4.4.
function saybusiness_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( esc_html( 'SayBusiness requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'saybusiness' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'saybusiness_preview' );