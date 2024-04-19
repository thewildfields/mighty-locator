<?php

add_theme_support( 'menus' );

add_action( 'init' , '___mlt__frontend_assets' );

function ___mlt__frontend_assets(){

    if( !is_admin(  ) ){

        wp_enqueue_style(
            $handle = 'mighty-locator-frontend',
            $src = get_theme_file_uri( 'assets/css/portal.css' ),
            $deps = null,
            $ver = null,
            $media = 'all'
        );

        wp_enqueue_style(
            $handle = 'mighty-locator-theme-frontend',
            $src = get_theme_file_uri( 'assets/dist/bundle.css' ),
            $deps = null,
            $ver = null,
            $media = 'all'
        );

        wp_enqueue_script(
            $handle = 'mighty-locator-theme-frontend',
            $src = get_theme_file_uri( 'assets/dist/frontend.js' ),
            $deps = ['jquery'],
            $ver = null,
            $in_footer = true
        );

    }

    wp_enqueue_script(
        $handle = 'popper',
        $src = get_theme_file_uri( 'assets/plugins/popper.min.js' ),
        $deps = ['jquery'],
        $ver = null,
        $in_footer = true
    );

    wp_enqueue_script(
        $handle = 'bootstrap',
        $src = get_theme_file_uri( 'assets/plugins/bootstrap/js/bootstrap.min.js' ),
        $deps = ['jquery'],
        $ver = null,
        $in_footer = true
    );

    wp_enqueue_script(
        $handle = 'mighty-locator-frontend',
        $src = get_theme_file_uri( 'assets/js/app.js' ),
        $deps = ['jquery'],
        $ver = null,
        $in_footer = true
    );

}