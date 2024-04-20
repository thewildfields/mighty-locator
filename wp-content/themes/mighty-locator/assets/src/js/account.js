import $ from 'jquery';

const accountNav = $('.pms-account-navigation');
const accountNavLinks = $(accountNav).find('li');
const walletAccountLink = $('.woocommerce-MyAccount-navigation-link--woo-wallet');
$(walletAccountLink).addClass('pms-account-navigation-link');

console.log( walletAccountLink );

$(accountNavLinks[2]).after(walletAccountLink);