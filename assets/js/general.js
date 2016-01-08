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

		// tooltips
		 $('[data-toggle="tooltip"]').tooltip()

		// Anchor Link Directions
		$('#hike-map--directions').on('click',function(){
		 	goDirections()
		});
		function goDirections(){
		    // if mobile
		    if( (navigator.platform.indexOf("iPhone") != -1) 
		        || (navigator.platform.indexOf("iPod") != -1)
		        || (navigator.platform.indexOf("iPad") != -1))
		         window.open("maps://maps.google.com/maps?daddr="+fo_local_vars.hike_lat+","+fo_local_vars.hike_long+"&amp;ll=");
		    else
		         window.open("http://maps.google.com/maps?daddr="+fo_local_vars.hike_lat+","+fo_local_vars.hike_long+"&amp;ll=");
		}

		// Fitvids
		$('.entry-content').fitVids();
	});


})( jQuery );