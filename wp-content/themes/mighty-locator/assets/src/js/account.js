import $ from 'jquery';

const accountNav = $('.pms-account-navigation');
const accountNavLinks = $(accountNav).find('li');
const walletAccountLink = $('.woocommerce-MyAccount-navigation-link--woo-wallet');
$(walletAccountLink).addClass('pms-account-navigation-link');

console.log( walletAccountLink );

$(accountNavLinks[2]).after(walletAccountLink);

const subtoyt = $('#free-searches-subscribe-to-youtube');

$(subtoyt).on( 'click' , function(){
    const data = {
        action: 'subscribe_to_youtube',
        userId: $(this).attr('current-user'),
    }
    $.post(
        ajaxObject.admin_ajax_url,
        data
    )
})

const subtofb = $('#free-searches-subscribe-to-facebook');

$(subtofb).on( 'click' , function(){
    const data = {
        action: 'subscribe_to_facebook',
        userId: $(this).attr('current-user'),
    }
    $.post(
        ajaxObject.admin_ajax_url,
        data
    )
})