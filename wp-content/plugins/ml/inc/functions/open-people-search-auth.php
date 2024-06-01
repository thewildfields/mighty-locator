<?php 

function open_people_search_auth( $settings ){

    $auth = wp_remote_post(
        'https://api.openpeoplesearch.com/api/v1/User/authenticate',
        array(
            'timeout' => 300,
            'httpversion' => '1.0',
            'sslverify' => false,
            'headers' => array(
                "accept" => "*/*",
                "Content-Type" => "application/json"
            ),
            'body' => json_encode( array(
                'username' => $settings['account_login'],
                'password' => $settings['account_password']
            ) )
        )
    );

    if( !is_wp_error( $auth ) ){
        $response = json_decode( $auth['body'] );
        update_option(
            'options_open_people_search_authorization_token',
            $response->token,
            true
        );
        update_option(
            'options_open_people_search_authorization_token_expiration_date',
            $response->token_expiry_utc,
            true
        );
    }

}