<?php
/**
	* Template Name: Dashboard
 */

get_header(); ?>

	<main id="primary" class="site-main site-dashboard" role="main">

		<?php if ( is_user_logged_in() ): ?>

			<header class="page-header">
				<?php
					the_title( '<h2 class="page-title">', '</h2>' );
				?>
			</header>

			<div class="alert alert-info">
				Let us know a little more about yourself. This will help us identify what type of folks are using our site. It will only take 30 seconds!
				<a href="#" data-toggle="modal" data-target="#modal--user-info">Let's do it!</a>
			</div>

		 	<!-- Nav tabs -->
		  	<ul class="nav nav-tabs" role="tablist">
		    	<li role="presentation" class="active">
			    	<a href="#bookmarks" aria-controls="bookmarks" role="tab" data-toggle="tab">
			    		<i class="fo-icon fo-icon-heart"></i>
			    		Favorites
			    	</a>
		    	</li>
		  	</ul>

			<div class="tab-content">
			    <div role="tabpanel" class="tab-pane fade in active" id="bookmarks">
			    	<?php
			    		$bookmarks = function_exists('fo_get_users_bookmarks') ? fo_get_users_bookmarks( get_current_user_ID() ) : false; 

						if ( $bookmarks ) { ?>

							<div id="bookmark-controls">
								<a href="#" id="manage-bookmarks" class="btn btn-primary btn-xs"><i class="fo-icon fo-icon-edit"></i>Edit</a>
								<a href="#" id="delete-bookmarks" class="hide btn btn-danger btn-xs">Delete</a>
								<a href="#" id="cancel-bookmarks" class="hide btn btn-warning btn-xs"><i class="fo-icon fo-icon-close"></i></a>
							</div>

							<?php echo '<ul class="bookmarks-list">';

								foreach ( (array) $bookmarks as $bookmark) {

									$id 	= $bookmark->post_id;
									$post 	= get_post( $id );

									?>

									<li id="bookmark-<?php echo $id;?>" <?php post_class(array('class' => 'post--archive bookmark')); ?> data-postid="<?php echo absint( $id );?>">

										<div class="checkbox">
											<label class="control" for="delete_bookmark_<?php echo absint( $id );?>">
												<input type="checkbox" id="delete_bookmark_<?php echo absint( $id );?>" name="delete_bookmark_<?php echo absint( $id );?>">
													<span class="control-indicator"></span>
											</label>
										</div>

										<div class="post--archive__image">
											<a href="<?php echo get_permalink();?>">
												<?php echo get_the_post_thumbnail( $id, 'thumbnail' ); ?>
											</a>
										</div>

										<div class="post--archive__content">
											<?php the_title( '<h4 class="post--archive__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );?>
										</div>
									</li>
									<?php
								}
								wp_reset_postdata();

							echo '</ul>';

						} else {

							'Oh no! We detected no bookmarks!';
						}

			    	?>
			    </div>
			</div>
		<?php endif; ?>

	</main>

<?php
get_sidebar();
get_footer();
