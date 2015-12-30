(function( $ ) {

	$(document).ready(function(){

		if ( $('#object-gallery').length ){
			var gallery = $("#object-gallery").portfolio({
			});
	        gallery.init();
	    }

		// modify wp login form
		$('#loginform').find('#user_login').attr('placeholder','username')
		$('#loginform').find('#user_pass').attr('placeholder','password')

	});


})( jQuery );