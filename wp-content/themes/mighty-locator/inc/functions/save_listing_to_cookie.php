<?php

function save_listing_to_cookie(){
    return json_encode('save to cookie');
}


add_action('wp_ajax_save_listing_to_cookie','save_listing_to_cookie');
add_action('wp_ajax_nopriv_save_listing_to_cookie','save_listing_to_cookie');