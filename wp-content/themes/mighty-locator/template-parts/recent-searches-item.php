<?php 

$metas = get_post_meta(get_the_ID());
$statusClasses = ['recentSearchItem__status'];
$searchStatus = strtolower( $metas['searchStatus'][0] );

switch ($searchStatus) {
    case 'failed':
        $statusClasses[] = 'recentSearchItem__status_error';
    break;
    case 'partial':
        $statusClasses[] = 'recentSearchItem__status_warning';
    break;
    case 'success':
        $statusClasses[] = 'recentSearchItem__status_success';
    break;
    default:
        $statusClasses[] = 'recentSearchItem__status_info';
    break;
}

?>

<a
    class="mlCard mlCard_noprefix recentSearchItem"
    href="<?php the_permalink(); ?>"
>
    <div class="<?php echo implode(' ' , $statusClasses); ?>"></div>
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
            <h3 class="recentSearchItem__title"><?php the_title(); ?></h3>
        </div>
        <div class="colGr__col colGr__col_4">
            <div class="recentSearchItem__stats">
                <p class="recentSearchItem__people">
                    <?php echo $peopleCount == 1 ? $peopleCount.' person' : $peopleCount.' people' ; ?>
                </p>
                <p class="recentSearchItem__addresses">
                    <?php echo $addressesCount == 1 ? $addressesCount.' address' : $addressesCount.' addresses' ; ?>
                </p>
            </div>
        </div>
        <div class="colGr__col colGr__col_2">
            <p class="recentSearchItem__date"><?php the_time('F j, Y'); ?></p>
        </div>
    </div>
</a>