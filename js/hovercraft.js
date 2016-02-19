/* global hovercraftSlider */
/**
 * Hovercraft.js
 *
 * Some custom scripts for this theme.
 */
( function( $ ) {

	/*--------------------------------------------------------------
	Back-To-Top.
	--------------------------------------------------------------*/

	// Check to see if the window is top if not then display back-to-top button.
	$(window).scroll(function(){
		if ($(this).scrollTop() > 500) {
			$( ".back-to-top" ).addClass( "show-back-to-top" );
		} else {
			$( ".back-to-top" ).removeClass( "show-back-to-top" );
		}
	});

	// Click event to scroll to top.
	$( '.back-to-top' ).click(function(){
		$( 'html, body' ).animate({scrollTop : 0},800);
		return false;
	});


	/*--------------------------------------------------------------
	Menu and search toggles.
	--------------------------------------------------------------*/

	// Open hidden header to reveal mobile menu.
	$( ".menu-toggle, .search-toggle" ).click(function() {
		$( "#hidden-header" ).slideToggle("fast");
	});

	// Close hidden header on window resize.
	$( window ).on( 'resize',function() {

		var windowWidth = window.innerWidth;

		if ( windowWidth >= 800 ) {
			$( "#hidden-header" ).hide();
			$( '#page' ).removeClass( 'menu-toggled' );
		}

	}).trigger( 'resize' );


	/*--------------------------------------------------------------
	Accessibility fixes.
	--------------------------------------------------------------*/

	// Add a focus class to sub menu items with children.
	$( ".menu-item-has-children" ).on( 'focusin focusout', function() {
		$( this ).toggleClass( "focus" );
	});

	// Make focus search-toggle more intuitive.
	$('.search-toggle').click(function(){
		// Add class .toggled on toggle.
		$( this ).toggleClass( "toggled" );
		// Only move focus when opened.
		if ( $( this ).hasClass( "toggled" ) ) {
			$( "#desktop-search input" ).focus();
		}
	});

	// Move focus to search input after expanding the desktop search form.
	$( ".search-toggle" ).on( 'blur', function() {
		$( "#desktop-search input" ).focus();
	});

	// Move focus to first menu item after expanding the menu.
	$( ".menu-toggle" ).on( 'blur', function() {
		$( '#mobile-navigation' ).find( 'a:eq(0)' ).focus();
	});

	// We need a wrapper to absolutely position #masthead and #colophon.
	if ( $( "body" ).hasClass( "fullscreen-slider" ) ) {
		$( "#masthead" ).wrap( "<div class='wrapper'></div>" );
		$( "#colophon" ).wrap( "<div class='wrapper'></div>" );
	}

})( jQuery );
