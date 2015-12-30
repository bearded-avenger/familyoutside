<?php
/**
	* Template Name: Dashboard
 */

get_header(); ?>

	<main id="primary" class="site-main site-dashboard" role="main">

		<h3>Your Dashboard</h3>

		 <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active">
		    	<a href="#bookmarks" aria-controls="bookmarks" role="tab" data-toggle="tab">
		    		<i class="fo-icon fo-icon-plus-square"></i>
		    		Bookmarks
		    	</a>
		    </li>
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane fade in active" id="bookmarks">Your bookmarks</div>
		  </div>

	</main>

<?php
get_footer();
