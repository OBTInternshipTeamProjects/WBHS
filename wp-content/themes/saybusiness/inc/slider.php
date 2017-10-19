<?php
/**
 * Set up the slider
 *   
 */ 
function saybusiness_slider() {
?> 
<div id="slider" class="slider owl-carousel owl-theme"> 
	<?php
		$saybusiness_page = '';
		$saybusiness_page_array = get_pages();
		if(is_array($saybusiness_page_array)){
			$saybusiness_page = $saybusiness_page_array[0]->ID;
		}
		$n = esc_html(get_theme_mod( 'saybusiness_theme_options_slides_number','3'));
		$x = $n-1; 
		for( $i = 0; $i <= $x; $i++ ) { 
		$slide_id = esc_html(get_theme_mod('saybusiness_slide_'.$i, $saybusiness_page )); 
		if($slide_id){
			$args = array( 'page_id' => $slide_id );
			$query = new WP_Query($args);
			if($query->have_posts()):
				while($query->have_posts()) : $query->the_post();
	?>
	<div class="item mask" style="background: url(<?php  if ( has_post_thumbnail() ) { echo get_the_post_thumbnail_url(); } ?>) no-repeat center center / cover;" data-stellar-background-ratio="0.4">
		<div class="container height-100p">
			<div class="row height-100p"> 
				<div class="col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 height-100p text-center">
					<div class="vertical-middle">
						<div class="slider-caption">
							<h1><?php the_title(); ?></h1>
							<?php the_excerpt(); ?>
						</div> 
						<a href="<?php the_permalink(); ?>" class="button"><?php echo esc_html('Read more', 'saybusiness'); ?></a>
					</div> 
				</div>
			</div> 
		</div> 
	</div> 
	<?php
		endwhile;
		endif;	
		wp_reset_postdata();
		}
	}
	?>	 
</div>  
<?php } ?>