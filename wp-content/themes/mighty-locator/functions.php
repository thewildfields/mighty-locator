<?php

require_once get_template_directory() . '/inc/functions/get_member_data.php';

add_theme_support( 'menus' );
add_theme_support( 'custom-logo' );

add_action( 'init' , '___mlt__frontend_assets' );

function ___mlt__frontend_assets(){

    if( !is_admin(  ) ){

        wp_enqueue_script(
            $handle = 'mighty-locator-theme-frontend',
            $src = get_theme_file_uri( 'assets/dist/frontend.js' ),
            $deps = ['jquery'],
            $ver = null,
            $in_footer = true
        );

        wp_enqueue_style(
            $handle = 'mighty-locator-theme-frontend',
            $src = get_theme_file_uri( 'assets/dist/bundle.css' ),
            $deps = null,
            $ver = null,
            $media = 'all'
        );

    }

}

function subscribe_to_youtube(){
    update_user_meta( $_POST['userId'] , 'subscribed_to_youtube' , 1 );
}

add_action( 'wp_ajax_subscribe_to_youtube' , 'subscribe_to_youtube' );
add_action( 'wp_ajax_nopriv_subscribe_to_youtube' , 'subscribe_to_youtube' );

function subscribe_to_facebook(){
    update_user_meta( $_POST['userId'] , 'subscribed_to_facebook' , 1 );
}

add_action( 'wp_ajax_subscribe_to_facebook' , 'subscribe_to_facebook' );
add_action( 'wp_ajax_nopriv_subscribe_to_facebook' , 'subscribe_to_facebook' );

add_action( 'after_setup_theme', function(){
	register_nav_menus( [
		'header_menu' => 'Header menu',
		'footer_menu' => 'Footer menu'
	] );
} );