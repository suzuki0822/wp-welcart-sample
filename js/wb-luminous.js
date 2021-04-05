// luminous JavaScript Document

( function( $ ) {

	$( document ).ready( function() {

		var imgTag = 'a[href$=jpg],a[href$=jpeg],a[href$=gif],a[href$=png]';
		if ($(imgTag).length) {
			var tagLength = $(imgTag).length;

			if ( tagLength > 1 ) {
				$(imgTag).attr('class', 'luminous-g');
				new LuminousGallery(document.querySelectorAll('.luminous-g'));
			} else {
				$(imgTag).attr('class', 'luminous')
				var luminousTrigger = document.querySelector('.luminous');
				new Luminous(luminousTrigger);
			}
		}

	} );

} )( jQuery );