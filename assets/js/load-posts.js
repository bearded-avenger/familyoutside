jQuery(document).ready(function($) {

	var pageNum  = parseInt(pagi_vars.startPage) + 1
	, 	max 	 = $('#primary').data('max-pages')
	, 	nextLink = pagi_vars.nextLink
	, 	loadMore = pagi_vars.loadMore
	, 	loading  = pagi_vars.loading
	, 	button   = '.fo-load-more-posts a';

	if(pageNum <= max) {
		$('#primary')
			.append('<div class="fo-posts clearfix fo-posts-'+ pageNum +'"></div>')
			.append('<p class="fo-load-more-posts fix"><a href="#">'+loadMore+'</a></p>');
	}

	$(button).click(function() {

		if(pageNum <= max) {

			$(this).text(loading);

			$(button).addClass('btn-spin');

			$('.fo-posts-'+ pageNum).load(nextLink + ' .post--archive',
				function() {

					pageNum++;
					nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);

					$(button).before('<div class="fo-posts clearfix fo-posts-'+ pageNum +'"></div>')

					if ( pageNum <= max ) {
						$(button).text(loadMore);
						$(button).removeClass('btn-spin');
					} else {
						$(button).parent().remove()
					}

				}
			);
		}

		return false;
	});

});