(function( $ ) {

	$(document).on('submit','#fo-user-info-form', function(e) {

		e.preventDefault();

		var $this 	= $(this)
		,	vars    = fo_local_vars
		, 	data 	= $this.serialize()
		,	submit 	= $this.find('input[type="submit"]')
		,	bottom 	= $this.find('.form--bottom')

		submit.val('Saving...')
		bottom.addClass('btn-spin');

		$.post( vars.ajaxurl, data, function(response) {

			console.log(response)
			if ( true == response.success ) {

				submit.val('Saved!').addClass('saved');
				bottom.removeClass('btn-spin')

				$('#modal--user-info').modal('hide')

				swal({
					title: "Thank you!",
					type: "success",
					html:true,
					text: 'Take comfort in knowing that you are making <strong>A Family Outside</strong> a better place!',
					showCancelButton: false,
					confirmButtonColor: "#50AEE2",
					confirmButtonText: "Got it!"
				}, function(){

					$('.alert--user-info').remove();
				});

			}

		});

	});


})( jQuery );