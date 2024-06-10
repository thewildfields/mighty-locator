<?php get_header(); ?>

<div class="container colGr">
    <div class="colGr__col colGr__col_8">
        <?php
        $listingQueryArgs = array(
            'post_type' => 'listing',
            'posts_per_page' => 1,
            'author' => get_current_user_id()
        );
        $listingQuery = new WP_Query($listingQueryArgs);

        if( $listingQuery->have_posts() ){
            
            while( $listingQuery->have_posts() ){
                
                $listingQuery->the_post();
                echo get_template_part('template-parts/listing','item',array('mode'=>'edit'));
                echo get_template_part('template-parts/listing','edit',array('mode'=>'edit'));

            }

        } else {
            echo get_template_part('template-parts/listing','item',array('mode'=>'create'));
            echo get_template_part('template-parts/listing','edit',array('mode'=>'create'));
        }

        wp_reset_postdata();


        ?>
    </div>
    <div class="colGr__col colGr__col_4">
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>