(function( $ ) {

	$(document).ready(function(){

		if ( $('#object-gallery').length ){
			var gallery = $("#object-gallery").portfolio({
			});
	        gallery.init();
	    }
	});

})( jQuery );