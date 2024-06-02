<?php

get_header();

if( have_posts() ) : while( have_posts() ) : the_post();

$cuid = get_current_user_id();

$userData = get_userdata( $cuid );


?>

<div class="container colGr">
    <div class="colGr__col colGr__col_12">
        <div class="pageHeader">
            <div class="pageHeader__icon">
                <?php echo get_wp_user_avatar($cuid, 200); ?>
            </div>
            <div class="pageHeader__content">
                <h1 class="pageHeader__title">
                    Hello, <?php echo $userData->first_name; ?>
                </h1>
                <p class="pageHeader__subtitle">Professional Membership</p>
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
    </div>
    <div class="colGr__Col colGr__col_4">
        <?php get_sidebar(); ?>
        <?php get_sidebar(); ?>
    </div>
</div>


<?php 

endwhile; endif;

get_footer();