<?php 

/**
 * Template name: Wallet
 */

get_header();

$member = get_member_data( get_current_user_id() );
$userData = get_userdata( get_current_user_id() );

?>
<div class="container colGr">
    <div class="colGr__col colGr__col_12">
        <div class="pageHeader">
            <div class="pageHeader__icon">
                <?php echo get_wp_user_avatar($member['id'], 200); ?>
            </div>
            <div class="pageHeader__content">
                <h1 class="pageHeader__title">
                    Hello, <?php echo $userData->first_name; ?>
                </h1>
                <p class="pageHeader__subtitle"><?php echo $member['membershipLevel']; ?> Membership</p>
            </div>
        </div>
    </div>
	<div class="colGr__col colGr__col_8">
        <h2>My Wallet</h2>
		<div class="mlCard accountSettings">
			<div class="mlCard__content">
				<?php 
				echo do_shortcode('[woo-wallet]');
				?>
			</div>
		</div>
	</div>
	<div class="colGr__col colGr__col_4">
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>