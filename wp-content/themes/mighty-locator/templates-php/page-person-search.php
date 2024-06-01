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
								<?php echo get_template_part( 'templates/person-search' , 'form' ); ?>
								<div class="col-12 pt-4" id="fast-skip-result" style="max-height: 0; opacity: 0">
									<?php echo get_template_part( 'templates/person-search' , 'result' ); ?>
								</div>
							</row>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>

<?php get_footer(); ?>