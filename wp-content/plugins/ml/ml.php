<?php 

/**
 * Plugin name: ML
 * Author: Oleksii Tsioma
 */

add_action( 'wp' , '___mlp__user_check' );

function ___mlp__user_check(){

	if(
		!is_page( get_page_by_path( 'login' )->ID ) &&
		!is_page( get_page_by_path( 'signup' )->ID )
	) {

		if( !is_user_logged_in() ){
			wp_redirect( home_url( '/login/') , 301 );
		}

	}

	if( is_page( get_page_by_path( 'signup' )->ID ) ) {

		if( is_user_logged_in() ){
			wp_redirect( home_url() , 301 );
		}

	}

}

register_activation_hook( __FILE__ , '___mlp__register_user_roles' );

function ___mlp__register_user_roles(){

	$author = get_role('author');

	add_role( 'ml_starter', 'Starter', $author->capabilities );
	add_role( 'ml_pro', 'Professional', $author->capabilities );
	add_role( 'ml_enterprise', 'Enterprise', $author->capabilities );

}

function admin_default_page() {
	return home_url();
}
  
add_filter('login_redirect', 'admin_default_page');

// ASSETS

add_action( 'init' , '___mlp__frontend_assets' );

function ___mlp__frontend_assets(){

	wp_enqueue_script(
		$handle = 'single-skip',
		$src = plugin_dir_url( __FILE__ ) . 'assets/dist/skip.js',
		$deps = ['jquery'],
		$ver = null,
		$in_footer = true
	);

    $ajaxData = [
        'admin_ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'nonce' )
    ];

    wp_add_inline_script(
        $handle = 'single-skip',
        $data = 'const ajaxObject = ' . wp_json_encode( $ajaxData ),
        $position = 'before'
    );

}

// CPT

require plugin_dir_path( __FILE__ ) . '/inc/cpt/feature-cpt.php';
require plugin_dir_path( __FILE__ ) . '/inc/cpt/skip-cpt.php';
require plugin_dir_path( __FILE__ ) . '/inc/cpt/user-group-cpt.php';

function single_skip(){

	$skipData = $_POST['skipData'];

	$skip = wp_remote_post(
		$url = 'https://app.directskip.com/apiv2/search_contact.php',
		$args = array(
			'timeout' => 300,
			'headers' => array(
				'Accept: application/json',
				'Content-Type: application/json'
			),
			'body' => json_encode(
				array(
					'api_key' => 'h6m8LA8YBUib2uTWZuUp65d869bb0dc69xissI',
					'last_name' => $skipData['lastName'],
					'first_name' => $skipData['firstName'],
					'mailing_address' => $skipData['streetAddress'],
					'mailing_city' => $skipData['city'],
					'mailing_state' => $skipData['state'],
					'mailing_zip' => $skipData['zip']
				)
			)
		)
	);

	if( !is_wp_error( $skip ) ){

		$payload = $skip['body'];

		// $skipContacts = $skipBody->contacts;

		$skipPost = wp_insert_post(
			$postarr = wp_slash(
				array(
					'post_type' => 'skip',
					'post_status' => 'publish',
					'author' => $skipData['authorID'],
					'post_title' => $skipData['firstName'] . ' ' . $skipData['lastName'],
					'post_content' => $payload,
					'meta_input' => array(
						'skip_type' => 'Single'
					)
				)
			)
		);

		if( !is_wp_error( $skipPost ) ){

			print_r( json_encode( $skip ) );

		}

	}

}

add_action( 'wp_ajax_single_skip' , 'single_skip');
add_action( 'wp_ajax_nopriv_single_skip' , 'single_skip');


function batchSkip( $skipData ) {

	$skip = wp_remote_post(
		$url = 'https://app.directskip.com/apiv2/search_contact.php',
		$args = array(
			'timeout' => 300,
			'headers' => array(
				'Accept: application/json',
				'Content-Type: application/json'
			),
			'body' => json_encode(
				array(
					'api_key' => 'h6m8LA8YBUib2uTWZuUp65d869bb0dc69xissI',
					'last_name' => $skipData['lastName'],
					'first_name' => $skipData['firstName']
				)
			)
		)
	);

	if( !is_wp_error( $skip ) ){

		$payload = $skip['body'];

		// $skipContacts = $skipBody->contacts;

		$skipPost = wp_insert_post(
			$postarr = wp_slash(
				array(
					'post_type' => 'skip',
					'post_status' => 'publish',
					'author' => $skipData['authorID'],
					'post_title' => $skipData['firstName'] . ' ' . $skipData['lastName'],
					'post_content' => $payload,
					'meta_input' => array(
						'skip_type' => 'Single'
					)
				)
			)
		);

		if( !is_wp_error( $skipPost ) ){

			return $skipPost;

		}

	}

}

function update_user_info(){
	$infoType = $_POST['infoType'];

	if( $infoType == 'data' ){

		$userUpdate = wp_update_user([
			'ID' => $_POST['userID'],
			$_POST['info'] => $_POST['value']
		]);

		if( is_wp_error( $userUpdate ) ){
			print_r( 'error' );
			return;
		} else {
			print_r( 'success' );
			return;
		}
	}

};

add_action( 'wp_ajax_update_user_info' , 'update_user_info' );
add_action( 'wp_ajax_nopriv_update_user_info' , 'update_user_info' );