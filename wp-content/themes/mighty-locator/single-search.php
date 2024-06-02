<?php
    get_header();
    if( have_posts() ) : while( have_posts() ) : the_post();     
?>
<?php 

$metas = get_post_meta( $post->ID );

$people = $metas['people'];

echo sizeof( $people );

// foreach ($people as $person) {
//     echo '<pre>';
//     print_r( $person );
//     echo '</pre>';
// }

?>
    <div class="container colGr">
        <div class="colGr__col colGr__col_12">
            <div class="pageHeader">
                <div class="pageHeader__icon"></div>
                <div class="pageHeader__content">
                    <h1 class="pageHeader__title">First Last</h1>
                    <p class="pageHeader__subtitle"><?php the_time('F j, Y'); ?></p>
                </div>
            </div>
        </div>
        <div class="colGr__col colGr__col_6">
            <div class="mlCard mlCard_withPrefix">
                <div class="mlCard__prefix mlCard__prefix_success"><span>Success</span></div>
            </div>
        </div>
        <div class="colGr__col colGr__col_6"></div>
        <div class="colGr__col colGr__col_12">
            <?php
                foreach ($people as $person) {
                    $person = (array) json_decode( $person )[0];
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
        </div>
    </div>
<?php
    endwhile; endif;
    get_footer();
?>