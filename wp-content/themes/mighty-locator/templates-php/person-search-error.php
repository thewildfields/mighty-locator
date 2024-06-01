<?php

$phones = unserialize( scf('phones') );
$addresses = unserialize( scf('addresses') );
$emails = unserialize( scf('emails') );
$relatives = unserialize( scf('relatives') );

?>

<div class="card">

    <div class="card__header">
        <div class="container card__container">
            <h2 class="card__title card__title_big" fast-search-data="name"></h2>
            <div class="card__label"></div>
        </div>
    </div>

    <div class="card__body">
        <div class="container card__container">
            <h2 id="error-text"></h2>
            <p id="error-hint"></p>
            <p>We are working hard to get the best data available for the Mighty Locator users. The ID of this unsuccessfull search has been saved to our database for future investigation. One of our representatives will contact you soon to provide additional information.</p>
        </div>
    </div>

</div>