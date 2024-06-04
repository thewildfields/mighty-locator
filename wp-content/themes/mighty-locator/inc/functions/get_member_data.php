<?php 

function get_member_data($cuID){

    $freeSearchesBalance = get_field('free_searches_balance','user_'.$cuID) ?
        get_field('free_searches_balance','user_'.$cuID): 
        '0';

    $member = pms_get_member($cuID);
    $subscriptions = $member->subscriptions;
    $membershipLevel = null;
    foreach ($subscriptions as $sub) {
        if( 'active' == $sub['status'] ){
            $membershipLevel = get_the_title( $sub['subscription_plan_id'] );
            break;
        }
    }
    $walletBalance = woo_wallet()->wallet->get_wallet_balance( get_current_user_id() , true); 



    $userTiers = get_field('user_tiers', 'option');
    foreach ($userTiers as $tier) {
        if( $tier['user_role'] == $membershipLevel ){
            $searchPrice = $tier['price_per_search'];
        }
    }

    $returnArray = [
        'id' => $cuID,
        'membershipLevel' => $membershipLevel ? $membershipLevel : 'No',
        'walletBalance' => $walletBalance,
        'freeSearchesBalance' => $freeSearchesBalance,
        'searchPrice' => $membershipLevel ? $searchPrice : '',
    ];

    return $returnArray;

}