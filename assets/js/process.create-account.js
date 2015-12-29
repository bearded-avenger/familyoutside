(function( $ ) {

	$(document).ready(function(){

		var ajaxurl = fo_local_vars.ajaxurl
		,	form    = $('#fo-create-account-form')
		,	submit  = form.find('input[type="submit"]')
			confirm = $('#fo-form--confirmation')

		// if login is clicked from free signup then hide this modal
		$('#modal--create-account').find('a[data-target="#modal--login"]').on('click',function(){

			$('#modal--create-account').modal('hide')
		})

		// username validation
		$('#name').live('keyup',function(){
			if ( $(this).val().length > 3 ) {
			  	$(this).closest('.form-group').removeClass('has-error').addClass('has-success');
			  	//confirm.html('')
			} else {
		       	$(this).closest('.form-group').removeClass('has-success').addClass('has-error');
		       	//confirm.html('Username must be at least 3 characters in length!')

			}
		});

		// password validation
		$('#fo-create-user--password-2').live('keyup',function(){

		    if(  $.trim( $('#fo-create-user--password-1').val() ) == $.trim( $('#fo-create-user--password-2').val() ) ){

		        passwordValidate('pass')

		    } else {

		    	passwordValidate('fail')

		    }
		});

		// password validation
		$('#fo-create-user--password-1').live('keyup',function(){

		    if(  $.trim( $('#fo-create-user--password-2').val() ) == $.trim( $('#fo-create-user--password-1').val() ) ){

		        passwordValidate('pass')

		    } else {

		    	passwordValidate('fail')

		    }
		});

		$('#email').live('keyup',function(){
			if ( isEmail( $(this).val() ) ) {
			  	$(this).closest('.form-group').removeClass('has-error').addClass('has-success');
			  	//confirm.html('')
			} else {
		       $(this).closest('.form-group').removeClass('has-success').addClass('has-error');
		       	//confirm.html('Please enter a valid email address')

			}
		});

	  	$('#fo-create-account-form').live('submit', function(e) {

	  		e.preventDefault();

	  		var data = $(this).serialize();

		  	$.post(ajaxurl, data, function(response) {

		  		var confirm = $('#fo-form--confirmation')  		// reset the form

		  		confirm.html('').addClass('alert');

		  		if ( 'missing-fields' == response.message ) {

		  			confirm.html('Whoopsy! Looks like you forgot a few fields.').addClass('alert alert-warning');

		  			resetRoutine( confirm );

		  		} else if ( 'user-exists' == response.message ){

		  			confirm.html('Whoopsy! This user already exists!').addClass('alert alert-warning');

		  			resetRoutine( confirm );

		  		} else if ( 'email-exists' == response.message ){

		  			confirm.html('Whoopsy! This email address already exists!').addClass('alert alert-warning');

		  			resetRoutine( confirm );

				} else if ( 'passwords-no-match' == response.message ){

		  			confirm.html('Whoopsy! Your passwords dont match!').addClass('alert alert-warning');

		  			resetRoutine( confirm );

				} else if ( true == response.success ) {

					confirm.html('Thanks for joining! Automatically logging you in...').addClass('alert alert-success btn-spin');

					successRoutine();

				} else {

					confirm.html('Whoopsy! Something has gone wrong.').addClass('alert alert-warning');

		  		}
		    });
	    });

		/**
		*	Helper function to run live validation based on pass or fail of password
		*
		*	@param type 'pass' or 'fail'
		*	@since 6.2
		*/
		function passwordValidate( type ) {

			if ( 'pass' == type ) {

				$('.password').closest('.form-group').removeClass('has-error').addClass('has-success');
		        //confirm.html('').removeClass('error');
		        submit.prop('disabled', false );

			} else if ( 'fail' == type ) {

		    	$('.password').closest('.form-group').removeClass('has-success').addClass('has-error');
		    	//confirm.html('Passwords must match!').addClass('error');
		    	submit.prop('disabled', true );
			}
		}

		/**
		*	Helper function to reset form
		*
		*	@param confirm the confirmation div
		*	@since 5.6
		*/
		function resetRoutine( confirm ){

			setTimeout(function(){
				$('#fo-create-account-form').find("input[type=text], input[type=password]").val("").css({'border-color':'#dedede'});
				confirm.remove();
			},1500);
		}

		/**
		*	Helper function to provide success message and fade out the form
		*
		*	@since 5.6
		*/
		function successRoutine(){

			$('.single-fo_flows #fo-create-account-form, .single-fo_flows .modal--terms').fadeOut().remove();

			setTimeout(function(){
				location.reload();
			},1500);

		}

		/**
		*	Helper function to ensure a proper email address is given
		*
		*	@since 5.5
		*/
	    function isEmail(email) {
		  	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		  	return regex.test(email);
		}

	});

})( jQuery );