<?php
/**
* Show template in page list 
*
*/ 
class saybusiness_page_template_dashboard { 
	private $locale;
	protected static $instance = null; 
	public static function get_instance() { 
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		} // end if 
		return self::$instance; 
	} // end get_instance 
	private function __construct() { 
		// Define the actions and filters
	    add_filter( 'manage_edit-page_columns', array( $this, 'saybusiness_add_template_column' ) );
	    add_action( 'manage_page_posts_custom_column', array( $this, 'saybusiness_add_template_data' ) ); 
	} // end constructor 
	public function saybusiness_add_template_column( $page_columns ) { 
		$page_columns['template'] = esc_html__( 'Page Template', 'saybusiness' ); 
		return $page_columns; 
	} // end add_template_column 
	 public function saybusiness_add_template_data( $column_name ) { 
		// Grab a reference to the post that's currently being rendered
		global $post;
        $template_name =''; 
		// If we're looking at our custom column, then let's get ready to render some information.
		if( 'template' == $column_name ) { 
			// First, the get name of the template
			$template_name = get_page_template_slug( $post->ID ); 
			// If the file name is empty or the template file doesn't exist (because, say, meta data is left from a previous theme)...
			if( 0 == strlen( trim( $template_name ) ) || ! file_exists( get_stylesheet_directory() . '/' . $template_name ) ) { 
				// ...then we'll set it as default
				$template_name = esc_html__( 'Default', 'saybusiness' ); 
			// Otherwise, let's actually get the friendly name of the file rather than the name of the file itself by using the WordPress `get_file_description` function
			} else { 
				$template_name = get_file_description( get_stylesheet_directory() . '/template-parts/' . $template_name ); 
			} // end if 
		} // end if 
		// Finally, render the template name
		echo $template_name; 
	 } // end add_template_data 
} // end class
saybusiness_page_template_dashboard::get_instance();
?>