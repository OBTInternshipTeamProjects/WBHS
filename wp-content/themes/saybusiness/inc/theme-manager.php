<?php
/**
* Theme manager
*
*/ 
function saybusiness_add_menu_theme_manager(){ 
	$theme_manager = add_theme_page( esc_html__('SayBusiness','saybusiness'), esc_html__('SayBusiness','saybusiness'), 'manage_options', 'theme-manager', 'saybusiness_theme_manager' );
	wp_register_style( 'saybusiness_theme_manager_css', get_template_directory_uri() . '/css/theme-manager.css', array(), true );
	wp_enqueue_style( 'saybusiness_theme_manager_css');
}
//Add the theme page
add_action('admin_menu', 'saybusiness_add_menu_theme_manager');

function saybusiness_theme_manager_admin_init() {
add_settings_section( 'saybusiness-section', esc_html__( 'SayBusiness WordPress Theme', 'saybusiness' ), '', 'theme-manager'  );
add_settings_field( 'saybusiness-field', esc_html__( '', 'saybusiness' ), 'saybusiness_theme_manager_field_callback', 'theme-manager', 'saybusiness-section' ); 
}
add_action( 'admin_init', 'saybusiness_theme_manager_admin_init' );

function saybusiness_theme_manager_field_callback() { 
?> 
	<div class="saybusiness-info-container"> 
		<div class="main1"> 
		  <input id="tab1" type="radio" type="hidden" name="tabs" checked>
		  <label for="tab1"><span class="dashicons dashicons-info"></span><?php echo esc_html('About the theme','saybusiness'); ?></label>  
		  <input id="tab2" type="radio" name="tabs">
		  <label for="tab2"><span class="dashicons dashicons-admin-plugins"></span><?php echo esc_html('Supported plugins','saybusiness'); ?></label> 
		  <input id="tab3" type="radio" name="tabs">
		  <label for="tab3"><span class="dashicons dashicons-cart"></span><?php echo esc_html('Upgrade PRO','saybusiness'); ?></label> 
		  <section id="content1" class="saybusiness-content-tab">
			<p>
				<?php echo esc_html('SayBusiness is a fully responsive and customizable WordPress theme designed for any type of business. This theme makes your website to look awesome. It has Bootstrap grid for a harmonious fluid and retina ready.','saybusiness'); ?>
			</p><br>
			<p> <?php echo esc_html('All you have to do is','saybusiness'); ?>:
				<ol>
					<li><?php echo esc_html('Write some good content','saybusiness'); ?>;</li>
					<li><?php echo esc_html('Build the Home Page with widgets in Apperarance -> Widgets -> Home Page','saybusiness'); ?>;</li>
					<li><?php echo esc_html('Use page templates','saybusiness'); ?>;</li>
					<li><?php echo esc_html('Build the menus (Primary Menu and Social links Menu)','saybusiness'); ?>;</li>
					<li><?php echo esc_html('Install supported plugins, if you need','saybusiness'); ?>;</li>
					<li><?php echo esc_html('Activate your website for search engines indexing in Settings -> Reading','saybusiness'); ?>;</li>
				</ol>
			</p> 
		  </section> 
		  <section id="content2" class="saybusiness-content-tab">
		  <p><?php echo esc_html('The theme is fully compatible with this following free plugins','saybusiness'); ?>: </p> 
			 <ol>
				<li><a href="https://wordpress.org/plugins/woocommerce/" target="_blank"> WooCommerce </a></li>  
				<li><a href="https://wordpress.org/plugins/contact-form-7/" target="_blank"> Contact Form 7 </a></li> 
				<li><a href="https://wordpress.org/plugins/qtranslate-x/" target="_blank"> qTranslate-X </a></li>
				<li><a href="https://wordpress.org/plugins/wp-user-avatars/" target="_blank"> WP User Avatars </a></li>
				<li><a href="https://wordpress.org/plugins/wordpress-seo/" target="_blank"> Yoast SEO </a></li>
				<li><a href="https://wordpress.org/plugins/simple-google-recaptcha/" target="_blank"> Simple Google reCAPTCHA </a></li>
			 </ol>
		  </section> 
 		  <section id="content3" class="saybusiness-content-tab"> 
			<p><strong><?php echo esc_html('Buy PRO version for 49 &euro; / year','saybusiness'); ?></strong></p> 
			<p><?php echo esc_html('Check demo at: ','saybusiness'); ?>&nbsp; <a href="http://saybusiness.webmarketingtransylvania.eu/pro-version/" target="_blank"><?php echo esc_html('http://saybusiness.webmarketingtransylvania.eu/pro-version/','saybusiness'); ?></a></p> 
			<p>&nbsp;</p> 
			<p><?php echo esc_html('PRO version features / services:','saybusiness'); ?></p>
			<p><strong><?php echo esc_html('Custom post type','saybusiness'); ?></strong></p> 
			<p><?php echo esc_html('8 custom post type (services, team, values, counters, timeline, partners, testimonials, portfolio) easy to use','saybusiness'); ?></p>
			<p><?php echo esc_html('Page templates for every custom post type','saybusiness'); ?></p>
			<p><?php echo esc_html('Widgets for every custom post type to build pages with sections' ,'saybusiness'); ?></p>  
			<p><strong><?php echo esc_html('Demo content','saybusiness'); ?></strong></p> 
			<p><?php echo esc_html('Demo content (.xml file). All you have to do is to navigate in Tools section from dashboard -> import -> WordPress (importer), the last one. After than run the importer and browse for the xml file in your computer.','saybusiness'); ?></p>
			<p><strong><?php echo esc_html('Technical support','saybusiness'); ?></strong></p>  
			<p><?php echo esc_html('You will receive have acces to our forum for tehnical support','saybusiness'); ?></p>
			<p><strong><?php echo esc_html('Updates','saybusiness'); ?></strong></p>  
			<p><?php echo esc_html('You will have acces to theme updates. The theme will be compatible with all next versions of WordPress.','saybusiness'); ?></p> 
			<p>&nbsp;</p> 
		  </section>
		</div>
			<div class="clear"></div> 
			<strong style="border-top: 1px solid #F3F3F3; margin-left: 10px;"><?php echo esc_html('Don\'t forget to rate us on ','saybusiness'); ?></strong>
			<a href="https://wordpress.org/support/theme/saybusiness/reviews/#new-post" target="_blank">WordPress.org</a>. <strong><?php echo esc_html('Thank you!','saybusiness'); ?></strong>
	</div> 
<?php 
} 
//Callback
function saybusiness_theme_manager() {
?>
	<div class="saybusiness-info-container">
			<form action="options.php" method="POST"> 
			<?php settings_fields( 'saybusiness_settings' ); ?>
			<?php do_settings_sections( 'theme-manager' ); ?>
			<?php //submit_button(); ?>
			</form>
	</div>
	<div class="saybusiness-info-blocks">
		<div class="info-blocks">
			<a href="https://webmarketingtransylvania.eu/product/saybusiness" target="_blank">
				<div class="info-block">
					<div class="dashicons dashicons-desktop info-icon"></div>
					<p class="info-text"><?php echo esc_html('Upgrade PRO','saybusiness'); ?></p>
				</div>
			</a>
			<a href="http://www.webmarketingtransylvania.eu/knowledge" target="_blank">
				<div class="info-block">
					<div class="dashicons dashicons-book-alt info-icon"></div>
					<p class="info-text"><?php echo esc_html('Documentation','saybusiness'); ?></p>
				</div>
			</a>
			<a href="http://www.webmarketingtransylvania.eu/support" target="_blank">
				<div class="info-block">
					<div class="dashicons dashicons-sos info-icon"></div>
					<p class="info-text"><?php echo esc_html('Support','saybusiness'); ?></p>
				</div>
			</a>
		</div>
	</div>
<?php
}  
//Styles
function saybusiness_theme_manager_hook_styles(){
   	add_action( 'admin_enqueue_scripts', 'saybusiness_theme_manager_styles' );
}
function saybusiness_theme_manager_styles() {
	wp_enqueue_style( 'saybusiness_theme_manager_css', get_template_directory_uri() . '/css/theme-manager.css', array(), true );
}
?>