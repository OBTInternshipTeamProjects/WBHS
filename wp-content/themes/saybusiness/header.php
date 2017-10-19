<?php
/**
 * The template for displaying the header
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?> 
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">   
	<header id="masthead" class="site-header"> 
		<div class="container">
			<div class="row">
				<div class="topbar col-md-12 col-sm-12 col-xs-12"> 
					<?php if(is_active_sidebar('sidebar-ml')) { ?>
						<div class="sidebar-ml topbar-item"><i class="fa fa-language" aria-hidden="true"></i>
							<div id="sidebar-ml-ext" class="sidebar-ml-ext hidden">
								<?php dynamic_sidebar( 'sidebar-ml' ); ?>
							</div>
						</div>
					<?php } ?>
					<?php
					if ( has_nav_menu('social') ) { ?> 
					<div class="social-topmenu topbar-item"><i class="fa fa-share-alt" aria-hidden="true"></i>
						<div class="social-topmenu-ext social-navigation"> 
							<?php
								wp_nav_menu( array(
									'theme_location' => 'social',
									'menu_class'     => 'social-links-menu',
									'depth'          => 1,
									'link_before'    => '<span class="screen-reader-text">',
									'link_after'     => '</span>',
								) );
							?> 
						</div>
					</div>
					<?php } ?>
					<div class="topbar-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>feed/" target="_blank"><i class="fa fa-feed" aria-hidden="true"></i></a></div>
					<div class="search-top topbar-item"><i class="fa fa-search" aria-hidden="true"></i></div>
					<div class="search-form-top hidden" style="display: block;">
						<?php get_search_form(); ?>
					</div>
					<div class="usr topbar-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-login.php" target="_blank"><i class="fa fa-user" aria-hidden="true"></i></a></div>
				</div>
			</div>
		</div> 
		<div class="container">
			<div class="row">
				<div class="site-header-main"> 
					<div class="site-branding col-md-4 col-sm-12 col-xs-10">
						<?php saybusiness_the_custom_logo(); ?> 
						<div class="vertical-middle-site-title">
							<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html(bloginfo( 'name' )); ?></a>  
							<?php $description = esc_html(get_bloginfo( 'description', 'display' )); ?> 
							<?php  if ( $description ) : ?> 
								<span class="site-description" itemprop="description"><?php echo $description; ?></span> 
							<?php endif; ?>
						</div>
					</div><!-- .site-branding -->   
					<div class="col-md-8 col-sm-12 col-xs-12 pull-right">  
							<nav id="site-nav" class="main-nav" role="navigation" aria-expanded="false" aria-label="<?php esc_html__( 'Primary Menu', 'saybusiness' ); ?>">
								<h3 class="menu-toggle visible-sm visible-xs"></h3>
								<div class="nav-menu">
									<?php
										wp_nav_menu( array(
											'theme_location' => 'primary', 
											'container' 	 => false,
											'fallback_cb'    => 'saybusiness_primary_menu_fallback',
											'link_before'    => '<span class="screen-reader-text">',
											'link_after'     => '</span>', 
										 ) );
									?>
								</div>
							</nav><!-- .main-navigation -->  
					</div> 
				</div><!-- .site-header-main -->
			</div>
		</div>
			<?php if ( get_header_image() ) : ?>
				<?php  $custom_header_sizes = apply_filters( 'saybusiness_custom_header_sizes', '(max-width: 709px) 85vw, (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px' ); ?>
				<div class="header-image">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id ) ); ?>" sizes="<?php echo esc_attr( $custom_header_sizes ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					</a>
				</div><!-- .header-image -->
			<?php endif; // End header image check. ?> 
	</header><!-- .site-header --> 
		<?php if( !( is_front_page() ) ) { ?>
		<div class="container"> 
			<div class="row">
				<div class="col-sm-12">
					<div class="page-title-bar">
						<?php do_action('saybusiness_action_breadcrumb'); ?> 
					</div>
				</div>
			</div> 
		</div> 
		<?php } ?>
		<?php 
			if( esc_html(get_theme_mod( 'saybusiness_theme_options_show_slider','0')) == 1 ):
				if( ( is_front_page() ) ) {  
					saybusiness_slider();
				} 
			endif;
		?>
	<div class="clear"></div> 
	<div id="content" class="site-content">