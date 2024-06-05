<?php
    get_header();
    if( have_posts() ) : while( have_posts() ) : the_post();     
?>
<?php 

$member = get_member_data( get_current_user_id() );
$metas = get_post_meta( $post->ID );
$people = json_decode( get_post_meta( $post->ID , 'people' , true) );
$peopleWithoutContacts = json_decode( get_post_meta( $post->ID, 'finalPeopleWithoutContacts', true ) );
$additionalAddresses = json_decode( get_post_meta( $post->ID, 'additionalAddresses', true ) );
$prefixClasses = ['mlCard__prefix'];
$searchStatus = $metas['searchStatus'][0];

switch ($searchStatus) {
    case 'failed':
        $prefixClasses[] = 'mlCard__prefix_danger';
    break;
    case 'partial':
        $prefixClasses[] = 'mlCard__prefix_warning';
    break;
    case 'success':
        $prefixClasses[] = 'mlCard__prefix_success';
    break;
    default:
        $prefixClasses[] = 'mlCard__prefix_info';
    break;
}

?>
    <div class="container colGr">
        <div class="colGr__col colGr__col_12">
            <div class="pageHeader">
                <div class="pageHeader__icon"></div>
                <div class="pageHeader__content">
                    <h1 class="pageHeader__title"><?php the_title(); ?></h1>
                    <p class="pageHeader__subtitle"><?php the_time('F j, Y'); ?></p>
                </div>
            </div>
        </div>
        <div class="colGr__col colGr__col_6">
            <div class="mlCard mlCard_withPrefix">
                <div class="<?php echo implode(' ',$prefixClasses); ?>">
                    <span><?php echo $metas['searchStatus'][0]; ?></span>
                </div>
                <div class="mlCard__content">
                    <p class="mlCard__title">Search statistics</p>
                    <div class="mlCard__stats">
                        <div class="mlCard__stat">
                            <p class="mlCard__statNumber"><?php echo $metas['totalPeopleCount'][0]; ?></p>
                            <p class="mlCard__statDescription">people found</p>
                        </div>
                        <div class="mlCard__stat">
                            <p class="mlCard__statNumber"><?php echo $metas['addressesCount'][0]; ?></p>
                            <p class="mlCard__statDescription">Addresses</p>
                        </div>
                        <div class="mlCard__stat">
                            <p class="mlCard__statNumber"><?php echo $metas['addressesCount'][0]; ?></p>
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
                            <p class="mlCard__statNumber"><?php echo $metas['searchPrice'][0]; ?></p>
                            <p class="mlCard__statDescription">Search Price</p>
                        </div>
                        <div class="mlCard__stat">
                            <p class="mlCard__statNumber">Single</p>
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
        <div class="colGr__col colGr__col_6"></div>
        <div class="colGr__col colGr__col_12">

            <h2>People</h2>

            <?php
                foreach ($people as $person) {
                    $person = (array) $person;
            ?>
                <div class="mlCard singleSearchCard">
                    <div class="mlCard__content">
                        <div class="mlCard__contentHeader">
                            <h2 class="singleSearchCard__title"><?php echo $person['firstName'].' '.$person['lastName']; ?></h2>
                        </div>
                        <div class="mlCard__contentBody">
                            <div class="singleSearchCard__section">
                                <h3 class="singleSearchCard__sectionTitle">Addresses</h3>
                                <div class="singleSearchCard__sectionContent">
                                    <?php if( sizeof( $person['addresses'] ) ) {
                                        foreach ($person['addresses'] as $address) {
                                            $addressArray = (array) json_decode( $address ) ?>
                                            <p><?php
                                                echo $addressArray['street'].', '.
                                                $addressArray['city'].', '.
                                                $addressArray['state'].' '.
                                                $addressArray['zip'];
                                            ?></p>
                                        <?php }
                                    } else { ?>
                                        no emails
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="singleSearchCard__section">
                                <h3 class="singleSearchCard__sectionTitle">Phones</h3>
                                <div class="singleSearchCard__sectionContent">
                                    <?php if( sizeof( $person['phones'] ) ) { foreach ($person['phones'] as $phone) { ?>
                                        <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
                                    <?php } } else { ?>
                                        no phones
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="singleSearchCard__section">
                                <h3 class="singleSearchCard__sectionTitle">Emails</h3>
                                <div class="singleSearchCard__sectionContent">
                                    <?php if( sizeof( $person['emails'] ) ) { foreach ($person['emails'] as $email) { ?>
                                        <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                                    <?php } } else { ?>
                                        no emails
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="mlCard__contentFooter"></div>
                    </div>
                </div>
            <?php }?>

            <h2>Additional People Without Contacts</h2>

            <?php
                foreach ($peopleWithoutContacts as $person) {
                    $person = (array) $person;
            ?>
                <div class="mlCard singleSearchCard">
                    <div class="mlCard__content">
                        <div class="mlCard__contentHeader">
                            <h2 class="singleSearchCard__title"><?php echo $person['firstName'].' '.$person['lastName']; ?></h2>
                        </div>
                        <div class="mlCard__contentBody">
                            <div class="singleSearchCard__section">
                                <h3 class="singleSearchCard__sectionTitle">Addresses</h3>
                                <div class="singleSearchCard__sectionContent">
                                    <?php if( sizeof( $person['addresses'] ) ) {
                                        foreach ($person['addresses'] as $address) {
                                            $addressArray = (array) json_decode( $address ) ?>
                                            <p><?php
                                                echo $addressArray['street'].', '.
                                                $addressArray['city'].', '.
                                                $addressArray['state'].' '.
                                                $addressArray['zip'];
                                            ?></p>
                                        <?php }
                                    } else { ?>
                                        no emails
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="mlCard__contentFooter"></div>
                    </div>
                </div>
            <?php }?>
            
            <h2>Additional Addresses</h2>

            <div class="mlCard">
                <div class="mlCard__content">
                    <?php foreach ($additionalAddresses as $address) {
                        $addressArray = (array) $address ?>
                        <p><?php
                            echo $addressArray['street'].', '.
                            $addressArray['city'].', '.
                            $addressArray['state'].' '.
                            $addressArray['zip'];
                        ?></p>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
<?php
    endwhile; endif;
    get_footer();
?>