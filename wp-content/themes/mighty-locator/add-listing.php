<?php

/**
 * Template name: Add Listing
 */

$listingByAuthor = get_posts('post_type=listing&author='.get_current_user_id() );

$canCreateListing = sizeof( $listingByAuthor ) === 0 ? true : false;

if( isset( $_POST ) && !empty( $_POST ) && $canCreateListing ){
	wp_insert_post(
		wp_slash(
			[
				'post_type' => 'listing',
				'author' => get_current_user_id(),
				'post_title' => $_POST['post-name'],
				'post_content' => $_POST['post-content'],
				'post_status' => 'publish',
				'meta_input' => [
					'price_range' => $_POST['listing-price']
				]
			]
		)
	);
}

get_header();

?>

<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<h1 class="app-page-title">Account</h1>

			<div class="row g-4 mb-4">				
				<div class="col-3">
					<div class="app-card app-card-chart shadow-sm">
						<div class="app-card-header p-3">
							<div class="row justify-content-between align-items-center">
								<div class="col-auto">
									<h4 class="app-card-title">Account Settings</h4>
								</div>
							</div>
						</div>
						<div class="app-card-body p-3 ">
							<ul class="accountNav">
								<li class="accountNav__item">
									<a href="<?php echo home_url('/account/profile'); ?>" class="accountNav__link">Edit Profile</a>
								</li>
								<li class="accountNav__item">
									<a href="<?php echo home_url('/account/subscriptions'); ?>" class="accountNav__link">Subscriptions</a>
								</li>
								<li class="accountNav__item">
									<a href="<?php echo home_url('/add-listing'); ?>" class="accountNav__link">Your Listing</a>
								</li>
							</ul>
						</div>
					</div>
				</div>		
				<div class="col-9">
					<div class="app-card app-card-chart shadow-sm">
						<div class="app-card-header p-3">
							<div class="row justify-content-between align-items-center">
								<div class="col-auto">
									<h4 class="app-card-title">Create Listing</h4>
								</div>
							</div>
						</div>
						<div class="app-card-body p-3 p-lg-4">
							<?php if( $canCreateListing ) { ?>
								<form class="single-post form-area addListing" method="POST" action="#">
									<div class="thumb">
											<img src="<?php echo get_avatar_url( get_current_user_id() ); ?>" alt="">
									</div>
									<div class="details">
										<div class="title d-flex flex-row justify-content-between">
											<div class="titles">
												<input class="common-input form-control" type="text" name="post-name" placeholder="Listing name" id="">				
											</div>
										</div>
										<div>
											<textarea class="common-input form-control" name="post-content" name="listing-content"></textarea>
										</div>
										<p class="address">
											<input class="common-input form-control" type="text" name="listing-counties" placeholder="List counties where you provide services" required>
										</p>
										<p class="address">
											<input class="common-input form-control" type="text" name="listing-price" placeholder="Price or Price range" required>
										</p>
										<input type="submit" value="Submit" class="btn app-btn-primary w-100 theme-btn mx-auto button_info">
									</div>
								</form>
							<?php } else {

								foreach ($listingByAuthor as $listing) {
									setup_postdata( $listing );
								?>
								<form class="single-post form-area addListing" method="POST" action="#">
									<div class="thumb">
											<img src="<?php echo get_avatar_url( get_current_user_id() ); ?>" alt="">
									</div>
									<div class="details">
										<div class="title d-flex flex-row justify-content-between">
											<div class="titles">
												<input class="common-input form-control" type="text" name="post-name" placeholder="Listing name" value="<?php the_title(); ?>">				
											</div>
										</div>
										<div>
											<textarea class="common-input form-control" name="post-content" name="listing-content"><?php echo esc_html( get_the_content() ); ?></textarea>
										</div>
										<input type="submit" value="Update" class="btn app-btn-primary w-100 theme-btn mx-auto button_info">
									</div>
								</form>
							<?php } } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>