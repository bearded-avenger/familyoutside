(function( $ ) {

	$('#fo-user-info-form').on('submit', function(e) {

		e.preventDefault();

		var $this 	= $(this)
		, 	data 	= $this.serialize()
		,	submit 	= $this.find('input[type="submit"]')
		,	bottom 	= $this.find('.form--bottom')

		submit.val('Saving...')
		bottom.addClass('btn-spin');

		$.post( vars.ajaxurl, data, function(response) {

			if ( true == response.success ) {

				submit.val('Saved!').addClass('saved');
				bottom.removeClass('btn-spin')

				swal({
					title: "Thank you!!!",
					type: "success",
					html:true,
					text: 'Take comfort in knowing that you are making A Family Outside a better place!',
					showCancelButton: false,
					confirmButtonColor: "#50AEE2",
					confirmButtonText: "Close this modal"
				});

			}

		});

	});


})( jQuery );