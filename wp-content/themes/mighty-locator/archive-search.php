<?php

get_header();

$member = get_member_data(get_current_user_id());

?>

<div class="container colGr">
    <div class="colGr__col colGr__col_8">
        <div class="listings">
            <?php
            if( have_posts() ) : while( have_posts() ) : the_post();
                echo get_template_part('template-parts/recent-search','item');
            endwhile; endif;
            ?>
        </div>
        <?php the_posts_pagination(); ?>
    </div>
    <div class="colGr__col colGr__col_4"></div>
</div>


<?php get_footer(); ?>