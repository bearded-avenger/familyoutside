(function( $ ) {

	$(document).ready(function(){

		var $this = $(this)
		,	wrap = $('.bookmarks-list')
		,	mark = $('.bookmark')

		$(document).on('click','#manage-bookmarks', function(e){

			e.preventDefault();

			enterManager();

			markDeleted();

		}).on('click','#cancel-bookmarks', function(e){

			e.preventDefault();

			exitManager();

		}).on('click','#delete-bookmarks', function(e){

			var $this = $(this);
			$this.addClass('btn-spin');

			swal({
				title: "Delete favorites?",
				type: "error",
				text: false,
				showCancelButton: true,
				confirmButtonColor: "#50AEE2",
				confirmButtonText: "Yes, delete them!"
			},
			function(){

				runSave();

			});

		});

		function enterManager(){
			$('body').addClass('bookmark-manager-open');
			$('.hide').removeClass('hide');
			$('#manage-bookmarks').addClass('hide')
		}

		function exitManager(){
			$('body').removeClass('bookmark-manager-open');
			$('#cancel-bookmarks, #delete-bookmarks').addClass('hide');
			$('#manage-bookmarks').removeClass('hide')
		}

		function markDeleted(){

			mark.find('input[type="checkbox"]').click(function(e){

				$(this).closest('.bookmark').toggleClass('delete-me');

			});
		}

		function runSave(){

			var ids = $('.delete-me').map(function() {
			    return this.id.replace('bookmark-','');
			}).get().join(',');

			var data = {
				action: 		'process_delete_bookmarks',
				nonce: 			fo_local_vars.nonces.delete_bookmark,
				bookmark_ids:   ids
			}

			$.post( fo_local_vars.ajaxurl, data, function(response) {

				console.log(response)

				if ( true == response.success ) {

					$('.delete-me').fadeOut().remove()
					$('.delete-bookmarks').removeClass('btn-spin')

				}

			});

		}

	});


})( jQuery );