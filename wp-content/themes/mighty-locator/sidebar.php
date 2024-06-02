<h2>Professionals Directory</h2>
<?php 

$postsQueryArgs = array(
    'post_type' => 'listing',
    'posts_per_page' => 2
);

$postsQuery = new WP_Query( $postsQueryArgs );

if( $postsQuery->have_posts() ) : while( $postsQuery->have_posts() ) : $postsQuery->the_post();
?>
<div class="mlCard mlCard_noprefix">
    <div class="mlCard__content">
        <?php the_title(); ?>
    </div>
</div>
<?php endwhile; wp_reset_postdata(); endif; ?>
<h2>Quick links</h2>
<div class="mlCard mlCard_noprefix">
    <div class="mlCard__content">
        <div class="mlCard__links">
            <a class="mlCard__link mlCard__link_big mlCard__link_icon" href="#">Recharge Wallet</a>
            <a class="mlCard__link mlCard__link_big mlCard__link_icon" href="#">Review Membership</a>
            <a class="mlCard__link mlCard__link_big mlCard__link_icon" href="#">Referral Link</a>
            <a class="mlCard__link mlCard__link_big mlCard__link_icon" href="#">Contact Support</a>
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