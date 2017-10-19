<?php
/**
 * SayBusiness Theme Customizer.
 *
 * @package saybusiness
 */
function saybusiness_customize_register_slider( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
 
	// Slider options
	$wp_customize->add_section('saybusiness_slider_options', array(
		'title' => esc_html__('Slider options', 'saybusiness'),
		'description' => esc_html__('', 'saybusiness'),  
		'capability' => 'edit_theme_options'
	));
	 
	// Show Slider on Home Page 
	$wp_customize->add_setting('saybusiness_theme_options_show_slider', array(
        'default'    => 0,
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'saybusiness_sanitize_checkbox'
    ) );
	$wp_customize->add_control('saybusiness_theme_options_show_slider', array(
        'label'      => esc_html__( 'Show slider on Home Page', 'saybusiness' ),
        'section'    => 'saybusiness_slider_options',
        'settings'   => 'saybusiness_theme_options_show_slider',
        'type'       => 'checkbox',
    ) );
	
	// Slides number
	$wp_customize->add_setting('saybusiness_theme_options_slides_number', array(
	  'default'	   => 3,
	  'type'       => 'theme_mod',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'saybusiness_sanitize_number',
	) );
	$wp_customize->add_control('saybusiness_theme_options_slides_number', array(
	  'label' 		=> esc_html__( 'Number of slides to show in slider', 'saybusiness' ),
	  'section' 	=> 'saybusiness_slider_options', 
	  'settings'    => 'saybusiness_theme_options_slides_number',
	  'type'		=> 'number',
	) );
	
	
	$i=0; 
	$n = esc_html(get_theme_mod( 'saybusiness_theme_options_slides_number','3'));
	for ($i=0; $i<$n; $i++) { 
 
		$wp_customize->add_setting(
			'saybusiness_slide_'.$i,
			array(
				'default'			=> '',
				'sanitize_callback' => 'absint'
			)
		);

		$wp_customize->add_control(
			'saybusiness_page'.$i,
			array(
				'settings'		=> 'saybusiness_slide_'.$i,
				'section'		=> 'saybusiness_slider_options',
				'type'			=> 'dropdown-pages',
				'label'			=> esc_html__( 'Select a page for slide no. ', 'saybusiness' ).($i+1)
			)
		); 
	}	
	
	// Chosen sanitization
	function saybusiness_sanitize_choices( $input, $setting ) {
		global $wp_customize;
	 
		$control = $wp_customize->get_control( $setting->id );
	 
		if ( array_key_exists( $input, $control->choices ) ) {
			return $input;
		} else {
			return $setting->default;
		}
	}
   
   if( class_exists( 'WP_Customize_Control' ) ):	
  
	class SayBusiness_Dropdown_Chooser extends WP_Customize_Control{
		public function render_content(){
			if ( empty( $this->choices ) )
					return;
			?>
				<label>
					<span class="customize-control-title">
						<?php echo esc_html( $this->label ); ?>
					</span>

					<?php if($this->description){ ?>
					<span class="description customize-control-description">
						<?php echo wp_kses_post($this->description); ?>
					</span>
					<?php } ?>

					<select class="saybusiness-chosen-select" <?php $this->link(); ?>>
						<?php
						foreach ( $this->choices as $value => $label )
							echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . esc_html( $label ) . '</option>';
						?>
					</select>
				</label>
			<?php
		}
	}
	endif;
		
}
add_action( 'customize_register', 'saybusiness_customize_register_slider', 11 );

if( ! function_exists('saybusiness_sanitize_checkbox') ){
	function saybusiness_sanitize_checkbox( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}
}
if( ! function_exists('saybusiness_sanitize_select') ){
	function saybusiness_sanitize_select( $input ) {
		return wp_filter_nohtml_kses( $input );
	}
}
if( ! function_exists('saybusiness_sanitize_number') ){
	function saybusiness_sanitize_number( $number, $setting ) {
		$number = absint( $number );
		return ( $number ? $number : $setting->default );
	}
} 