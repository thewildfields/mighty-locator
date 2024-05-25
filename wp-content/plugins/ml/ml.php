<?php 

/**
 * Plugin name: ML
 * Author: Oleksii Tsioma
 */


add_action( 'wp' , '___mlp__user_check' );

function ___mlp__user_check(){

	if( is_front_page() && !is_user_logged_in() ){
			wp_redirect( home_url( '/login') , 301 );
	}

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
require plugin_dir_path( __FILE__ ) . '/inc/cpt/listing-cpt.php';

// FUNCTIONS

require plugin_dir_path( __FILE__ ) . '/inc/functions/person-search.php';

add_action( 'wp_ajax_single_skip' , 'person_search');
add_action( 'wp_ajax_nopriv_single_skip' , 'person_search');


function batchSkip( $skipData ) {

	$skip = wp_remote_post(
		$url = 'https://api.openpeoplesearch.com/api/v1/Consumer/NameSearch',
		$args = array(
			'timeout' => 300,
			'headers' => array(
				'Accept: application/json',
				'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6Ijc1NTMiLCJyb2xlIjoidXNlciIsIm5iZiI6MTcxNjMxNzQzNCwiZXhwIjoxNzE2OTIyMjM0LCJpYXQiOjE3MTYzMTc0MzR9.Ib0XX62LDxTLTg_MLuhQVVxbceN5ybCBJ1W83Xw7mFE'
			),
			'body' => json_encode(
				array(
					'lastName'			=> $skipData['lastName'],
					'firstName'		=> $skipData['firstName'],
					'authorPlan'		=> $skipData['authorPlan'],
					'mailing_address'	=> $skipData["streetAddress"],
					'mailing_city'		=> $skipData["city"],
					'mailing_state'		=> $skipData["state"],
					'mailing_zip'		=> $skipData["zip"]
				)
			)
		)
	);

	if( !is_wp_error( $skip ) ){

		// $payload = $skip['body'];

		// // $skipContacts = $skipBody->contacts;

		// $skipPost = wp_insert_post(
		// 	$postarr = wp_slash(
		// 		array(
		// 			'post_type' => 'skip',
		// 			'post_status' => 'publish',
		// 			'author' => $skipData['authorID'],
		// 			'post_title' => $skipData['firstName'] . ' ' . $skipData['lastName'],
		// 			'post_content' => $payload,
		// 			'meta_input' => array(
		// 				'skip_type' => 'Single'
		// 			)
		// 		)
		// 	)
		// );

		// if( !is_wp_error( $skipPost ) ){

		// 	return $skipPost;

		// }

		return json_encode( $skip );

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

function scf( $label ){
	return get_post_meta( get_the_ID() , $label , true );
}

add_action( 'wp_ajax_update_user_info' , 'update_user_info' );
add_action( 'wp_ajax_nopriv_update_user_info' , 'update_user_info' );

