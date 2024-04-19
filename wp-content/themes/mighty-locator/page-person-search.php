<?php

get_header();

$membershipRoles = [
    'ml_starter',
    'ml_pro',
    'ml_enterprise'
];

$userCurrentRole = wp_get_current_user()->roles[0];

$userCurrentRoleDisplayName = $wp_roles->roles[$userCurrentRole]['name'];

?>

<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">

			<h1 class="app-page-title">Person Search</h1>
			
			<div class="row g-4 mb-4">				
				<div class="col-12">
					<div class="app-card app-card-chart h-100 shadow-sm">
						<div class="app-card-header p-3">
							<div class="row justify-content-between align-items-center">
								<div class="col-auto">
									<h4 class="app-card-title">Single Search</h4>
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
											<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto single-skip button_info">Search</button>
										</div>
									</form>
								</div>
								<div class="col-6">
									<div class="app-card app-card-basic d-flex flex-column align-items-start">
										<div class="app-card-header p-3 border-bottom-0">
											<div class="row align-items-center gx-3">
												<div class="col-auto">
													<h2 class="app-card-title">Your current pricing</h4>
												</div>
											</div>
										</div>
										<div class="app-card-body px-4">
											<?php if( have_rows( 'user_tiers' , 'option' ) ) : while( have_rows( 'user_tiers' , 'option' ) ) : the_row(); ?>
												<?php if( get_sub_field( 'user_role' ) == $userCurrentRole ) { ?>
													<div class="intro"><strong>$250</strong> current balance</div>
													<div class="intro"><strong>$<?php the_sub_field('price_per_skip'); ?></strong> per search</div>
												<?php } ?>
											<?php endwhile; endif; ?>
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