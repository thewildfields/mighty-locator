<?php

$phones = unserialize( scf('phones') );
$addresses = unserialize( scf('addresses') );
$emails = unserialize( scf('emails') );
$relatives = unserialize( scf('relatives') );

?>

<div class="col-12 pt-4" id="fast-skip-error" style="max-height: 0; opacity: 0;">
    <?php echo get_template_part( 'templates/person-search' , 'error' ); ?>
</div>
<div id="peopleCards"></div>

<!-- <div class="card">

    <div class="card__header">
        <div class="container card__container">
            <h2 class="card__title card__title_big" fast-search-data="name"><?php echo scf('firstName') . ' ' . scf('lastName'); ?></h2>
            <div class="card__label"></div>
        </div>
    </div>

    <div class="card__body">
        <div class="container card__container">
            <p><strong>Age: </strong><span fast-search-data="age"><?php echo scf('age'); ?></span></p>
            <div class="cardSection">
                <div class="cardSection__title">Phones</div>
                <div class="cardSection__content cardSection__content_flex" fast-search-data="phones">
                    <?php
                        if( $phones ) {
                            foreach ( $phones as $phone ) { 
                                $n = $phone['number'];
                                $nd = '+1 ('.substr($n,0,3).') '.substr($n,3,3).'-'.substr($n,6);
                                echo '<p class="cardSection__contentItem"><a href="tel:'.$n.'">'.$nd.'</a></p>';
                            }
                        } else {
                            echo '<p class="cardSection__noContent">No phone numbers were found</p>';
                        }
                    ?>
                </div>
            </div>
            <div class="cardSection">
                <div class="cardSection__title">Addresses</div>
                <div class="cardSection__content cardSection__content_flex" fast-search-data="addresses">
                    <?php
                        if( $addresses ) {
                            foreach ( $addresses as $a ) {
                                echo '<p class="cardSection__contentItem">'.$a['street'].', '.$a['city'].', '.$a['state'].' '.$a['zip'].'</p>';
                            }
                        } else {
                            echo '<p class="cardSection__noContent">No addresses were found</p>';
                        }
                    ?>
                </div>
            </div>
            <div class="cardSection">
                <div class="cardSection__title">Emails</div>
                <div class="cardSection__content cardSection__content_flex" fast-search-data="emails">
                    <?php
                        if( $emails ) {
                            foreach ( $emails as $e ) {
                                echo '<p class="cardSection__contentItem"><a href="mailto:'.$e.'">'.$e.'</a></p>';
                            }
                        } else {
                            echo '<p class="cardSection__noContent">No emails were found</p>';
                        }
                    ?>
                </div>
            </div>
            <div class="cardSection">
                <div class="cardSection__title">Relatives</div>
                <div class="cardSection__content">
                    <div class="cardSection__contentSection" fast-search-data="relatives">
                        <?php if( $relatives ) { foreach ( $relatives as $r ) { ?>
                            <p class="cardSection__contentItem"><?php echo $r['name']; ?></p>
                            <?php if( $r['phones'] ){ ?>
                                <div class="cardSection__content cardSection__content_flex">
                                    <?php foreach( $r['phones'] as $phone ) {
                                        $n = $phone['number'];
                                        $nd = '+1 ('.substr($n,0,3).') '.substr($n,3,3).'-'.substr($n,6);
                                        echo '<p class="cardSection__contentItem cardSection__contentItem_small"><a href="tel:'.$n.'">'.$nd.'</a></p>';
                                    } ?>
                                </div>
                            <?php } else {
                                echo '<p class="cardSection__contentItem cardSection__contentItem_small">No phone numbers were found</p>';
                            } ?>
                        <?php } } else { echo '<p class="cardSection__noContent">No relatives were found</p>'; } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card__footer"></div>

</div> -->