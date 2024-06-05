<?php
$member = get_member_data(get_current_user_id());
?>
<form class='psf mlForm colGr' method='POST'>
    <input type='hidden' class="mlForm__input" name='psf-author-id' value="<?php echo $member['id']; ?>"  />
    <input type='hidden' class="mlForm__input" name='psf-wallet-balance' value="<?php echo $member['walletBalance']; ?>"  />
    <input type='hidden' class="mlForm__input" name='psf-search-price' value="<?php echo $member['searchPrice']; ?>"  />
    <input type='hidden' class="mlForm__input" name='psf-free-searches-balance' value="<?php echo $member['freeSearchesBalance']; ?>"  />
    <div class='colGr__col colGr__col_6'>
        <div class='mlForm__inputGroup'>
            <label class='mlForm__label' for='psf-first-name'>First Name</label>
            <input class='mlForm__input' name='psf-first-name' type='text' placeholder='John' required />
        </div>
    </div>
    <div class='colGr__col colGr__col_6'>
        <div class='mlForm__inputGroup'>
            <label class='mlForm__label' for='psf-last-name'>Last Name</label>
            <input class='mlForm__input' name='psf-last-name' type='text' placeholder='Smith' required />
        </div>
    </div>
    <div class='colGr__col colGr__col_12'>
        <div class='mlForm__inputGroup'>
            <label class='mlForm__label' for='psf-street-address'>Street Address</label>
            <input class='mlForm__input' name='psf-street-address' placeholder='115 Pacific Ave' type='text' />
        </div>
    </div>
    <div class='colGr__col colGr__col_4'>
        <div class='mlForm__inputGroup'>
            <label class='mlForm__label' for='psf-city'>City</label>
            <input class='mlForm__input' name='psf-city' type='text' placeholder="Prineville" />
        </div>
    </div>
    <div class='colGr__col colGr__col_4'>
        <div class='mlForm__inputGroup'>
            <label class='mlForm__label' for='psf-state'>State</label>
            <select class='mlForm__input' name='psf-state'>
                <option value='' selected disabled>Choose State</option>
                <option value='AL'>Alabama</option>
                <option value='AK'>Alaska</option>
                <option value='AZ'>Arizona</option>
                <option value='AR'>Arkansas</option>
                <option value='AS'>American Samoa</option>
                <option value='CA'>California</option>
                <option value='CO'>Colorado</option>
                <option value='CT'>Connecticut</option>
                <option value='DE'>Delaware</option>
                <option value='DC'>District of Columbia</option>
                <option value='FL'>Florida</option>
                <option value='GA'>Georgia</option>
                <option value='GU'>Guam</option>
                <option value='HI'>Hawaii</option>
                <option value='ID'>Idaho</option>
                <option value='IL'>Illinois</option>
                <option value='IN'>Indiana</option>
                <option value='IA'>Iowa</option>
                <option value='KS'>Kansas</option>
                <option value='KY'>Kentucky</option>
                <option value='LA'>Louisiana</option>
                <option value='ME'>Maine</option>
                <option value='MD'>Maryland</option>
                <option value='MA'>Massachusetts</option>
                <option value='MI'>Michigan</option>
                <option value='MN'>Minnesota</option>
                <option value='MS'>Mississippi</option>
                <option value='MO'>Missouri</option>
                <option value='MT'>Montana</option>
                <option value='NE'>Nebraska</option>
                <option value='NV'>Nevada</option>
                <option value='NH'>New Hampshire</option>
                <option value='NJ'>New Jersey</option>
                <option value='NM'>New Mexico</option>
                <option value='NY'>New York</option>
                <option value='NC'>North Carolina</option>
                <option value='ND'>North Dakota</option>
                <option value='MP'>Northern Mariana Islands</option>
                <option value='OH'>Ohio</option>
                <option value='OK'>Oklahoma</option>
                <option value='OR'>Oregon</option>
                <option value='PA'>Pennsylvania</option>
                <option value='PR'>Puerto Rico</option>
                <option value='RI'>Rhode Island</option>
                <option value='SC'>South Carolina</option>
                <option value='SD'>South Dakota</option>
                <option value='TN'>Tennessee</option>
                <option value='TX'>Texas</option>
                <option value='TT'>Trust Territories</option>
                <option value='UT'>Utah</option>
                <option value='VT'>Vermont</option>
                <option value='VA'>Virginia</option>
                <option value='VI'>Virgin Islands</option>
                <option value='WA'>Washington</option>
                <option value='WV'>West Virginia</option>
                <option value='WI'>Wisconsin</option>
                <option value='WY'>Wyoming</option>
            </select>
        </div>
    </div>
    <div class='colGr__col colGr__col_4'>
        <div class='mlForm__inputGroup'>
            <label class='mlForm__label' for='psf-zip'>ZIP</label>
            <input class='mlForm__input' name='psf-zip' type='text' placeholder="12345" />
        </div>
    </div>
    <div class='colGr__col colGr__col_6'>
        <div class='mlForm__inputGroup'>
            <label class='mlForm__label' for='psf-phone'>Phone</label>
            <input class='mlForm__input' name='psf-phone' type='text' placeholder='(111) 111-1111' />
        </div>
    </div>
    <div class='colGr__col colGr__col_6'>
        <div class='mlForm__inputGroup'>
            <label class='mlForm__label' for='psf-email'>Email</label>
            <input class='mlForm__input' name='psf-email' type='text' placeholder="name@example.com" />
        </div>
    </div>
    <div class='colGr__col colGr__col_12'>
        <div class='mlForm__inputGroup'>
            <label class='mlForm__label' for='psf-relatives'>Relatives</label>
            <input class='mlForm__input' name='psf-relatives' type='text' placeholder='Claude Monet, Jackson Pollock' />
        </div>
    </div>
    <div class="colGr__col colGr__col_8">
    </div>
    <div class="colGr__col colGr__col_4">
        <p class="mlForm__hint">
            <?php 
            if( $member['freeSearchesBalance'] > 0 ){
                echo 'Run free search';
            } else {
                echo 'Run a paid search for $'.$member['searchPrice'];
            }
            ?>
        </p>
        <button class='psf__submit button button_info' type='submit' id='person-serch-form-submit'>Search</button>
    </div>
</form>