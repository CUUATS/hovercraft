/* global hovercraftSlider */
/**
 * Hovercraft.js
 *
 * Some custom scripts for this theme.
 */
(function($) {
	// Utility functions.
	function isMobile() {
		return $('.menu-toggle').is(':visible');
	}

	// Bind event handlers.
	$(function () {
		// BACK TO TOP
		// Check to see if the window is top if not then display back-to-top button.
		$(window).scroll(function(){
			$('.back-to-top').toggleClass('show-back-to-top', $(this).scrollTop() > 500);
		});

		// Click event to scroll to top.
		$('.back-to-top').click(function() {
			$( 'html, body' ).animate({scrollTop : 0}, 800);
			return false;
		});

		// MENUS AND TOGGLES
		// Open hidden header to reveal mobile menu.
		$('.menu-toggle').click(function() {
			$('#masthead-menu').slideToggle('fast');
		});

		// Close hidden header on window resize.
		$(window).on('resize', function() {
			if (isMobile()) {
				$('#masthead-menu').css('display', 'block').hide();
			} else {
				$('#masthead-menu').show().css('display', 'flex');
			}
			$('#page').removeClass('menu-toggled');
		}).resize();

		// BANNER IMAGES
		// Fancy scrolling for banner images.
		$(window).resize(function () {
			if ($('#banner-image').length && !isMobile()) {
				var aboveBanner = $('#wpadminbar').outerHeight() +
						$('#masthead').outerHeight(),
					bannerHeight = $('#banner-image').outerHeight(),
					bannerBreak = bannerHeight - aboveBanner;
				$(window).scroll(function() {
					var aboveBreak = $(window).scrollTop() < bannerBreak,
						bodyPadding = aboveBreak ? bannerHeight : bannerHeight - aboveBanner;
					$('body').toggleClass('scroll-above-banner-break', aboveBreak)
						.css('padding-top', bodyPadding);
				}).trigger('scroll');
			} else {
				$('body').removeClass('scroll-above-banner-break')
					.css('padding-top', 0);
				$(window).unbind('scroll');
			}
		}).resize();

	});

	/*--------------------------------------------------------------
	Accessibility fixes.
	--------------------------------------------------------------*/

	// Add a focus class to sub menu items with children.
	$( '.menu-item-has-children' ).on( 'focusin focusout', function() {
		$( this ).toggleClass( 'focus' );
	});

	// Move focus to first menu item after expanding the menu.
	$( '.menu-toggle' ).on( 'blur', function() {
		$( '#mobile-navigation' ).find( 'a:eq(0)' ).focus();
	});

})( jQuery );
