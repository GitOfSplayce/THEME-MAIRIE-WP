jQuery(document).ready(function(){
/*global jQuery:false */
/*jshint devel:true, laxcomma:true, smarttabs:true */
"use strict";


	// scroll to top
	jQuery(".scrollTo_top").hide();
	jQuery(function () {
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 300) {
				jQuery('.scrollTo_top').fadeIn();
				jQuery('#header,.header_fix').addClass('scrolled'); 
			} else {
				jQuery('.scrollTo_top').fadeOut();
				jQuery('#header,.header_fix').removeClass('scrolled'); 
			}
		});

	jQuery('.scrollTo_top a').on('click',function(){
		jQuery('html, body').animate({scrollTop:0}, 300 );
		return false;
	});
	});
		
		
	/* searchtrigger */
	jQuery('a.searchOpen').on('click',function(){ 
			jQuery('#curtain').toggleClass('open'); 
            jQuery(this).toggleClass('opened'); 
			return false; 
	}); 
	
	jQuery('a.curtainclose').on('click',function(){ 
			jQuery('#curtain').removeClass('open'); 
			jQuery('a.searchOpen').removeClass('opened');
			return false; 
	});
	
	
	// mobile menu dropdown
	
    jQuery(document).ready(function () {
        tmnf_dropdown_mobile();
    });
	
    window.tmnf_dropdown_mobile = () => {
        let windowW = jQuery(window).width();

        jQuery('#main-nav li.menu-item-has-children > a').each(function () {
            jQuery(this).append('<span class="tmnf_mobile_dropdown">↓</span>');
        });

        jQuery('body').find('.tmnf_mobile_dropdown').on('click', function (e) {
            e.preventDefault();
            let dd = jQuery(this);
            dd.closest('li').toggleClass(function () {
                if ( window.innerWidth < 1025) {
                    let subMenu = dd.closest('li').children('.sub-menu');
                    subMenu.toggle();
                }
                return 'active';
            });
        });
    };


});


	
jQuery( function ( $ ) {
  // Focus styles for menus when using keyboard navigation

  // Properly update the ARIA states on focus (keyboard) and mouse over events
  $( '[role="menubar"]' ).on( 'focus.aria  mouseenter.aria', '[aria-haspopup="true"]', function ( ev ) {
    $( ev.currentTarget ).attr( 'aria-expanded', true );
  } );

  // Properly update the ARIA states on blur (keyboard) and mouse out events
  $( '[role="menubar"]' ).on( 'blur.aria  mouseleave.aria', '[aria-haspopup="true"]', function ( ev ) {
    $( ev.currentTarget ).attr( 'aria-expanded', false );
  } );
} );