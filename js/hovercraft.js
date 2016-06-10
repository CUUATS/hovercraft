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

		// Close hidden header and set the primary element class on window resize.
		$(window).on('resize', function() {
			if (isMobile()) {
				$('#masthead-menu').css('display', 'block').hide();
			} else {
				$('#masthead-menu').show().css('display', 'flex');
			}
			$('#page').removeClass('menu-toggled');

			var primaryWidth = $('#primary').width();
			$('#primary').toggleClass('primary-large', primaryWidth >= 800)
				.toggleClass('primary-small', primaryWidth < 800);
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

		// CUSTOM MENU WIDGET
		$('.widget_nav_menu .menu-item-has-children').each(function() {
			var expanded = false,
				li = $(this),
				toggle = $('<a href="#" class="toggle"></a>').prependTo(li).click(function(e) {
					e.preventDefault();
				}),
				sr = $('<span class="screen-reader-text"> section </span>').append(
					li.children('a').last().text()).appendTo(toggle),
				action = $('<span class="action">Open</span>').prependTo(sr);
			li.click(function(e) {
				expanded = !expanded;
				toggle.toggleClass('toggle-expanded', expanded);
				action.text(expanded ? 'Close' : 'Open');
				$(li).find('ul.sub-menu').toggle(expanded);
			});
			li.find('a:not(.toggle)').click(function(e) {
				e.stopPropagation();
			});
			if (li.is('.current-menu-item') || li.is('.current-menu-ancestor')) {
				toggle.click();
			}
		});

		// ACCORDION
		$('.accordion').each(function() {
			$(this).children().not('h2').hide();
			$(this).find('h2').each(function() {
				var expanded = false,
					heading = $(this),
					toggle = $('<a href="#" class="toggle"></a>').prependTo(heading).click(function(e) {
						e.preventDefault();
					}),
					sr = $('<span class="screen-reader-text"> section </span>').append(
						heading.text()).appendTo(toggle),
					action = $('<span class="action">Open</span>').prependTo(sr);
				heading.click(function(e) {
					expanded = !expanded;
					heading.toggleClass('accordion-expanded', expanded);
					action.text(expanded ? 'Close' : 'Open');
					heading.nextUntil('h2').toggle(expanded);
				});
			});
		});


		// Fix ARIA issues.
		// Add labels to sidebar widgets.
		$('#secondary aside').each(function() {
			$(this).attr('aria-label', $(this).find('h2').first().text());
		});

		// Add a label to post navigation.
		$('nav.post-navigation').attr('aria-label', 'Post Navigation');

		// Enable keyboard navigation of dropdown menus.
		$('.menu-item-has-children').on('focusin focusout', function() {
			$(this).toggleClass('focus');
		});
	});

})( jQuery );
