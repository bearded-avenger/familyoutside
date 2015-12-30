(function( $ ) {

	$(document).ready(function(){

		$(document).on('click','#manage-bookmarks', function(e){

			e.preventDefault();

			enterManager();


		}).on('click','#cancel-bookmarks', function(e){

			e.preventDefault();

			exitManager();
		});

		function enterManager(){
			$('body').addClass('bookmark-manager-open');
			$('.hide').removeClass('hide');
			$('#manage-bookmarks').addClass('hide')
		}

		function exitManager(){
			$('body').removeClass('bookmark-manager-open');
			$('#cancel-bookmarks').addClass('hide');
			$('#manage-bookmarks').removeClass('hide')
		}

	});


})( jQuery );