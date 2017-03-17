(function($){
    "use strict";

// sticky menu
if(typeof scrolls_value !== 'undefined'){
	if ( jQuery("#header.horizontal-w").length >= 1 ) {
	jQuery(function() {
		var header = jQuery("#header.horizontal-w");
		var navHomeY = header.offset().top;
		var isFixed = false;
		var scrolls_pure = parseInt(scrolls_value);
		var $w = jQuery(window);
		$w.scroll(function(e) {
			var scrollTop = $w.scrollTop();
			var shouldBeFixed = scrollTop > scrolls_pure;
			if (shouldBeFixed && !isFixed) {
				header.addClass("sticky");
				isFixed = true;
			}
			else if (!shouldBeFixed && isFixed) {
				header.removeClass("sticky");
				isFixed = false;
			}
			e.preventDefault();
		});
	});
}};

// Header12 phone components
	(function(){
		var phone_components = $('.phones-components');
		phone_components.children('h6').eq(0).addClass('active');
		phone_components.children('h6').on('click', function() {
			phone_components.children('h6').removeClass('active');
			$(this).addClass('active');
		});
	})();

// twitter carousel
(function(){
	var $tweets = $('.tweets-owl-carousel');

	$tweets.owlCarousel({
		singleItem: true,
		pagination: false,
		autoPlay: true
	});

	// pagination
	$(".tweets-navigation .next").click(function(){
		$tweets.trigger('owl.next');
	});
	$(".tweets-navigation .prev").click(function(){
		$tweets.trigger('owl.prev');
	});
})();

	// Relate works
	(function(){
		 var owl = $("#latest-projects");
		 owl.owlCarousel({
		 	items : 4,
		 	pagination: false
		 });
		// Custom Navigation Events
		$(".latest-projects-navigation .next").click(function(){
			owl.trigger('owl.next');
		});
		$(".latest-projects-navigation .prev").click(function(){
			owl.trigger('owl.prev');
		});
	})();

// Lightbox

	jQuery("a.inlinelb").fancybox({
		scrolling:'no',
		fitToView: false,
		maxWidth: "100%",
	});

	jQuery('.fancybox-media')
	.attr('rel', 'media-gallery')
	.fancybox({
		openEffect : 'none',
		closeEffect : 'none',
		prevEffect : 'none',
		nextEffect : 'none',
		arrows : false,
		helpers : {
			media : {},
			buttons : {}
		}
	});


// Toggle Top Area

	jQuery(".w_toggle").toggle(
		function(){
			jQuery(".w_toparea").show(400);
			jQuery('.w_toggle').addClass('open');
		},
		function(){
			jQuery(".w_toparea").hide(400);
			jQuery('.w_toggle').removeClass('open');
	});


// Navigation Current Menu

	jQuery('#nav li.current-menu-item, #nav li.current_page_item, #side-nav li.current_page_item, #nav li.current-menu-ancestor, #nav li ul li ul li.current-menu-item').addClass('current');
	jQuery( '#nav li ul li:has(ul)' ).addClass('submenux');


// Navigation Active Menu (One Page)

	// some global caches
	var $window = $(window),
		nav_height = $('#nav-wrap').outerHeight();

	$('#nav').find('a').each(function() {
		// some caches
		var $this	= $(this),	// $(this) = #nav a
			href	= $this.attr('href');
		if( href && href.indexOf('#') !== -1 && href != '#' ) {
			// some caches
			var id 		= href.substring(href.indexOf('#')),
				section = $(id);
			if ( section.length > 0 ) {
				$window.on( 'resize scroll', function() {
					// some caches
					var section_top = section.offset().top - nav_height,
						section_height = section.outerHeight();
					if( $window.scrollTop() >= section_top && $window.scrollTop() < (section_top + section_height) ) {
						$this.parent().siblings().removeClass('active').end().addClass('active');
					}
				});
			}
		} // end if
	});


	// Row Animation
	if ( 'function' !== typeof(window[ 'michigan_waypoints' ] ) ) {
		window.michigan_waypoints = function () {
			$('.w-animate:not(.w-start_animation)').waypoint(function() {
				$(this).addClass('w-start_animation');
			},
			{
				offset: '70%'
			});
		}
	}
	michigan_waypoints();

	// Courses list and grid
	jQuery(document).ready(function() {
		jQuery('#list').click(function(event){
			event.preventDefault();
			jQuery('.w-courses').removeClass('course-grid-t modern-grid');
			jQuery('.w-courses').addClass('course-list-t');
			jQuery('#grid').removeClass('active');
			jQuery('#list').addClass('active');
		});
		jQuery('#grid').click(function(event){
			event.preventDefault();
			jQuery('.w-courses').removeClass('course-list-t');
			jQuery('.w-courses').addClass('course-grid-t modern-grid');
			jQuery('#list').removeClass('active');
			jQuery('#grid').addClass('active');
		});
	});

	//	Scroll to top + menu smooth scroll

	jQuery(window).on('scroll', function(){
		if (jQuery(this).scrollTop() > 100) {
			jQuery('.scrollup').fadeIn();
		} else {
			jQuery('.scrollup').fadeOut();
		}
		});
	jQuery('.scrollup').on('click', function(){
		jQuery("html, body").animate({ scrollTop: 0 }, 700);
		return false;
	});
	jQuery(function() {
		jQuery('.max-hero a.button').on('click', function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = jQuery(this.hash);
				target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					jQuery('html,body').animate({
					scrollTop: target.offset().top
					}, 700);
					return false;
				}
			}
		});
		$('#nav').find('a[href*="#"]:not([href="#"])').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					$('html, body').animate({
						scrollTop: target.offset().top
					}, 700);
					return false;
				}
			}
		});
	});


// Vertical Header - Toggle Menu

	jQuery("#toggle-icon").toggle(
		function(){
			jQuery("#header.vertical-w").fadeIn(350);
			jQuery(".vertical-socials").fadeOut(350);
			jQuery(this).addClass('active');
			jQuery('#vertical-header-wrapper').animate({ 'left': 0 },350);
		},
		function(){
			jQuery("#header.vertical-w").fadeOut(350);
			jQuery(".vertical-socials").fadeIn(350);
			jQuery(this).removeClass('active');
			jQuery('#vertical-header-wrapper').animate({ 'left': -250 },350);
		});


// Menu Responsive Switcher
	(function(){
		/* prepend menu icon */
		$('#nav-wrap').prepend('<div id="menu-icon"><i class="fa-navicon"></i> <span>Menu - </span><span class="mn-clk">Navigation</span><span class="mn-ext1"></span><span class="mn-ext2"></span><span class="mn-ext3"></span></div>');

		if ( ! $('#responavwrap').length ) {
			var $cloned_nav	 = $('#nav-wrap').find('#nav').clone().attr('id', 'responav');
			$('<div></div>', {id:'responavwrap'})
				.prepend('<div id="close-icon"><span class="mn-ext1"></span><span class="mn-ext2"></span><span class="mn-ext3"></span></div>')
				.append($cloned_nav)
				.insertAfter('#header');
		}

		/* toggle nav */
		var $res_nav_wrap	= $('#responavwrap'),
			$menu_icon		= $('#menu-icon');

		$res_nav_wrap.find('li').each(function() {
			var $list_item = $(this);

			if ( $list_item.children('ul').length ) {
				$list_item.children('a').append('<i class="sl-arrow-right respo-nav-icon"></i>');
			}

			$list_item.children('a').children('i').toggle(function() {
				$(this).attr('class', 'sl-arrow-down respo-nav-icon');
				$list_item.children('ul').slideDown(350);
			}, function() {
				$(this).attr('class', 'sl-arrow-right respo-nav-icon');
				$list_item.children('ul').slideUp(350);
			});
		});

		$menu_icon.on('click', function() {
			if ( $res_nav_wrap.hasClass('open') === false ) {
				$res_nav_wrap.animate({'left': 0},350).addClass('open');
			} else {
				$res_nav_wrap.animate({'left': -265},350).removeClass('open');
			}
		});

		$res_nav_wrap.find('#close-icon').on('click', function() {
			if ( $res_nav_wrap.hasClass('open') === true ) {
				$res_nav_wrap.animate({'left': -265},350).removeClass('open');
			}
		});
	})();

//	Windows Phone 8 and Device-Width + Menu fix

	if (navigator.userAgent.match(/IEMobile\/10\.0/)) {

		var msViewportStyle = document.createElement("style");
		msViewportStyle.appendChild(
			document.createTextNode(
				"@-ms-viewport{width:auto!important}"
			)
		);
		document.getElementsByTagName("head")[0].
		appendChild(msViewportStyle);
		jQuery('ul#nav').addClass('ie10mfx');
	}


// doubleTapToGo

    var deviceAgent = navigator.userAgent.toLowerCase();
    var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
    if (agentID) {
		var width = jQuery(window).width();
		if (width > 768) {
			if(jQuery( '#nav li:has(ul)' ).length){
				jQuery( '#nav li:has(ul)' ).doubleTapToGo();
			}
		}
    }
	else {
		jQuery( '#nav li:has(ul)' ).doubleTapToGo();
	}


//	Accordion

	(function() {
		var $container = jQuery('.acc-container'),
			$trigger   = jQuery('.acc-trigger');
		$container.hide();
		$trigger.first().addClass('active').next().show();
		var fullWidth = $container.outerWidth(true);
		$trigger.css('width', fullWidth);
		$container.css('width', fullWidth);
		$trigger.on('click', function(e) {
			if( jQuery(this).next().is(':hidden') ) {
				$trigger.removeClass('active').next().slideUp(300);
				jQuery(this).toggleClass('active').next().slideDown(300);
			}
			e.preventDefault();
		});
		// Resize
		jQuery(window).on('resize', function() {
			fullWidth = $container.outerWidth(true)
			$trigger.css('width', $trigger.parent().width() );
			$container.css('width', $container.parent().width() );
		});
	})();

// Nice Select Plugin for Advanced Search
	jQuery('.course-search-form, .taxonomy-search-form, .w-nice-select').find('select').niceSelect();


// Contact Form

	jQuery( "#contact-form" ).validate( {
		rules: {
			cName: {
				required: true,
				minlength: 3
			},
			cEmail: {
				required: true,
				email: true
			},
			cMessage: {
				required: true
			}
		},
		messages: {
			cName: {
				required: "Your name is mandatory",
				minlength: jQuery.validator.format( "Your name must have at least {0} characters." )
			},
			cEmail: {
				required: "Need an email address",
				email: "The email address must be valid"
			},
			cMessage: {
				required: "Message is mandatory",
			}
		},
		onsubmit: true,
		errorClass: "bad-field",
		validClass: "good-field",
		errorElement: "span",
		errorPlacement: function(error, element) {
		if(element.parent('.field-group').length) {
				error.insertAfter(element.siblings('h5'));
			} else {
				error.insertBefore(element);
			}
		}
	});


// Header search form

	jQuery('.search-form-icon').on('click', function(){
			jQuery( '.search-form-box' ).addClass('show-sbox');
			jQuery('#search-box').focus();
		});
	jQuery(document).on('click', function(ev){
		var myID = ev.target.id;
		if((myID !='searchbox-icon' ) && myID !='search-box'){
			jQuery( '.search-form-box' ).removeClass('show-sbox');
		}
	});


// Carousel Initialize


  jQuery("#students-box.w-crsl").owlCarousel({
    items : 4,
    lazyLoad : true,
	pagination : false,
	navigationText : ["",""],
	navigation : true,
	responsiveClass:true,
		responsive:{
			0:{
				items:4,
			},
			600:{
				items:4,
			},
			1000:{
				items:4,
			}
		}
  });

  jQuery(".author-carousel").owlCarousel({
    items : 3,
	pagination : false,
	navigation : true,
	navigationText : ["",""],
  });

  jQuery(".course-carousel").owlCarousel({
  	items : $(this).data('items'),
  	autoPlay : true,
	pagination : false,
	navigation : true,
	navigationText : ["",""],
  });

  jQuery(".our-team-carousel-wrap").owlCarousel({
  	items : $(this).data('items'),
  	autoPlay : true,
	pagination : false,
	navigation : true,
	navigationText : ["",""],
  });

  jQuery("#more-courses.w-crsl").owlCarousel({
	singleItem:true,
	autoPlay : true,
	pagination : false,
	navigation : true,
	navigationText : ["",""],
	items:1,
	autoHeight : true,
  });

   jQuery("#w-h-carusel.w-crsl").owlCarousel({
	singleItem:true,
	autoPlay : true,
	pagination : false,
	navigation : true,
	navigationText : ["",""],
	items:1,
	autoplayTimeout: 6000,
	autoHeight : false,
  });


   jQuery("#top-instructors.w-crsl").owlCarousel({
	singleItem:true,
	autoPlay : true,
	pagination : false,
	navigation : true,
	navigationText : ["",""],
	items:1,
	autoHeight : true,
  });

   $(".instructors-owl-carousel").each(function() {
		var $this = $(this),
   			instructors_count = $this.data('instructors-count');

		$this.owlCarousel({
			items : instructors_count,
			pagination : false,
			navigation : true,
			navigationText : ["",""]
		});
   	});

  jQuery("#testimonials-slider.w-crsl").owlCarousel({
	singleItem:true,
	autoPlay : true,
	pagination : true,
	navigation : true,
	navigationText : ["",""],
	items:1,
	autoHeight : true,
  });

	jQuery("#our-clients.crsl").owlCarousel({
	   autoPlay : true,
	   pagination : false,
	   navigation : true,
	   navigationText : ["",""],
	});

   jQuery("#latest-projects.crsl").owlCarousel({
	   autoPlay : false,
	   pagination : false,
	   navigation : true,
	   navigationText : ["",""],
  });

   // food menu carousel
	(function(){
		var owl = $('.food-menu-owl-carousel');
		owl.owlCarousel({
			items : 3, //3 items above 1000px browser width
            itemsDesktop : [1000,3], //3 items between 1000px and 961px
            itemsDesktopSmall : [960,2], //2 betweem 960px and 768px
            itemsTablet: [767,1], //1 items between 767px and 480px
            itemsMobile : [479,1], //1 items between 479px and 0
			autoPlay : true,
			pagination: false,
		});
		$(".food-menu-navigation .next").click(function(){
			owl.trigger('owl.next');
		});
		$(".food-menu-navigation .prev").click(function(){
			owl.trigger('owl.prev');
		});
	})();

	(function(){
		var owl   = $('.testimonial-owl-carousel'),
			items = owl.data('testimonial_count');

		owl.owlCarousel({
			items : items,
			pagination: false
		});
		$(".tc-navigation .next").click(function(){
			owl.trigger('owl.next');
		});
		$(".tc-navigation .prev").click(function(){
			owl.trigger('owl.prev');
		});
	})();


// Pie Initialize

	if(jQuery('.pie').length){
		jQuery('.pie').easyPieChart({
			barColor:'#ff9900',
			trackColor: '#f2f2f2',
			scaleColor: false,
			lineWidth:20,
			animate: 1000,
			onStep: function(value) {
				this.$el.find('span').text(~~value+1);
			}
		});
	}


// Progress Bar

	initProgress('.progress');
	function initProgress(el){
		jQuery(el).each(function(){
			var pData = jQuery(this).data('progress');
			progress(pData,jQuery(this));
		});
	}
	function progress(percent, $element) {
		var progressBarWidth = 0;
		(function myLoop (i,max) {
			progressBarWidth = i * $element.width() / 100;
			setTimeout(function () {
			$element.find('div').find('small').html(i+'%');
			$element.find('div').width(progressBarWidth);
			if (++i<=max) myLoop(i,max);
			}, 10)
		})(0,percent);
	}


// FlexSlider

	jQuery(window).load(function() {
		jQuery('.flexslider').flexslider();
	 });


//	Masonry

	jQuery(window).load(function() {
		if(jQuery('#pin-content').length){
			jQuery('#pin-content').masonry({
				itemSelector: '.pin-box',
			}).imagesLoaded(function() {
				jQuery('#pin-content').data('masonry');
			});
		}
	});


//  Super Slides

	jQuery('.max-hero').superslides({
		animation: 'fade'
	});


// fitVids

	jQuery("#wrap").fitVids();


//  Parallax Mas Slider

 jQuery(document).ready(function(){
 jQuery(window).bind('load', function () {
		parallaxInit();
	});
	function parallaxInit() {
		testMobile = isMobile.any();
		if (testMobile == null)
		{
			jQuery('.sparallax .slide1').parallax("50%", 0.2);
			jQuery('.sparallax .slide2').parallax("50%", 0.2);
			jQuery('.sparallax .slide3').parallax("50%", 0.2);
			jQuery('.sparallax .slide4').parallax("50%", 0.2);
			jQuery('.sparallax .slide5').parallax("50%", 0.2);
			jQuery('.sparallax .slide6').parallax("50%", 0.2);

		}
	}
	parallaxInit();
});

//Mobile Detect
var testMobile;
var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};


// Course Categories
	(function(){
		$('.course-categories').find('.course-category').each(function() {
			var $this = $(this);
			if ( window.location.href.indexOf($this.children('a').attr('href')) > -1 ) {
				$this.on('current_cat_course', function() {
					$this.addClass('active');
				});
				$this.trigger('current_cat_course');
			}
		});
	})();


// course syllabus
	(function(){
	    $('.llms-lesson').find('.lesson-title').each(function() {
	      var $this = $(this);
	      if ( $this.children('a').attr('href') == window.location.href ) {
			$this.on('current_syllabus_course', function() {
	          $this.addClass('active');
	        });
	        $this.trigger('current_syllabus_course');
	      }
	    });
	})();

// Course Sortings
( function() {
	$(document).on( 'change', '.course-sorting-form select, .course-sorting-form input[type=radio]', function( e ) {
		var $course_wrapper	 = $( '.w-courses' ),
			$course_page_nav = $( '.wp-pagenavi' ),
			$course_loader	 = $( '.course-loader' );

		$course_wrapper.css( 'display', 'none' );
		$course_page_nav.css( 'display', 'none' );
		$course_loader.css( 'display', 'block' );

		var prefix_url	= ( window.location.href.indexOf( '?' ) > -1 ) ? '&' : '?',
			query_url	= '',
			$this		= $(this);

		if ( $this.attr('name') == 'courses_price_filter' ) {
			if ( typeof old_order_val !== 'undefined' && old_order_val != '' ) {
				if ( $this.val() != '' ) {
					query_url = prefix_url + old_order_val + '&' + $this.val();
				} else {
					query_url = prefix_url + old_order_val;
				}
			} else {
				query_url = $this.val() ? prefix_url + $this.val() : '';
			}

			$.ajax({
				url: window.location.href + query_url,
				dataType: 'html',
				cache: false,
				headers: {'cache-control': 'no-cache'},
				method: 'POST',
				error: function(XMLHttpRequest, textStatus, errorThrown) {
				},
				success: function( data ) {
					if ( typeof $(data).find( '.w-courses' ).html() !== 'undefined' ) {
						$course_wrapper.html( $(data).find( '.w-courses' ).html() );
					} else {
						var src = $course_wrapper.data('empty-filter-result');
						$course_wrapper.html( '<img src="' + src + '" class="empty-filter-result">' );
					}

					if ( typeof $(data).find( '.wp-pagenavi' ).html() !== 'undefined' ) {
						$course_page_nav.html( $(data).find( '.wp-pagenavi' ).html() );
					} else {
						$course_page_nav.html( ' ' );
					}

					$course_wrapper.css( 'display', 'block' ).addClass('w-start_animation');
					$course_page_nav.css( 'display', 'block' ).addClass('w-start_animation');
					$course_loader.css( 'display', 'none' );
				}
			});

			window.old_price_val = $this.val();

		} else {
			if ( typeof old_price_val !== 'undefined' && old_price_val != '' ) {
				if ( $this.val() != '' ) {
					query_url = prefix_url + old_price_val + '&' + $this.val();
				} else {
					query_url = prefix_url + old_price_val;
				}
			} else {
				query_url = $this.val() ? prefix_url + $this.val() : '';
			}
			$.ajax({
				url: window.location.href + query_url,
				dataType: 'html',
				cache: false,
				headers: {'cache-control': 'no-cache'},
				method: 'POST',
				error: function(XMLHttpRequest, textStatus, errorThrown) {
				},
				success: function( data ) {
					if ( typeof $(data).find( '.w-courses' ).html() !== 'undefined' ) {
						$course_wrapper.html( $(data).find( '.w-courses' ).html() );
					} else {
						var src = $course_wrapper.data('empty-filter-result');
						$course_wrapper.html( '<img src="' + src + '" class="empty-filter-result">' );
					}

					if ( typeof $(data).find( '.wp-pagenavi' ).html() !== 'undefined' ) {
						$course_page_nav.html( $(data).find( '.wp-pagenavi' ).html() );
					} else {
						$course_page_nav.html( ' ' );
					}

					$course_wrapper.css( 'display', 'block' ).addClass('w-start_animation');
					$course_page_nav.css( 'display', 'block' ).addClass('w-start_animation');
					$course_loader.css( 'display', 'none' );
				}
			});
			window.old_order_val = $this.val();
		}

		e.preventDefault();
	});
})();


// Countdown
	jQuery('.countdown-w').each(function() {
		var days = jQuery('.days-w .count-w', this);
		var hours = jQuery('.hours-w .count-w', this);
		var minutes = jQuery('.minutes-w .count-w', this);
		var seconds = jQuery('.seconds-w .count-w', this);
		var until = parseInt(jQuery(this).data('until'), 10);
		var done = jQuery(this).data('done');
		var self = jQuery(this);
		var updateTime = function() {
			var now = Math.round( (+new Date()) / 1000 );
			if(until <= now) {
				clearInterval(interval);
				self.html(jQuery('<span />').addClass('done-w block-w').html(jQuery('<span />').addClass('count-w').text(done)));
				return;
			}
			var left = until-now;
			seconds.text(left%60);
			left = Math.floor(left/60);
			minutes.text(left%60);
			left = Math.floor(left/60);
			hours.text(left%24);
			left = Math.floor(left/24);
			days.text(left);
		};
		var interval = setInterval(updateTime, 1000);
	});









// Countdown Clock

var doneMessage = jQuery('.countdown-clock').data('done');
var futureDate  = new Date(jQuery('.countdown-clock').data('future'));
var currentDate = new Date();
var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;
function dayDiff(first, second) {
	return (second-first)/(1000*60*60*24);
}
if (dayDiff(currentDate, futureDate) < 100) {
	jQuery('.countdown-clock').addClass('twoDayDigits');
} else {
	jQuery('.countdown-clock').addClass('threeDayDigits');
}
if(diff < 0) {
	diff = 0;
	jQuery('.countdown-message').html(doneMessage);
}
var clock = jQuery('.countdown-clock').FlipClock(diff, {
	clockFace: 'DailyCounter',
	countdown: true,
	autoStart: true,
		callbacks: {
		stop: function() {
			jQuery('.countdown-message').html(doneMessage)
		}
	}
});



// Max Counter
	jQuery('.max-counter').each(function(i, el){
		var counter = jQuery(el).data('counter');
		if ( jQuery(el).visible(true) && !jQuery(el).hasClass('counted') ) {
			setTimeout ( function () {
				jQuery(el).addClass('counted');
				jQuery(el).find('.max-count').countTo({
					from: 0,
					to: counter,
					speed: 2000,
					refreshInterval: 100
				});
			}, 1000 );
		}
	});
	var win 	= jQuery(window),
		allMods = jQuery(".max-counter");
	win.on('scroll',  function(event) {
		allMods.each(function(i, el) {
			var el = jQuery(el),
				effecttype = el.data('effecttype');
			if( effecttype === 'counter') {
				var counter = el.data('counter');
				if ( el.visible(true) && !jQuery(el).hasClass('counted') ) {
					el.addClass('counted');
					el.find('.max-count').countTo({
						from: 0,
						to: counter,
						speed: 2000,
						refreshInterval: 100
					});
				}
			}
		});
	});
	jQuery.fn.countTo = function (options) {
		options = options || {};
		return jQuery(this).each(function () {
			// set options for current element
			var settings = jQuery.extend({}, jQuery.fn.countTo.defaults, {
				from:            jQuery(this).data('from'),
				to:              jQuery(this).data('to'),
				speed:           jQuery(this).data('speed'),
				refreshInterval: jQuery(this).data('refresh-interval'),
				decimals:        jQuery(this).data('decimals')
			}, options);
			// how many times to update the value, and how much to increment the value on each update
			var loops = Math.ceil(settings.speed / settings.refreshInterval),
				increment = (settings.to - settings.from) / loops;
			// references & variables that will change with each update
			var self = this,
				$self = jQuery(this),
				loopCount = 0,
				value = settings.from,
				data = $self.data('countTo') || {};
			$self.data('countTo', data);
			// if an existing interval can be found, clear it first
			if (data.interval) {
				clearInterval(data.interval);
			}
			data.interval = setInterval(updateTimer, settings.refreshInterval);
			// initialize the element with the starting value
			render(value);
			function updateTimer() {
				value += increment;
				loopCount++;
				render(value);
				if (typeof(settings.onUpdate) == 'function') {
					settings.onUpdate.call(self, value);
				}
				if (loopCount >= loops) {
					// remove the interval
					$self.removeData('countTo');
					clearInterval(data.interval);
					value = settings.to;
					if (typeof(settings.onComplete) == 'function') {
						settings.onComplete.call(self, value);
					}
				}
			}
			function render(value) {
				var formattedValue = settings.formatter.call(self, value, settings);
				$self.html(formattedValue);
			}
		});
	};
	jQuery.fn.countTo.defaults = {
		from: 0,               // the number the element should start at
		to: 0,                 // the number the element should end at
		speed: 1000,           // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,           // the number of decimal places to show
		formatter: formatter,  // handler for formatting the value before rendering
		onUpdate: null,        // callback method for every time the element is updated
		onComplete: null       // callback method for when the element finishes updating
	};
	function formatter(value, settings) {
		return value.toFixed(settings.decimals);
	};


//  Tabs Widget

	jQuery('.widget-tabs').each(function() {
	jQuery(this).find(".tab_content").hide(); //Hide all content
		if(document.location.hash && jQuery(this).find("ul.tabs li a[href='"+document.location.hash+"']").length >= 1) {
			jQuery(this).find("ul.tabs li a[href='"+document.location.hash+"']").parent().addClass("active").show(); //Activate first tab
			jQuery(this).find(document.location.hash+".tab_content").show(); //Show first tab content
		} else {
			jQuery(this).find("ul.tabs li:first").addClass("active").show(); //Activate first tab
			jQuery(this).find(".tab_content:first").show(); //Show first tab content
		}
	});
	jQuery("ul.tabs li").on('click', function(e) {
		jQuery(this).parents('.widget-tabs').find("ul.tabs li").removeClass("active"); //Remove any "active" class
		jQuery(this).addClass("active"); //Add "active" class to selected tab
		jQuery(this).parents('.widget-tabs').find(".tab_content").hide(); //Hide all tab content
		var activeTab = jQuery(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		jQuery(this).parents('.widget-tabs').find(activeTab).fadeIn(); //Fade in the active ID content
		e.preventDefault();
	});


// Social Media

	jQuery(function(){
		jQuery("#social-media a").hover(
			function() {
				jQuery("#social-media").addClass(jQuery(this).data("network")).addClass("active");
			},
			function() {
				jQuery("#social-media").removeClass("active facebook twitter vimeo dribble youtube pinterest google linkedin rss instagram skype other-social");
			}
		);
	});

//  Parallax Sections

	jQuery(function(){
	if (jQuery('.parallax-sec').hasClass('page-title-x') ) {
		jQuery.stellar({
		horizontalScrolling: false,
		responsive: false,
		hideDistantElements: false,
		});
	}else{
		jQuery.stellar({
		horizontalScrolling: false,
		responsive: true,
		hideDistantElements: false,
		});
	}});


// Init update Woo Cart

	function updateShoppingCart(){
		"use strict";
		jQuery('body').bind('added_to_cart', add_to_cart);
		function add_to_cart(event, parts, hash) {
			var miniCart = jQuery('.woo-cart-header');
			if ( parts['div.widget-woo-cart-content'] ) {
				var $cartContent = jQuery(parts['div.widget-woo-cart-content']),
				$itemsList = $cartContent .find('.cart-list'),
				$total = $cartContent.find('.total').contents(':not(strong)').text();
				miniCart.find('.woo-cart-dropdown').html('').append($itemsList);
				miniCart.find('.total span').html('').append($total);
			}
		}
	}

	document.createElement("article");
	document.createElement("section");

})(jQuery);