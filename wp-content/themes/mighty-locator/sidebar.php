<h2>Account Status</h2>
<?php 

$member = get_member_data(get_current_user_id());


?>
<div class="mlCard">
    <div class="mlCard__content">
        <div class="mlCard__stats">
            <div class="mlCard__stat">
                <p class="mlCard__statNumber"><?php echo  $member['membershipLevel']; ?></p>
                <p class="mlCard__statDescription">Membership Level</p>
            </div>
            <div class="mlCard__stat">
                <p class="mlCard__statNumber" id="user-freeSearcherBalance"><?php echo $member['freeSearchesBalance']; ?></p>
                <p class="mlCard__statDescription">Free Searches</p>
            </div>
            <div class="mlCard__stat">
                <p class="mlCard__statNumber" id="user-walletBalance">$<?php echo $member['walletBalance']; ?></p>
                <p class="mlCard__statDescription">Wallet Balance</p>
            </div>
            <?php if( 'No' != $member['membershipLevel'] ) { ?>
                <div class="mlCard__stat">
                    <p class="mlCard__statNumber">$<?php echo $member['searchPrice']; ?></p>
                    <p class="mlCard__statDescription">Search price</p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<h2>Quick links</h2>
<div class="mlCard mlCard_noprefix">
    <div class="mlCard__content">
        <div class="mlCard__links">
            <a
                class="mlCard__link mlCard__link_big mlCard__link_icon"
                href="<?php echo home_url('account/profile'); ?>"
                target="_blank"
            >
                <img src="<?php echo bloginfo('template_url') . '/assets/src/img/profile.svg'; ?>" alt="" class="icon">
                <span>Edit Profile</span>
            </a>
            <a
                class="mlCard__link mlCard__link_big mlCard__link_icon"
                href="<?php echo home_url('my-account/woo-wallet/add'); ?>"
                target="_blank"
            >
                <img src="<?php echo bloginfo('template_url') . '/assets/src/img/wallet.svg'; ?>" alt="" class="icon">
                <span>Recharge Wallet</span>
            </a>
            <a
                class="mlCard__link mlCard__link_big mlCard__link_icon"
                href="https://mighty-locator.ddev.site:9999/account/subscriptions/"
                target="_blank"
            >
                <img src="<?php echo bloginfo('template_url') . '/assets/src/img/membership.svg'; ?>" alt="" class="icon">
                <span>Review Membership</span>
            </a>
            <a
                class="mlCard__link mlCard__link_big mlCard__link_icon"
                href="<?php echo home_url('/support'); ?>"
                target="_blank"
            >
                <img src="<?php echo bloginfo('template_url') . '/assets/src/img/support.svg'; ?>" alt="" class="icon">
                <span>Contact Support</span>
            </a>
        </div>
    </div>
</div>

<h2>Recent posts</h2>
<div class="mlCard mlCard_noprefix">
    <div class="mlCard__content">
        <div class="mlCard__links">
            <?php 

            $postsQueryArgs = array(
                'post_type' => 'post',
                'posts_per_page' => 3
            );

            $postsQuery = new WP_Query( $postsQueryArgs );

            if( $postsQuery->have_posts() ) : while( $postsQuery->have_posts() ) : $postsQuery->the_post(); ?>
                <a
                    class="mlCard__link mlCard__link_small mlCard__link_icon"
                    href="<?php the_permalink(); ?>"
                    target="_blank"
                ><?php the_title(); ?></a>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
    </div>
</div>