<?php

get_header();

if( have_posts() ) : while( have_posts() ) : the_post();

$member = get_member_data( get_current_user_id());
$userData = get_userdata( $member['id']);


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
    <div class="colGr__col_8">
        <h2>Quick Person Search</h2>
        <div class="mlCard">
            <div class="mlCard__content">
                <?php echo get_template_part('template-parts/person-search','form'); ?>
            </div>
        </div>

        <div class='psfWaiter'>
            <div class='psfWaiter__loaderContainer'>
                <div class='psfWaiter__loader'></div>
            </div>
            <div class='psfWaiter__notification'></div>
        </div>

        <div class="psfResult">
            <h2>Result Preview</h2>
            <div class="colGr">
                <div class="colGr__col colGr__col_6">
                    <div class="mlCard mlCard_withPrefix">
                        <div class="mlCard__prefix mlCard__prefix_success"><span id="preview-status"></span></div>
                        <div class="mlCard__content">
                            <p class="mlCard__title">Search statistics</p>
                            <div class="mlCard__stats">
                                <div class="mlCard__stat">
                                    <p class="mlCard__statNumber" id="preview-people-count"></p>
                                    <p class="mlCard__statDescription">people found</p>
                                </div>
                                <div class="mlCard__stat">
                                    <p class="mlCard__statNumber" id="preview-addresses-count"></p>
                                    <p class="mlCard__statDescription">Addresses</p>
                                </div>
                                <div class="mlCard__stat">
                                    <p class="mlCard__statNumber" id="preview-phones-count"></p>
                                    <p class="mlCard__statDescription">Phone numbers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="colGr__col colGr__col_6">
                    <div class="mlCard mlCard_withPrefix">
                        <div class="mlCard__prefix mlCard__prefix_info"><span>Info</span></div>
                        <div class="mlCard__content">
                            <p class="mlCard__title">Search information</p>
                            <div class="mlCard__stats">
                                <div class="mlCard__stat">
                                    <p class="mlCard__statNumber" id="preview-freeSearcherBalance"></p>
                                    <p class="mlCard__statDescription">Search Price</p>
                                </div>
                                <div class="mlCard__stat">
                                    <p class="mlCard__statNumber" id="preview-search-type"></p>
                                    <p class="mlCard__statDescription">Search type</p>
                                </div>
                                <div class="mlCard__stat">
                                    <p class="mlCard__statNumber"><?php echo $member['membershipLevel']; ?></p>
                                    <p class="mlCard__statDescription">Membership Level</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="button button_info psfResult__button" id="preview-redirect-link">See the result</a>
            <p class="psfResult__redirect">
                You are being redirected to full result in <span id="preview-redirect-timer"></span>
            </p>
        </div>

        <?php 
        
        $resentSearchesArgs = array(
            'post_type' => 'search',
            'posts_per_page' => 5,
            'author' => $member['id']
        );

        $resentSearches = new WP_Query( $resentSearchesArgs );

        if( $resentSearches->found_posts ){

        ?>

        <h2>Your recent searches</h2>

        <?php 

        if( $resentSearches->have_posts() ) : while( $resentSearches->have_posts()) : $resentSearches->the_post(); 
        echo get_template_part( 'template-parts/recent-search-item' );
        endwhile; wp_reset_postdata(); endif;
        
        }

        ?>

        <?php if( $resentSearches->found_posts > 5 ){ ?>
            <a href="<?php echo home_url('/search/'); ?>" class="button button_success psfResult__button" id="preview-redirect-link">See whole archive</a>
        <?php } ?>

    </div>
    <div class="colGr__Col colGr__col_4">
        <?php get_sidebar(); ?>
        <?php get_sidebar(); ?>
    </div>
</div>


<?php 

endwhile; endif;

get_footer();