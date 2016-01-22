(function( $ ) {

  	var response
  	,	form    	= $('#fo-submission')
  	,	progress 	= $('.media-upload--progress')
  	,	bar 		= $('.media-upload--bar')
    ,	percent 	= $('.media-upload--percent')
    ,	results 	= $('#fo-submission-results')
    ,	submit      = $('input[type="submit"]')

    $('#fo-submission input:file').live('change',function (){

       	if( this.files[0].type == 'image/jpeg' || this.files[0].type == 'image/png' ) {

	       	// if the file size is above 1mb then warn them with a tip, and disable the submit button until we have an approprpriate size
	       	if ( this.files[0].size > 2000000 ) {
	       		alert('Your image is too big! Try resizing to under 2mb using a tool like http://tinyjpg.com or http://tinypng.com.')
	       		$(this).val('');
	       		$('.filename').text('');
	       		submit.attr('disabled','disabled');
	       	} else {
	       		submit.removeAttr('disabled')
	       	}

	    } else {
	       	alert('Please select a JPEG or PNG image to upload!');
	       	submit.attr('disabled','disabled');
	    }

	    previewImages( this.files )
    });

		function previewImages( files ){

		    var anyWindow = window.URL || window.webkitURL;

	        for(var i = 0; i < files.length; i++){
	          	var objectUrl = anyWindow.createObjectURL(files[i]);
	          	$('#imagePreview').append('<img src="' + objectUrl + '" />');
	          	window.URL.revokeObjectURL(files[i]);
	        }
		}

    form.validate({
	  	rules: {
	    	hike_length: {
	      		required: true,
	      		digits: true
	    	},
	    	hike_time: {
	      		required: true,
	      		digits: true
	    	}
	  	}
	});

    // bind form using 'ajaxForm'
    form.ajaxForm({
    	target:        results,
        beforeSubmit:  showRequest,
        success:       showResponse,
        url:    	   fo_local_vars.ajaxurl,
        beforeSend: function() {
            var percentVal = '0%';
            progress.removeClass('hide')
            progress.parent().addClass('submitting')
            bar.width(percentVal);
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal);
            percent.html(percentVal);
        }
    });

    function showRequest(formData, jqForm, options) {

		$(results).html('Submitting...');
		submit.val('Submitting...').addClass('btn-spin')

	}

	function showResponse(response, statusText, xhr, $form)  {

		form.remove();

		results.html('Thanks for submitting your hike review! We will send you an email with the status of your submission within 48 hours.')

	}

})( jQuery );
