<?php

/**
 * Template name: Professional directory
 */

get_header();

?>

<div class="container colGr">
    <div class="colGr__col colGr__col_8">
        <h1 class="ml__pageTitle">Professional Directory</h1>
        <?php

        if( is_user_logged_in() ){
            $listingsByUser = get_posts([
                'post_type' => 'listing',
                'author' => get_current_user_id(),
                'post_status' => 'any'
            ]);

            if( sizeof( $listingsByUser) == 0 ){ ?>
                <div class="mlCard">
                    <div class="mlCard__content">
                        <div class="mlCard__contentHeader">
                            <h2>Publish your Listing</h2>
                        </div>
                        <div class="mlCard__contentBody">
                            <p>Want to join a community of professionals and advertise on our platform?</p>
                            <p>Create your professional listing today!</p>
                        </div>
                        <div class="mlCard__contentFooter">
                            <div class="listing__buttons">
                                <a
                                    href="<?php echo home_url('/add-listing' ); ?>"
                                    class="listing__button"
                                >
                                    <span>Create Listing</span>                            
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
        }

        $listingsQueryArgs = array(
            'post_type' => 'listing'
        );

        $listingsQuery = new WP_Query( $listingsQueryArgs );

        if( $listingsQuery->have_posts() ) : while( $listingsQuery->have_posts() ) : $listingsQuery->the_post();
        echo get_template_part('template-parts/listing','item',array('mode'=>'display'));
        endwhile; wp_reset_postdata(); endif;
        ?>
    </div>
    <div class="colGr__col colGr__col_4"></div>
</div>

<?php get_footer(); ?>