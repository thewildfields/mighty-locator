<?php

get_header();

$membershipRoles = [
    'starter',
    'professional',
    'enterprise'
];

$userCurrentRole = wp_get_current_user()->roles[0];

$userCurrentRoleDisplayName = $wp_roles->roles[$userCurrentRole]['name'];

?>



<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">

			<?php

			if( have_posts() ) : while( have_posts() ) : the_post();
				the_content();
			endwhile; endif;
			?>

			<h1 class="app-page-title">Overview</h1>
			
			<div class="row g-4 mb-4">
				
				<div class="col-12">
					<div class="app-card app-card-chart h-100 shadow-sm">
						<div class="app-card-header p-3">
							<div class="row justify-content-between align-items-center">
								<div class="col-auto">
									<h4 class="app-card-title">Complete your account and get 10 free skips!</h4>
								</div>
							</div>
						</div>
						<div class="app-card-body p-3 p-lg-4">
							<div class="row align-items-center gx-3">
							<div class="row align-items-center gx-3">
								<div class="col-auto">
									<div class="app-icon-holder">
									</div>
								</div>
								<div class="col-auto">
									<h4 class="app-card-title">Register during the beta-testing period</h4>
								</div>
							</div>
								<div class="col-auto">
									<div class="app-icon-holder">
									</div>
								</div>
								<div class="col-auto">
									<h4 class="app-card-title">Enter your personal information</h4>
								</div>
							</div>
							<div class="row align-items-center gx-3">
								<div class="col-auto">
									<div class="app-icon-holder">
									</div>
								</div>
								<div class="col-auto">
									<h4 class="app-card-title">Add a payment method</h4>
								</div>
							</div>
							<div class="row align-items-center gx-3">
								<div class="col-auto">
									<div class="app-icon-holder">
									</div>
								</div>
								<div class="col-auto">
									<h4 class="app-card-title">Subscribe to our newsletter</h4>
								</div>
							</div>
							<div class="row align-items-center gx-3">
								<div class="col-auto">
									<div class="app-icon-holder">
									</div>
								</div>
								<div class="col-auto">
									<h4 class="app-card-title">Follow us on Social Media</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>

			<div class="row g-4 mb-4">
				
				<div class="col-6 col-lg-3">						
					<div class="app-card app-card-stat shadow-sm h-100">
						<div class="app-card-body p-3 p-lg-4">
							<h4 class="stats-type mb-1">Account balance</h4>
							<?php 
							
							$walletBalance = get_user_meta( get_current_user_id(), '_current_woo_wallet_balance', true );
							
							?>
							<div class="stats-figure">$<?php echo $walletBalance > 0 ? $walletBalance : '0.00'; ?></div>
							<div class="stats-meta text-success">
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
								</svg>
								Top up
							</div>
						</div>
						<a class="app-card-link-mask" href="<?php echo home_url() . '/settings'; ?>"></a>
					</div>
				</div>

				<div class="col-6 col-lg-3">						
					<div class="app-card app-card-stat shadow-sm h-100">
						<div class="app-card-body p-3 p-lg-4">
							<h4 class="stats-type mb-1">Membership</h4>
							<div class="stats-figure"><?php echo $userCurrentRoleDisplayName; ?></div>
							<?php if( array_search( $userCurrentRole , $membershipRoles ) < sizeof( $membershipRoles ) - 1 ){ ?>
								<div class="stats-meta text-success">Upgrade</div>
							<?php } ?>
						</div>
						<a class="app-card-link-mask" href="<?php echo home_url( '/change-membership-level' ); ?>"></a>
					</div>
				</div>

				<div class="col-6 col-lg-3">						
					<div class="app-card app-card-stat shadow-sm h-100">
						<div class="app-card-body p-3 p-lg-4">
							<h4 class="stats-type mb-1">Invited users</h4>
							<div class="stats-figure">0</div>
							<div class="stats-meta text-success">Copy Referral link</div>
						</div>
						<a class="app-card-link-mask" href="<?php echo home_url( '/referral-program' ); ?>"></a>
					</div>
				</div>

				<div class="col-6 col-lg-3">						
					<div class="app-card app-card-stat shadow-sm h-100">
						<div class="app-card-body p-3 p-lg-4">
							<h4 class="stats-type mb-1">Previous skips</h4>
							<?php
							$skipQuearyArgs = array(
								'post_type' => 'skip',
								'author' => get_current_user_id(),
								'posts_per_page' => -1
							);

							$skipQueary = new WP_Query( $skipQuearyArgs );
							?>
							<div class="stats-figure"><?php echo sizeof( $skipQueary->posts ); ?></div>
							<div class="stats-meta">Go to the archive</div>
						</div>
						<a class="app-card-link-mask" href="<?php echo home_url('/skips-archive'); ?>"></a>
					</div>
				</div>

			</div>
			
			<div class="row g-4 mb-4">
				
				<div class="col-12">
					<div class="app-card app-card-chart h-100 shadow-sm">
						<div class="app-card-header p-3">
							<div class="row justify-content-between align-items-center">
								<div class="col-auto">
									<h4 class="app-card-title">Try Skip Tracing</h4>
								</div>
							</div>
						</div>
						<div class="app-card-body p-3 p-lg-4">
							<div class="row">
								<div class="col-6">
									<form class="skipForm skipForm_single" method="POST">
										<input type="text" class="hidden" name="skip-author-id" style="display: none" value="<?php echo get_current_user_id(); ?>">
										<div class="row">
											<div class="col-md-6 col-sm-12 mb-3">
												<label class="sr-only" for="skip-first-name">First Name</label>
												<input id="skip-first-name" name="skip-first-name" type="text" class="form-control skip-first-name" placeholder="First Name">
											</div>
											<div class="col-md-6 col-sm-12 mb-3">
												<label class="sr-only" for="skip-last-name">Last Name</label>
												<input id="skip-last-name" name="skip-last-name" type="text" class="form-control skip-last-name" placeholder="last Name">
											</div>
											<div class="col-md-12 col-sm-12 mb-3">
												<label class="sr-only" for="skip-street-address">Street Address</label>
												<input id="skip-street-address" name="skip-street-address" type="text" class="form-control skip-street-address" placeholder="Street Address">
											</div>
											<div class="col-md-4 col-sm-12 mb-3">
												<label class="sr-only" for="skip-city">City</label>
												<input id="skip-city" name="skip-city" type="text" class="form-control skip-city" placeholder="City">
											</div>
											<div class="col-md-4 col-sm-12 mb-3">
												<label class="sr-only" for="skip-state">State</label>
												<input id="skip-state" name="skip-state" type="text" class="form-control skip-state" placeholder="State">
											</div>
											<div class="col-md-4 col-sm-12 mb-3">
												<label class="sr-only" for="skip-zip">ZIP</label>
												<input id="skip-zip" name="skip-zip" type="text" class="form-control skip-zip" placeholder="ZIP">
											</div>
										</div>
										<div class="text-center">
											<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto single-skip button_info">Skip Trace</button>
										</div>
									</form>
								</div>
								<div class="col-6">
									<div class="app-card app-card-basic d-flex flex-column align-items-start">
										<div class="app-card-header p-3 border-bottom-0">
											<div class="row align-items-center gx-3">
												<div class="col-auto">
													<div class="app-icon-holder">
														<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-receipt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
															<path fill-rule="evenodd" d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z"/>
															<path fill-rule="evenodd" d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>
														</svg>
													</div>
												</div>
												<div class="col-auto">
													<h4 class="app-card-title">Free Searches Balance</h4>
												</div>
											</div>
										</div>
										<div class="app-card-body px-4">
											<div class="intro">You have <strong>10</strong> searches available.</div>
										</div>
										<div class="app-card-footer p-4 mt-auto">
											<a class="btn app-btn-secondary" href="<?php echo home_url('/settings'); ?>">Buy more searches</a>
										</div>
									</div>
								</div>
								<div class="col-12 pt-4" id="fast-skip-result" style="max-height: 0; opacity: 0;">
									<div class="app-card shadow-sm">
										<div class="app-card-header px-4 py-3">
											<div class="mb-2"><span class="badge bg-info" id="fast-skip-status"></span></div>
											<h4 class="mb-1" id="fast-skip-name"></h4>
										</div>
										<div class="app-card-body pt-4 px-4">
											<div class="notification-content" id="fast-skip-content"></div>
										</div>
										<div class="app-card-footer px-4 py-3">
											<a class="action-link" id="fast-skip-link" href="<?php echo home_url() . '/membership'; ?>">
												Upgrade your membership to see more data!
												<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right ms-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
												</svg>
											</a>
										</div>
									</div>
								</div>
							</row>
						</div>
					</div>
				</div>
				
			</div>

		</div>
	</div>

<?php get_footer(); ?>