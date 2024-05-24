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

$userData = get_userdata( get_current_user_id() );

if( !get_user_meta( get_current_user_id(), 'free_searches_assigned', true ) ){

	if(
		$userData->user_email &&
		$userData->user_firstname &&
		$userData->user_lastname &&
		get_avatar( get_current_user_id() ) &&
		pms_is_member( get_current_user_id() )
	){
		update_user_meta( get_current_user_id(), 'profile_completed', 1 );
	} else {
		update_user_meta( get_current_user_id(), 'profile_completed', 0 );
	}
	
	$percentage = 25;
	if( get_user_meta( get_current_user_id() , 'profile_completed' , true ) ){
		$percentage += 25;
	}
	if( get_user_meta( get_current_user_id() , 'subscribed_to_youtube' , true ) ){
		$percentage += 25;
	}
	if( get_user_meta( get_current_user_id() , 'subscribed_to_facebook' , true ) ){
		$percentage += 25;
	}
	
	if( $percentage == 100 ){
		update_user_meta( get_current_user_id(), 'free_searches_balance', 10 );
		update_user_meta( get_current_user_id(), 'free_searches_assigned', true );
	}

}

?>



<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">

			<h1 class="app-page-title">Mighty Locator Dashboard</h1>
			
			<div class="row g-4 mb-4">
				
				<div class="col-12">

					<?php if( !get_user_meta( get_current_user_id(), 'free_searches_assigned', true ) ) { ?>

					<div class="app-card app-card-chart h-100 shadow-sm">
						<div class="app-card-header p-3">
							<div class="row justify-content-between align-items-center">
								<div class="col-auto">
									<h4 class="app-card-title">Complete your account and get 10 free searches!</h4>
								</div>
							</div>
						</div>
						<div class="app-card-body p-3 p-lg-4">
							<div class="row align-items-center gx-3">
								<div class="col-8">
									<div class="betaProgress">
										<div class="betaProgress__item betaProgress__item_completed">
											<div class="betaProgress__icon"></div>
											<div class="betaProgress__content">
												<p class="betaProgress__text">Register during the beta-testing period</p>
												<p class="betaProgress__text betaProgress__text_small">The beta-testing period is May 1, 2024 - May 31, 2024</p>
											</div>
										</div>
										<a
											class="
												<?php
													echo get_user_meta( get_current_user_id(), 'profile_completed', true ) ?
													'betaProgress__item betaProgress__item_completed' :
													'betaProgress__item' 
												?>
											"
											target="_blank"
											href="<?php echo home_url( '/account' ); ?>"
										>
											<div class="betaProgress__icon"></div>
											<div class="betaProgress__content">
												<p class="betaProgress__text">Complete your account</p>
												<p class="betaProgress__text betaProgress__text_small">Add your name, email, photo, and membership level.</p>
											</div>
										</a>
										<a
											class="
												<?php
													echo get_user_meta( get_current_user_id(), 'subscribed_to_youtube', true ) ?
													'betaProgress__item betaProgress__item_completed' :
													'betaProgress__item' 
												?>
											"
											target="_blank"
											id="free-searches-subscribe-to-youtube"
											current-user="<?php echo get_current_user_id(); ?>"
											href="https://www.youtube.com/@mightyprocess"
										>
											<div class="betaProgress__icon"></div>
											<div class="betaProgress__content">
												<p class="betaProgress__text">Subscribe to our Youtube Channel</p>
												<p class="betaProgress__text betaProgress__text_small">Click here to subscribe.</p>
											</div>
										</a>
										<a
											class="
												<?php
													echo get_user_meta( get_current_user_id(), 'subscribed_to_facebook', true ) ?
													'betaProgress__item betaProgress__item_completed' :
													'betaProgress__item' 
												?>
											"
											target="_blank"
											id="free-searches-subscribe-to-facebook"
											current-user="<?php echo get_current_user_id(); ?>"
											href="https://www.skool.com/maa"
										>
											<div class="betaProgress__icon"></div>
											<div class="betaProgress__content">
												<p class="betaProgress__text">Join our Private Community of Legal Support Professionals.</p>
												<p class="betaProgress__text betaProgress__text_small">Click Here To Join</p>
											</div>
										</a>
									</div>
								</div>
								<div class="col-4">
									<div class="betaProgress__chart">
										<p class="betaProgress__progress"><?php echo $percentage; ?>%</p>
										<p class="betaProgress__progressHint">Your account is <?php echo $percentage; ?>% ready to receive 10 free searches</p>
									</div>
								</div>
							</div>
						</div>
					</div>

					<?php
						} else { 
							if( get_user_meta( get_current_user_id() , 'free_searches_balance' , true ) > 0 ){
						?>

					<div class="app-card app-card-chart h-100 shadow-sm">
						<div class="app-card-header p-3">
							<div class="row justify-content-between align-items-center">
								<div class="col-auto">
									<h4 class="app-card-title">Congratulations!</h4>
								</div>
							</div>
						</div>
						<div class="app-card-body p-3 p-lg-4">
							<div class="betaProgress__chart">
								<p class="betaProgress__progress" id="front-page-free-searches-balance"><?php echo get_user_meta( get_current_user_id() , 'free_searches_balance' , true ); ?></p>
								<p class="betaProgress__progressHint">You have <span id="front-page-free-searches-balance-2"><?php echo get_user_meta( get_current_user_id() , 'free_searches_balance' , true ); ?></span> free searches</p>
							</div>
						</div>
					</div>
					<?php } } ?>
				</div>
				
			</div>

			<?php if( pms_is_member( get_current_user_id() ) ) { ?>

				<div class="row g-4 mb-4">
					
					<div class="col-4">						
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
									Recharge wallet
								</div>
							</div>
							<a class="app-card-link-mask" href="<?php echo home_url( '/my-account/my-wallet/add' ); ?>"></a>
						</div>
					</div>

					<div class="col-4">						
						<div class="app-card app-card-stat shadow-sm h-100">
							<div class="app-card-body p-3 p-lg-4">
								<h4 class="stats-type mb-1">Membership</h4>
								<div class="stats-figure"><?php echo $planName; ?></div>
								<div class="stats-meta text-success">Upgrade</div>
							</div>
							<a class="app-card-link-mask" href="<?php echo home_url( '/account' ); ?>"></a>
						</div>
					</div>

					<div class="col-4">						
						<div class="app-card app-card-stat shadow-sm h-100">
							<div class="app-card-body p-3 p-lg-4">
								<h4 class="stats-type mb-1">Previous searches</h4>
								<?php
								$skipQuearyArgs = array(
									'post_type' => 'skip',
									'author' => get_current_user_id(),
									'posts_per_page' => -1
								);

								$skipQueary = new WP_Query( $skipQuearyArgs );
								?>
								<div class="stats-figure"><?php echo sizeof( $skipQueary->posts ); ?></div>
								<div class="stats-meta text-success">Go to the archive</div>
							</div>
							<a class="app-card-link-mask" href="<?php echo home_url('/skips-archive'); ?>"></a>
						</div>
					</div>

				</div>

				<?php if( get_user_meta( get_current_user_id() , 'free_searches_assigned' , true ) > 0 || $walletBalance > 0 ){ ?>				
					<div class="row g-4 mb-4">					
						<div class="col-12">
							<div class="app-card app-card-chart h-100 shadow-sm">
								<div class="app-card-header p-3">
									<div class="row justify-content-between align-items-center">
										<div class="col-auto">
											<h4 class="app-card-title">Try Person Search</h4>
										</div>
									</div>
								</div>
								<div class="app-card-body p-3 p-lg-4">
									<div class="row">
										<!-- <div class="col-6">
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
										</div> -->
											<?php echo get_template_part( 'templates/person-search' , 'form' ); ?>
											<div class="col-12 pt-4" id="fast-skip-result" style="max-height: 0; opacity: 0;">
												<?php echo get_template_part( 'templates/person-search' , 'result' ); ?>
											</div>
											<div class="col-12 pt-4" id="fast-skip-error" style="max-height: 0; opacity: 0;">
												<?php echo get_template_part( 'templates/person-search' , 'error' ); ?>
											</div>
									</row>
								</div>
							</div>
						</div>					
					</div>
				<?php } ?>

			<?php } ?>

		</div>
	</div>

<?php get_footer(); ?>