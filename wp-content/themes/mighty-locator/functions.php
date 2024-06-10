<?php

require_once get_template_directory() . '/inc/functions/get_member_data.php';
// require_once get_template_directory() . '/inc/functions/save_listing_to_cookie.php';

add_theme_support( 'menus' );
add_theme_support( 'custom-logo' );

add_action( 'init' , '___mlt__frontend_assets' );



function ___mlt__frontend_assets(){
        
    $ajaxData = [
        'admin_ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'nonce' )
    ];

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

        wp_add_inline_script(
            'mighty-locator-theme-frontend',
            $data = 'const ajaxObject = ' . wp_json_encode( $ajaxData ),
            'before'
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


function save_listing_to_cookie(){
    $listings = $_COOKIE['saved-listings'];

    if( $listings ){
        $listings = explode('-',$listings);
    } else {
        $listings = array();
    }

    if( in_array( $_POST['listing'] , $listings ) ){
        unset( $listings[array_search( $_POST['listing'] , $listings ) ] );
        // array_push( $listings , $_POST['listing'] );
    } else {
        array_push( $listings , $_POST['listing'] );
    }

    setcookie(
        'saved-listings',
        implode('-',$listings),
        time()+60*60*24*30,
        "/",
    );
    print_r( json_encode( $_COOKIE['saved-listings'] ) );
}


add_action('wp_ajax_save_listing_to_cookie','save_listing_to_cookie');
add_action('wp_ajax_nopriv_save_listing_to_cookie','save_listing_to_cookie');

function return_author_contacts(){
    $user = get_userdata($_POST['author']);
    $email = $user->user_email;
    print_r(json_encode($email));
}

add_action('wp_ajax_return_author_contacts','return_author_contacts');
add_action('wp_ajax_nopriv_return_author_contacts','return_author_contacts');


function update_listing(){

    if( $_POST['listing'] !== 'new' ){
        $postData = [
            'ID' => $_POST['listing'],
            'post_title' => $_POST['title'],
            'post_content' => $_POST['content'],
            'meta_input' => array(
                'tags' => serialize($_POST['tags']),
                'counties' => serialize($_POST['counties']),
                'pricing' => $_POST['pricing']
            )
        ];
        wp_update_post( $postData );
    } else {
        wp_insert_post(
            wp_slash(
                array(
                    'ID' => $_POST['listing'],
                    'post_title' => $_POST['title'],
                    'post_type' => 'listing',
                    'post_content' => $_POST['content'],
                    'post_status' => 'publish',
                    'meta_input' => array(
                        'tags' => serialize($_POST['tags']),
                        'counties' => serialize($_POST['counties']),
                        'pricing' => $_POST['pricing']
                    )
                )
            )
        );
    }

    print_r( json_encode('update listing '.$_POST['listing'].' with title '.$_POST['title'] ) );
}

add_action('wp_ajax_update_listing','update_listing');
add_action('wp_ajax_nopriv_update_listing','update_listing');