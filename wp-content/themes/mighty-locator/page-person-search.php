<?php

get_header();

require_once ABSPATH . 'wp-admin/includes/user.php';
$roles = get_editable_roles();

if( pms_is_member( get_current_user_id() ) ){
	
	$memberData = pms_get_member( get_current_user_id() );
	$planID = $memberData->subscriptions[0]['subscription_plan_id'];

	$planActive = null;

	if( 'active' == $memberData->subscriptions[0]['status']){

		$planActive = true;

		$plan = $roles[ 'pms_subscription_plan_' . $planID ];
		$planName = $plan['name'];

		if( have_rows( 'user_tiers' , 'option' ) ) : while( have_rows( 'user_tiers' , 'option' ) ) : the_row();
			if( get_sub_field( 'user_role') == $planName ){
				$searchPrice = get_sub_field('price_per_skip');
			}
		endwhile; endif;
	}

	$walletBalance = woo_wallet()->wallet->get_wallet_balance( get_current_user_id() , true); 

}

?>

<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">

			<h1 class="app-page-title">Person Search</h1>
			
			<div class="row g-4 mb-4">				
				<div class="col-12">
					<div class="app-card app-card-chart shadow-sm">
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
									<?php if( pms_is_member( get_current_user_id() ) && $planActive && $walletBalance > $searchPrice ){ ?>
										<form class="skipForm skipForm_single" method="POST">
											<input type="text" class="hidden" id="skip-author-id" name="skip-author-id" style="display: none" value="<?php echo get_current_user_id(); ?>">
											<input type="text" class="hidden" id="skip-author-plan" name="skip-author-plan" style="display: none" value="<?php echo $planName; ?>">
											<input type="text" class="hidden" id="skip-price" name="skip-price" style="display: none" value="<?php echo $searchPrice; ?>">
											<input type="text" class="hidden" id="skip-balance" name="skip-balance" style="display: none" value="<?php echo $walletBalance; ?>">
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
												<div class="col-md-6 col-sm-12 mb-3">
													<label class="sr-only" for="skip-phone">Phone</label>
													<input id="skip-phone" name="skip-phone" type="text" class="form-control skip-phone" placeholder="Phone">
												</div>
												<div class="col-md-6 col-sm-12 mb-3">
													<label class="sr-only" for="skip-email">Email</label>
													<input id="skip-email" name="skip-email" type="email" class="form-control skip-email" placeholder="Email">
												</div>
												<div class="col-md-12 col-sm-12 mb-3">
													<label class="sr-only" for="skip-relatives">Relatives, list multiple using commas</label>
													<input id="skip-relatives" name="skip-relatives" type="text" class="form-control skip-relatives" placeholder="Relatives, list multiple using commas">
												</div>
											</div>
											<div class="text-center">
												<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto single-skip button_info">Search</button>
											</div>
										</form>
									<?php } ?>
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
											<?php if( pms_is_member( get_current_user_id() ) && $planActive ){ ?>
												<?php if( $walletBalance < $searchPrice ){ ?>
													<div class="intro"><strong>Not enough funds on a balance</strong></div>
												<?php } else { ?>
													<div class="intro">
														<strong>$<span id="current-balance"><?php echo $walletBalance; ?></span></strong> current balance
													</div>
													<div class="intro"><strong>$<?php echo $searchPrice; ?></strong> per search</div>
												<?php }
											} ?>

										</div>
										<div class="app-card-footer p-4 mt-auto">
											<a class="btn app-btn-secondary" target="_blank" href="<?php echo home_url('/my-account/woo-wallet/add'); ?>">Add money to wallet</a>
										</div>
									</div>
								</div>
								<div class="col-12 pt-4" id="fast-skip-result" style="max-height: auto; opacity: 0;">
									<!-- <div class="app-card shadow-sm">
										<div class="app-card-header px-4 py-3 searchResult__header">
											<div class="mb-2"><span class="badge bg-info" id="fast-skip-status"></span></div>
											<h4 class="mb-1" id="fast-skip-name"></h4>
										</div>
										<div class="app-card-body pt-4 px-4">
											<div class="notification-content" id="fast-skip-content">
											</div>
										</div>
										<div class="app-card-footer px-4 py-3">
											<a class="action-link" id="fast-skip-link" href="<?php echo home_url() . '/membership'; ?>">
												Upgrade your membership to see more data!
												<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right ms-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
												</svg>
											</a>
										</div>
									</div> -->
								</div>
							</row>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>

<?php get_footer(); ?>