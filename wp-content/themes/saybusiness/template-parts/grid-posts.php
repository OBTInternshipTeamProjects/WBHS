<?php
/*
Template Name: Page - Grid Posts
*/ 
get_header(); 
?> 
<div class="container">	
	<div class="row">	
		<div id="primary">		
			<main id="main" class="site-main">   
					<?php  
						$servicesp = new WP_Query(array(
							'no_found_rows'       => true,
							'post_status'         => 'publish',
							'posts_per_page'	  => 25,
							'post_type' 		  => 'post',
							'orderby'			  => 'date',
							'order' 			  => 'DESC',
						)); 
					?>		
					<div id="saybusinessisotope" class="saybusinessisotope saybusiness-wrapper">
						<div class="saybusiness-filter">
							<ul class="filter saybusinessfilters">
								<li><a href="JavaScript:void(0);" data-filter="*" class="active"><?php echo esc_html('All','saybusiness'); ?></a></li>
								<?php $terms = get_terms( 'category', 'orderby=name&order=asc&offset=1&hide_empty=0&fields=all');
								foreach( $terms as $term ) { 
								$term_slug = $term->slug;
								$term_name = $term->name;?>	
								<li><a href="JavaScript:void(0);" data-filter="<?php echo $term_slug; ?>"><?php echo $term_name; ?></a></li>
								<?php } ?>	
							</ul>
						</div>
						<div class="saybusiness-grid">
							<?php 
								if ($servicesp->have_posts()) :  
								while ( $servicesp->have_posts() ) : $servicesp->the_post();
							?>
							<div class="saybusiness-item item 
								<?php $terms1 = wp_get_post_terms( $post->ID, 'category',array("fields" => "all") );							
								foreach ( $terms1 as $term1 ) { 
									echo $term1->slug;
									echo ' ';}
									$term1 = null; ?> col-md-4 col-sm-6 col-xs-12"> 
									<?php $image_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false ); ?>
									<div class="item-wrapper" style="background: url(<?php if($image_src): echo $image_src[0]; endif; ?>) no-repeat center center; background-size:cover;">  
										<a href="<?php the_permalink(); ?>">
											<div class="caption">
												<h5><?php the_title(); ?> </h5> 
												<span class="dateentry">&nbsp;<?php the_date('d-m-Y, H:i', '', ''); ?></span> 
											</div>
										</a>
									</div>
							</div>
							<?php 
								endwhile; 
								wp_reset_postdata(); 
								endif; 
							?>
						</div>
					</div> 
				<div class="col-sm-12">
					<div class="grid entry-content text-center">
						<a class="button" href="<?php echo get_post_type_archive_link( 'post' ); ?>"><?php echo esc_html__( 'Posts archive', 'saybusiness' ); ?></a>
					</div> 
				</div>	
			</main>
		</div>
	</div>
</div>
<?php get_footer(); ?> 