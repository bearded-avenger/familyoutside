jQuery(document).ready(function($) {

	// The number of the next page to load (/page/x/).
	var pageNum = parseInt(pagi_vars.startPage) + 1;

	// The maximum number of pages the current query can return.
	var max = $('#primary').data('max-pages');

	// The link of the next page of posts.
	var nextLink = pagi_vars.nextLink;

	var loadMore = pagi_vars.loadMore;
	var loading = pagi_vars.loading;

	/**
	 * Replace the traditional navigation with our own,
	 * but only if there is at least one page of new posts to load.
	 */
	if(pageNum <= max) {
		// Insert the "More Posts" link.
		$('#primary')
			.append('<div class="fo-posts clearfix fo-posts-'+ pageNum +'"></div>')
			.append('<p class="fo-load-more-posts fix"><a href="#">'+loadMore+'</a></p>');

	}


	/**
	 * Load new posts when the link is clicked.
	 */
	$('.fo-load-more-posts a').click(function() {


		// Are there more posts to load?
		if(pageNum <= max) {

			// Show that we're working.
			$(this).text(loading);

			$('.fo-posts-'+ pageNum).load(nextLink + ' .post--archive',
				function() {
					// Update page number and nextLink.
					pageNum++;
					nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);

					// Add a new placeholder, for when user clicks again.
					$('.fo-load-more-posts')
						.before('<div class="fo-posts clearfix fo-posts-'+ pageNum +'"></div>')

					// Update the button message.
					if(pageNum <= max) {
						$('.fo-load-more-posts a').text(loadMore);
					} else {
						$('.fo-load-more-posts a').hide();
					}

				}
			);
		} else {
			$('.fo-load-more-posts a').append('.');
		}

		return false;
	});

});