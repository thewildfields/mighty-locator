<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<h3><?php esc_html_e( 'Grow your membership website with these proven tools', 'paid-member-subscriptions' ); ?></h3>
<p class="cozmoslabs-description"><?php esc_html_e( 'Enable addons and add extra features to your website', 'paid-member-subscriptions' ); ?></p>

<form class="pms-setup-form pms-setup-form-addons" method="post">

    <?php $images_folder = PMS_PLUGIN_DIR_URL . 'assets/images/addons/'; ?>

    <div class="pms-setup-addons-list">

        <?php
        $paid_version_addons = array(
            array(
                'name' => esc_html__( 'Invoices', 'paid-member-subscriptions' ),
                'slug' => 'pms-add-on-invoices',
                'image' => 'pms-add-on-invoices-logo.png',
                'description' => esc_html__( 'Generate downloadable PDF Invoices for payments. Available to admins and users.', 'paid-member-subscriptions' ),
                'notice' => esc_html__( 'Available in the Pro version', 'paid-member-subscriptions' ),
            ),
            array(
                'name' => esc_html__( 'Multiple Subscriptions Per User', 'paid-member-subscriptions' ),
                'slug' => 'pms-add-on-multiple-subscriptions-per-user',
                'image' => 'pms-add-on-multiple-subscriptions-per-users-logo.png',
                'description' => esc_html__( 'Set up multiple subscription level blocks and allow members to sign up for more than one subscription plan.', 'paid-member-subscriptions' ),
                'notice' => esc_html__( 'Available in the Pro version', 'paid-member-subscriptions' ),
            ),
            array(
                'name' => esc_html__( 'Global Content Restriction', 'paid-member-subscriptions' ),
                'slug' => 'pms-add-on-global-content-restriction',
                'image' => 'pms-add-on-global-content-restriction-logo.png',
                'description' => esc_html__( 'Setup global content restriction rules based on Post Type, Taxonomies and Terms.', 'paid-member-subscriptions' ),
                'notice' => esc_html__( 'Available in the Basic and Pro versions', 'paid-member-subscriptions' ),
            ),
            array(
                'name' => esc_html__( 'Pay What You Want', 'paid-member-subscriptions' ),
                'slug' => 'pms-add-on-pay-what-you-want',
                'image' => 'pms-add-on-pay-what-you-want.png',
                'description' => esc_html__( 'Accept donations or let subscribers pay what they want by offering a variable pricing option when they purchase a membership plan.', 'paid-member-subscriptions' ),
                'notice' => esc_html__( 'Available in the Basic and Pro versions', 'paid-member-subscriptions' ),
            ),
        );

        foreach ( $paid_version_addons as $addon ) {
            $is_active   = apply_filters( 'pms_add_on_is_active', false, $addon['slug'] . '/index.php' );
            $is_disabled = !defined( 'PMS_PAID_PLUGIN_DIR' ) ? 'disabled' : '';
            $is_checked  = ( $is_active && !$is_disabled ) ? 'checked' : '';
            $addon_slug  = !$is_disabled ? $addon['slug'] : '';
            $addon_title = $is_disabled ? $addon['notice']  : '';

            ?>
            <div class="pms-setup-addon <?php echo esc_html( $is_disabled ); ?>" title="<?php echo esc_html( $addon_title ); ?>">
                <div class="pms-setup-addon__content">
                    <img class="pms-setup-addon__logo" src="<?php echo esc_url( $images_folder . $addon['image'] ); ?>" alt="<?php echo esc_html( $addon['name'] ); ?>" />

                    <div class="pms-setup-addon__details">
                        <h3><?php echo esc_html( $addon['name'] ); ?></h3>
                        <p><?php echo esc_html( $addon['description'] ); ?></p>
                    </div>
                </div>

                <div class="pms-setup-addon__selector">
                    <div class="cozmoslabs-toggle-switch">
                        <div class="cozmoslabs-toggle-container">
                            <input type="checkbox" name="<?php echo esc_html( $addon_slug ); ?>" id="<?php echo esc_html( $addon_slug ); ?>" value="yes" <?php echo esc_html( $is_checked ); ?> >
                            <label class="cozmoslabs-toggle-track" for="<?php echo esc_html( $addon_slug ); ?>"></label>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
    
    <?php if( defined( 'PMS_PAID_PLUGIN_DIR' ) ) : ?>
        <p class="pms-setup-addons-info">
            <?php printf( esc_html__( 'Explore 14+ free and PRO addons from %1$s the Paid Member Subscriptions admin page %2$s once onboarding is complete.', 'paid-member-subscriptions' ), '<strong>', '</strong>' ); ?>
        </p>
    <?php else: ?>
        <p class="pms-setup-form-styles__upsell" style="padding-top: 14px; padding-bottom: 14px; font-size: 110%;">
            <?php printf( esc_html__( 'Get access to 14+ premimum add-ons with a %sPro%s license. %sBuy Now%s', 'paid-member-subscriptions' ), '<strong>', '</strong>', '<a href="https://www.cozmoslabs.com/wordpress-paid-member-subscriptions/?utm_source=wpbackend&utm_medium=clientsite&utm_content=setup-wizard-addons&utm_campaign=PMSFree#pricing" target="_blank">', '</a>' ); ?>
        </p>
    <?php endif; ?>

    <div class="pms-setup-form-button">
        <input type="submit" class="button primary button-primary button-hero" value="<?php esc_html_e( 'Continue', 'paid-member-subscriptions' ); ?>" />
    </div>

    <?php wp_nonce_field( 'pms-setup-wizard-nonce', 'pms_setup_wizard_nonce' ); ?>
</form>