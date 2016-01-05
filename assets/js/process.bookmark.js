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

		if ( 'true' == fo_local_vars.loggedin ) {

			$.post( vars.ajaxurl, data, function(response) {

				if ( true == response.success ) {

					var	rem = 'fo-bookmark--unbookmark'
					,	add = 'fo-bookmark-it'

					if ( $this.hasClass( rem ) ) {

						$this.removeClass( rem )
						.addClass( add )
						.find('.fo-icon')
						.removeClass('fo-icon-heart')
						.addClass('fo-icon-heart-o')

					} else {

						$this.addClass( rem )
						.find('.fo-icon')
						.removeClass('fo-icon-heart-o')
						.addClass('fo-icon-heart')

						swal({
							title: "Added to favorites!",
							type: "success",
							html:true,
							text: 'You can manage all of your favorited items by visiting your account dashboard <a href="'+fo_local_vars.dashboard_url+'">here</a>.',
							showCancelButton: false,
							confirmButtonColor: "#50AEE2",
							confirmButtonText: "Got it!"
						});
					}

				}

			});

		} else {

			swal({
				title: "Whaoh nelly!",
				type: "info",
				html:true,
				text: 'You have to be logged in to do that! Create a free account to add and manage your favorite hikes and reviews!',
				showCancelButton: true,
				cancelButtonText:'No thanks',
				confirmButtonColor: "#50AEE2",
				confirmButtonText: "Let's do it!"
			}, function(){
				$('#modal--create-account').modal('show')
			});
		}

	});


})( jQuery );