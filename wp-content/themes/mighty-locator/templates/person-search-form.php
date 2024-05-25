<?php

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

<div class="col-6">
    <form class="skipForm skipForm_single" method="POST">
        <input type="text" class="hidden" id="skip-author-id" name="skip-author-id" style="display: none" value="<?php echo get_current_user_id(); ?>">
        <input type="text" class="hidden" id="author-free-searches" name="author-free-searches" style="display: none" value="<?php echo get_user_meta( get_current_user_id() , 'free_searches_balance' , true ); ?>">
        <input type="text" class="hidden" id="skip-author-plan" name="skip-author-plan" style="display: none" value="<?php echo $planName; ?>">
        <input type="text" class="hidden" id="skip-price" name="skip-price" style="display: none" value="<?php echo $searchPrice; ?>">
        <input type="text" class="hidden" id="skip-balance" name="skip-balance" style="display: none" value="<?php echo $walletBalance; ?>">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3">
                <label class="sr-only" for="skip-first-name">First Name</label>
                <input id="skip-first-name" name="skip-first-name" type="text" class="form-control skip-first-name" placeholder="First Name" required>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label class="sr-only" for="skip-last-name">Last Name</label>
                <input id="skip-last-name" name="skip-last-name" type="number" min="1" max="100" class="form-control skip-last-name" placeholder="last Name" required>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label class="sr-only" for="skip-min-age">Minimum Age</label>
                <input id="skip-min-age" name="skip-min-age" type="number" min="1" max="100" class="form-control skip-min-age" placeholder="Minimum Age" required>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label class="sr-only" for="skip-max-age">Maximum Age</label>
                <input id="skip-max-age" name="skip-max-age" type="text" class="form-control skip-max-age" placeholder="Maximum Age" required>
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
            <?php if( pms_is_member( get_current_user_id() ) && $planActive && get_user_meta( get_current_user_id() , 'free_searches_assigned' , true )){ ?>
                <div class="intro">
                    <strong><span id="free-searches-balance"><?php echo get_user_meta( get_current_user_id() , 'free_searches_balance' , true ); ?></span></strong> free searches available
                </div>
                <div class="intro"><strong>Free Searches</strong> are always used first, if available.</div>
                <br>
            <?php } ?>
            <?php if( pms_is_member( get_current_user_id() ) && $planActive ){ ?>
                <?php if( $walletBalance < $searchPrice ){ ?>
                    <div class="intro"><strong>Not enough funds on a balance for a paid search.</strong></div>
                <?php } else { ?>
                    <div class="intro">
                        <strong>$<span id="current-balance"><?php echo $walletBalance; ?></span></strong> on balance
                    </div>
                <?php } ?>
                <div class="intro"><strong>$<?php echo $searchPrice; ?></strong> per search</div>
            <?php } ?>

        </div>
        <div class="app-card-footer p-4 mt-auto">
            <a class="btn app-btn-secondary" target="_blank" href="<?php echo home_url('/my-account/woo-wallet/add'); ?>">Add money to wallet</a>
            <a class="btn app-btn-secondary" href="<?php echo home_url('/skips-archive'); ?>">My searches archive</a>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="loader"></div>
</div>