<?php

get_header();

$member = get_member_data(get_current_user_id());

?>

<div class="container colGr">
    <div class="colGr__col colGr__col_8">
        <div class="listings">
            <?php
                if( have_posts() ) : while( have_posts() ) : the_post();

                $metas = get_post_meta(get_the_ID());
                $statusClasses = ['listingsItem__status'];
                $searchStatus = strtolower( $metas['searchStatus'][0] );

                switch ($searchStatus) {
                    case 'failed':
                        $statusClasses[] = 'listingsItem__status_error';
                    break;
                    case 'partial':
                        $statusClasses[] = 'listingsItem__status_warning';
                    break;
                    case 'success':
                        $statusClasses[] = 'listingsItem__status_success';
                    break;
                    default:
                        $statusClasses[] = 'listingsItem__status_info';
                    break;
                }
            ?>
                <a
                    class="mlCard mlCard_noprefix listingsItem"
                    href="<?php the_permalink(); ?>"
                >
                    <div class="<?php echo implode(' ',$statusClasses); ?>"></div>
                    <div class="mlCard__content colGr">
                        <?php 

                        $people = json_decode( get_post_meta( $post->ID, 'people', true ) );
                        $peopleCount = sizeof( $people );
                        $additionalAddresses = sizeof( json_decode( get_post_meta( $post->ID, 'additionalAddresses', true ) ) );
                        $addressesCount = $additionalAddresses;
                        foreach ($people as $person) {
                            $addressesCount += sizeof( $person->addresses );
                        }

                        ?>
                        <div class="colGr__col colGr__col_6">
                            <h3 class="listingsItem__title"><?php the_title(); ?></h3>
                        </div>
                        <div class="colGr__col colGr__col_4">
                            <div class="listingsItem__stats">
                                <p class="listingsItem__people">
                                    <?php echo $peopleCount == 1 ? $peopleCount.' person' : $peopleCount.' people' ; ?>
                                </p>
                                <p class="listingsItem__addresses">
                                    <?php echo $addressesCount == 1 ? $addressesCount.' address' : $addressesCount.' addresses' ; ?>
                                </p>
                            </div>
                        </div>
                        <div class="colGr__col colGr__col_2">
                            <p class="listingsItem__date"><?php the_time('F j, Y'); ?></p>
                        </div>
                    </div>
                </a>
            <?php endwhile; endif; ?>
            <?php the_posts_pagination(); ?>
        </div>
    </div>
    <div class="colGr__col colGr__col_4"></div>
</div>


<?php get_footer(); ?>