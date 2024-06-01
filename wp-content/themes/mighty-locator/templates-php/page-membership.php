<?php

get_header();

$membershipRoles = [
    'ml_starter',
    'ml_pro',
    'ml_enterprise'
];

$userCurrentRole = wp_get_current_user()->roles[0];

?>

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <div class="colGr">

                <?php
                    foreach ($membershipRoles as $index => $role) {

                        $wpRoleObject = $wp_roles->roles[$role];

                        if( have_rows( 'user_tiers' , 'option' ) ) : while( have_rows( 'user_tiers' , 'option' ) ) : the_row();
                            if( get_sub_field('user_role') == $role) {
                                $price = get_sub_field('subscription_price');
                                $freeSkips = get_sub_field('free_skips');
                                $pricePerSkip = get_sub_field('price_per_skip');
                                
                            }
                        endwhile; endif;
                        
                ?>
                    <div class="colGr__col_4">
                        <div class="app-card app-card-notification shadow-sm">
                            <div class="app-card-header px-4 py-3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-12 col-lg-auto text-center text-lg-start">
                                        <div class="app-icon-holder">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"></path>
                                            </svg>
									    </div>
                                    </div>
                                    <div class="col-12 col-lg-auto text-center text-lg-start">
                                        <div class="notification-type mb-2"><span class="badge bg-info badge_info"><?php echo '$' . $price; ?></span></div>
                                        <h4 class="notification-title mb-1"><?php echo $wp_roles->roles[$role]['name']; ?></h4>
                                        
                                        <ul class="notification-meta list-inline mb-0">
                                            <?php if( $freeSkips ) { ?>
                                                <li class="list-inline-item"><?php echo $freeSkips; ?> free skips</li>
                                                <li class="list-inline-item">|</li>
                                            <?php } ?>
                                            <li class="list-inline-item"><?php echo '$' . $pricePerSkip; ?> per skip</li>
                                        </ul>
                                
                                    </div>
                                </div>
                            </div>
                            <div class="app-card-body p-4">
                                <div class="notification-content mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed ultrices dolor, ac maximus ligula. Donec ex orci, mollis ac purus vel, tempor pulvinar justo. Praesent nibh massa, posuere non mollis vel, molestie non mauris. Aenean consequat facilisis orci, sed sagittis mauris interdum at.</div>
                                <?php if( array_search( $userCurrentRole , $membershipRoles ) < $index ) { ?>
                                    <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto button_info">Upgrade</button>
                                <?php } else if( array_search( $userCurrentRole , $membershipRoles ) > $index ) { ?>
                                    <button type="submit" class="btn app-btn-secondary w-100 theme-btn mx-auto">Downgrade</button>
                                <?php } else{ ?>
                                    <button type="submit" class="btn app-btn-disabled w-100 theme-btn mx-auto">Current tier</button>
                                <?php } ?>
                            </div>
                            <div class="app-card-footer px-4 py-3">
                                <a class="action-link" href="#">
                                    Compare all features
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right ms-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>




            </div>
			 
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
<?php get_footer(); ?>