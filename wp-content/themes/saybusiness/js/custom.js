	// Top-header search form
	jQuery(document).ready(function(){
		jQuery(".search-top").click(function(){
			jQuery("#masthead .search-form-top").toggle();
			jQuery("#masthead .search-form-top").css({"position": "absolute", "top": "40px", "right": "15px", "background-color": "#FFF", "padding": "7px", "border": "1px solid #F3F3F3", "width": "260px", "z-index": "9"}); 
			jQuery("#masthead .search-form-top").removeClass('hidden');
			jQuery("#search-input").focus();  
		});
	});

	// Top-header social menu
	jQuery(document).ready(function(){
		jQuery(".social-topmenu").click(function(){
			jQuery("#masthead .social-topmenu-ext").toggle();
		});
	});
	
	// Top-header multilanguage
	jQuery(document).ready(function(){
		jQuery(".sidebar-ml").click(function(){
			jQuery("#masthead .sidebar-ml-ext").toggle();
			jQuery("#masthead .sidebar-ml-ext").removeClass('hidden');
		});
	});
	
	// Scroll to top
	jQuery(document).ready(function(){
		jQuery("#scroll-up").hide();
		jQuery(function () {
			jQuery(window).scroll(function () {
				if (jQuery(this).scrollTop() > 600) {
					jQuery('#scroll-up').fadeIn();
				} else {
					jQuery('#scroll-up').fadeOut();
				}
			});
			jQuery('a#scroll-up').click(function () {
				jQuery('body,html').animate({
					scrollTop: 0
				}, 800);
				return false;
			});
		});
	});
	
	// Panels
	jQuery(document).ready(function(){
	  jQuery('.collapse.in').prev('.panel-heading').addClass('active');
	  jQuery('#accordion')
		.on('show.bs.collapse', function(a) {
		  jQuery(a.target).prev('.panel-heading').addClass('active');
		})
		.on('hide.bs.collapse', function(a) {
		  jQuery(a.target).prev('.panel-heading').removeClass('active');
		});
	}); 
	
	// Front-page slider
	jQuery(document).ready(function(){
		if(jQuery('#slider').length){
			jQuery('#slider').owlCarousel({
				autoPlay              : true,
				singleItem            : true,
				responsive            : true,
				autoHeight            : true, 
				mouseDrag             : true,
				touchDrag             : true, 
				responsiveRefreshRate : 0,
				transitionStyle       : 'fadeUp',
				navigation        : true,
				navigationText    : [
				'<i class="fa fa-angle-left"></i>',
				'<i class="fa fa-angle-right"></i>'
				]
			});
		}
	});

	// Sub-menu
	jQuery(document).on('click', '#site-nav .menunav-menu li.menu-item-has-children > a', function(event) {
		var menuClass = jQuery(this).parent('.menu-item-has-children');
		if (! menuClass.hasClass('focus')){
			menuClass.addClass('focus');
			event.preventDefault();
			menuClass.children('.sub-menu').css({
			   'display': 'block'
			});
		}
	});
	
	// Same height items - testimonial
	jQuery(document).ready(function() { 
			var maxHeight = 180;			
			jQuery('.testimonial').each(function(){
			  if (jQuery('.testimonial').height() > maxHeight) { maxHeight = jQuery('.testimonial').height(); }
			});			
			jQuery('.testimonial').height(maxHeight);  
	});

	// Same height items - team
	jQuery(document).ready(function() {
		var maxHeight = 325;			
		jQuery('.team').each(function(){
		  if (jQuery('.team').height() > maxHeight) { maxHeight = jQuery('.team').height(); }
		});			
		jQuery('.team').height(maxHeight); 
	});

	// Same height items - service
	jQuery(document).ready(function() {
		var maxHeight = 180;			
		jQuery('.service').each(function(){
		  if (jQuery('.service').height() > maxHeight) { maxHeight = jQuery('.service').height(); }
		});			
		jQuery('.service').height(maxHeight); 
	});

	// Same height items - portfolio
	jQuery(document).ready(function() {
		var maxHeight = 240;			
		jQuery('.portfolio').each(function(){
		  if (jQuery('.portfolio').height() > maxHeight) { maxHeight = jQuery('.portfolio').height(); }
		});			
		jQuery('.portfolio').height(maxHeight); 
	});
	 
	// Same height items - blog grid
	jQuery(document).ready(function() {
		var maxHeight = 250;			
		jQuery('.item-wrapper').each(function(){
		  if (jQuery('.item-wrapper').height() > maxHeight) { maxHeight = jQuery('.item-wrapper').height(); }
		});			
		jQuery('.item-wrapper').height(maxHeight); 
	});
	
	// Same height items - partne
	jQuery(document).ready(function() {
		var maxHeight = 70;			
		jQuery('.partner').each(function(){
		  if (jQuery('.partner').height() > maxHeight) { maxHeight = jQuery('.partner').height(); }
		});			
		jQuery('.partner').height(maxHeight); 
	});
	
	// Toggle menu
	jQuery(document).ready(function() {
		jQuery('#site-nav .menu-toggle').click(function() { 
			jQuery('#site-nav').toggleClass('toggle');
			if (jQuery('#site-nav').hasClass('toggle')){
				jQuery('#site-nav').attr( 'aria-expanded', 'true' );
			} 
		});
		jQuery('#site-nav .menu-item-has-children').append('<span class="sub-toggle"> <i class="icon-caret-down fa"></i> </span>');	
		jQuery('#site-nav .sub-toggle').click(function() {
			jQuery(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000'); 
			jQuery(this).toggleClass('active');
			jQuery(this).parent('.menu-item-has-children').toggleClass('active'); 
		}); 
	}); 
 
	// Home grid post
	jQuery(window).load( function(){				
		var $container = jQuery('#saybusinessisotope .saybusiness-grid');
			$container.isotope ({ filter: '*',
			animationOptions: {	 duration: 750,
			easing: 'linear',
			queue: false,}
			});	
			jQuery('#saybusinessisotope .saybusinessfilters a').click(function(){ 
			var selector = jQuery(this).attr('data-filter');
			if( selector !== '*' ) selector = selector.replace(selector, '.' + selector)
			$container.isotope({ filter: selector ,
				animationOptions: { 
				duration: 750,
				easing: 'linear',
				queue: false,
				}
			});
			return false; });
			var $optionSets = jQuery('#saybusinessisotope .filter'),
			$optionLinks = $optionSets.find('a');
			$optionLinks.click(function(){ var $this = jQuery(this);
			if ( $this.hasClass('active') ) { return false;}
				var $optionSet = $this.parents('.filter');
				$optionSet.find('.active').removeClass('active');
				$this.addClass('active');
				});	
		}); 