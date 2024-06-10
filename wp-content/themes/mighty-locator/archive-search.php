<?php

get_header();

$member = get_member_data(get_current_user_id());

?>

<div class="container colGr">
    <div class="colGr__col colGr__col_12">
        <h1 class="ml__pageTitle">Recent Searches</h1>
    </div>
    <div class="colGr__col colGr__col_8">
        <div class="listings">
            <?php

            $searchesQueryArgs = array(
                'post_type' => 'search',
                'author' => get_current_user_id()
            );

            $searchesQuery = new WP_Query( $searchesQueryArgs );

            if( $searchesQuery->have_posts() ) : while( $searchesQuery->have_posts() ) : $searchesQuery->the_post();
                echo get_template_part('template-parts/recent-searches','item');
            endwhile; wp_reset_postdata(); endif;
            ?>
        </div>
        <?php the_posts_pagination(); ?>
    </div>
    <div class="colGr__col colGr__col_4"></div>
</div>


<?php get_footer(); ?>