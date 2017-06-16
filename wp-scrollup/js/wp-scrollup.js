// http://dedushka.org/uroki/5503.html 
// a@dedushka.org 
// copyright 2013

(function wp_scrollup(){

	jQuery( document ).ready(function() {

		jQuery( '<div>', {
			'id': 'scrollup', 
			'html': '&nbsp;'}).appendTo( 'body' );

		jQuery( document ).on('mouseover', '#scrollup', function(){
			jQuery( this ).animate({opacity: 0.3},100);
		}).on('mouseout', '#scrollup', function(){
			jQuery( this ).animate({opacity: 0.5},100);
		}).on('click', '#scrollup', function(){
			window.scroll(0 ,0); 
			return false;
		});

		jQuery( window ).scroll( function(){
			if ( jQuery( document ).scrollTop() > 0 ) {
				jQuery('#scrollup').fadeIn('fast');
			} else {
				jQuery('#scrollup').fadeOut('fast');
			}
		});
	});
})();