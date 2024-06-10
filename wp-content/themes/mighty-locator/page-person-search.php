<?php

get_header();

if( have_posts() ) : while( have_posts() ) : the_post();

$member = get_member_data( get_current_user_id());
$userData = get_userdata( $member['id']);


?>

<div class="container colGr">
    <div class="colGr__col colGr__col_12">
        <h1 class="ml__pageTitle">Person Search</h1>
    </div>
    <div class="colGr__col_8">
        <h2>Quick Person Search</h2>
        <div class="mlCard">
            <div class="mlCard__content">
                <?php echo get_template_part('template-parts/person-search','form'); ?>
            </div>
        </div>

        <?php
            
            echo get_template_part('template-parts/person-search','waiter');
            echo get_template_part('template-parts/person-search','result');
        
        ?>

    </div>
    <div class="colGr__Col colGr__col_4">
        <?php get_sidebar(); ?>
    </div>
</div>


<?php 

endwhile; endif;

get_footer();