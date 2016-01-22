(function( $ ) {

  	var response
  	,	form    	= $('#fo-submission')
  	,	progress 	= $('.media-upload--progress')
  	,	bar 		= $('.media-upload--bar')
    ,	percent 	= $('.media-upload--percent')
    ,	results 	= $('#fo-submission-results')
    ,	submit      = $('input[type="submit"]')

    $('#fo-submission input:file').live('change',function (){
       	var fileName = $(this).val().split('\\').pop();
       	$('.filename').text(fileName);

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

		console.log(response);


	}

})( jQuery );
