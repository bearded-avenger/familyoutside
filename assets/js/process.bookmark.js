(function( $ ) {


	$('.fo-bookmark-it').on('click', function(e) {

		e.preventDefault();

		var $this 		= $(this)
		,	vars  		= fo_local_vars

		var data = {
			action: 		$this.hasClass('fo-bookmark--unbookmark') ? 'process_unbookmark' : 'process_bookmark',
			nonce: 			vars.nonces.bookmark,
			post_id: 		$this.data('postid')
		}

		$.post( vars.ajaxurl, data, function(response) {

			if ( true == response.success ) {

				var	rem = 'fo-bookmark--unbookmark'
				,	add = 'fo-bookmark-it'

				if ( $this.hasClass( rem ) ) {

					$this.removeClass( rem )
					.addClass( add )
					.find('.fo-icon')
					.removeClass('fo-icon-minus-square')
					.addClass('fo-icon-plus-square')

				} else {

					$this.addClass( rem )
					.find('.fo-icon')
					.removeClass('fo-icon-plus-square')
					.addClass('fo-icon-minus-square')
				}

			}

		});

	});


})( jQuery );