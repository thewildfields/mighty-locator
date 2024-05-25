<?php 

function person_search(){

	global $wpdb;

	$personSearchResponse = [];

	$searchData = $_POST['skipData'];

	// $personSearch = wp_remote_post(
	// 	$url = 'https://api.openpeoplesearch.com/api/v1/Consumer/NameSearch',
	// 	$args = array(
	// 		'timeout' => 300,
	// 		'headers' => array(
	// 			'Accept: application/json',
	// 			'Content-Type: application/json',
	// 			'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6Ijc1NTMiLCJyb2xlIjoidXNlciIsIm5iZiI6MTcxNjMxODE0OCwiZXhwIjoxNzE2OTIyOTQ4LCJpYXQiOjE3MTYzMTgxNDh9.CbhLUsEdmyBeZVebYm4fE9dQ-CG-iXeuchpoZ63yPvc'
	// 		),
	// 		'body' => json_encode(
	// 			array(
	// 				// 'api_key' => 'h6m8LA8YBUib2uTWZuUp65d869bb0dc69xissI',
	// 				'lastName'			=> $searchData['lastName'],
	// 				'firstName'		=> $searchData['firstName'],
	// 				'address'	=> $searchData["streetAddress"],
	// 				'city'		=> $searchData["city"],
	// 				'state'		=> $searchData["state"],
	// 				'zip'		=> $searchData["zip"]
	// 			)
	// 		)
	// 	)
	// );

	// if( !is_wp_error( $skip ) ){

	// 	$payload = $skip['body'];

	// 	$response['skip'] = $skip;

	// 	if( $searchData['authorFreeSearches'] > 0 ){

	// 		$newFreeSearchesBalance = $searchData['authorFreeSearches'] - 1;
	// 		update_user_meta( get_current_user_id() , 'free_searches_balance' , $newFreeSearchesBalance );
	// 		$personSearchResponse['freeSearchesBalance'] = $newFreeSearchesBalance;
	// 		$personSearchResponse['balance'] = $searchData['balance'];

	// 	} else {

	// 		$wpdb->insert(
	// 			$wpdb->prefix . 'woo_wallet_transactions',
	// 			[
	// 				'blog_id' => 1,
	// 				'user_id' => $searchData['authorID'],
	// 				'type' => 'debit',
	// 				'amount' => $searchData['price'],
	// 				'balance' => $searchData['balance'] - $searchData['price'],
	// 				'currency' => 'USD',
	// 				'created_by' => $searchData['authorID'],
	// 				'date' => time()
	// 			]
	// 		);

	// 		$response['balance'] = $searchData['balance'] - $searchData['price'];

	// 	}

	// }

	$ch = curl_init();
	curl_setopt( $ch , CURLOPT_URL , 'https://api.openpeoplesearch.com/api/v1/Consumer/NameSearch' );
	curl_setopt( $ch , CURLOPT_RETURNTRANSFER , 1 );
	curl_setopt( $ch , CURLOPT_POST , 1 );
	curl_setopt( $ch , CURLOPT_POSTFIELDS , json_encode( array(
		'lastName' => $searchData['lastName'],
		'firstName' => $searchData['firstName'],
	)) );

	$headers = array();
	$headers[] = 'accept: text/plain';
	$headers[] = 'Content-Type: application/json';
	$headers[] = 'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6Ijc1NTMiLCJyb2xlIjoidXNlciIsIm5iZiI6MTcxNjMxODE0OCwiZXhwIjoxNzE2OTIyOTQ4LCJpYXQiOjE3MTYzMTgxNDh9.CbhLUsEdmyBeZVebYm4fE9dQ-CG-iXeuchpoZ63yPvc';

	curl_setopt( $ch , CURLOPT_HTTPHEADER , $headers );

	$result = curl_exec( $ch );

	if( !is_wp_error( $result ) ){

		$result = json_decode( $result );

		$requestInput = $result->searchCriteria;
		$responseContacts = $result->results;
		$responseContactsCount = sizeof( $responseContacts );

		$personSearchResponse['firstName'] = $searchData['firstName'];
		$personSearchResponse['lastName'] = $searchData['lastName'];
	
		if( $responseContactsCount == 0 ){
			$personPost = wp_insert_post(
				$postarr = wp_slash(
					array(
						'post_type' => 'skip',
						'post_status' => 'publish',
						'author' => $searchData['authorID'],
						'post_title' => $searchData['firstName'] . ' ' . $searchData['lastName'] . ' - Unsuccessfull',
					)
				)
			);
			if( !is_wp_error( $personPost ) ){
				$names = $person['names'];
				$name = $names[0];
				update_post_meta( $personPost, 'input', serialize( $requestInput ) );
				update_post_meta( $personPost, 'firstName', ucfirst( strtolower( $searchData['firstName'] ) ) );
				update_post_meta( $personPost, 'lastName', ucfirst( strtolower( $searchData['lastName'] ) ) );
				update_post_meta( $personPost, 'is_successful', 0 );
				update_post_meta( $personPost, 'skipType', 'single' );
			}
			$personSearchResponse['status'] = 'error';
			$personSearchResponse['skipData'] = $searchData;
			$personSearchResponse['errorMessage'] = 'Nothing was found';
			print_r( json_encode( $personSearchResponse ) );
			return;
		} else if( $responseContactsCount > 10) {
			$personSearchResponse['status'] = 'error';
			$personSearchResponse['errorMessage'] = 'More than 10 entries was found for your search. Try adding additional parameters to narrow down the result.';
			print_r( json_encode( $personSearchResponse ) );
			return;
		} else {
			
			$personSearchResponse['status'] = 'success';
			$personSearchResponse['successMessage'] = $responseContactsCount == 1 ? 'A person was found' : $responseContactsCount . ' people were found';

			$people = $responseContacts;

			foreach ($people as $person) {
				$personPost = wp_insert_post(
					$postarr = wp_slash(
						array(
							'post_type' => 'skip',
							'post_status' => 'publish',
							'author' => $searchData['authorID'],
							'post_title' => $searchData['firstName'] . ' ' . $searchData['lastName'],
						)
					)
				);

				if( !is_wp_error( $personPost ) ){
					update_post_meta( $personPost, 'input', serialize( $requestInput ) );
					update_post_meta( $personPost, 'firstName', ucfirst( strtolower( $person->firstName ) ) );
					update_post_meta( $personPost, 'lastName', ucfirst( strtolower( $person->lastName ) ) );
					// update_post_meta( $personPost, 'age', $name->age );
					// update_post_meta( $personPost, 'deceased', strtolower( $name->deceased ) );
					// if( sizeof( $names ) > 1 ){
					// 	update_post_meta( $personPost, 'multipleNames', serialize( $person['names'] ) );
					// }
					update_post_meta( $personPost, 'phone', serialize( $person->phone ) );
					update_post_meta( $personPost, 'email', serialize( $person->email ) );
					update_post_meta( $personPost, 'address', serialize(
						$person->address.', '.$person->city.', '.$person->state.' '.$person->zip
					) );
					// update_post_meta( $personPost, 'relatives', serialize( $person['relatives'] ) );
					update_post_meta( $personPost, 'is_successful', 1 );
					update_post_meta( $personPost, 'skipType', 'single' );
				}
			}

			if( $searchData['authorPlan'] == 'Starter' ){
				foreach ($people as $index => $person) {

					$responseNames = $person['names'];
					if( sizeof( $responseNames ) > 1 ){
						$name = $responseNames[0];
						$person['names'] = [ $name ];
						$person['totalNames'] = sizeof( $responseNames );
					}

					$responsePhones = $person['phones'];
					if( sizeof( $responsePhones ) > 1 ){
						$phone = $responsePhones[0];
						$person['phones'] = [ $phone ];
						$person['totalPhones'] = sizeof( $responsePhones );
					}

					$responseAddresses = $person['addresses'];
					if( sizeof( $responseAddresses ) > 1 ){
						$address = $responseAddresses[0];
						$person['addresses'] = [ $address ];
						$person['totalAddresses'] = sizeof( $responseAddresses );
					}

					$responseEmails = $person['emails'];
					if( sizeof( $responseEmails ) ){
						$person['totalEmails'] = sizeof( $responseEmails );
					}
					unset( $person['emails']);
					
					$responseRelatives = $person['relatives'];
					if( sizeof( $responseRelatives ) ){
						$person['totalRelatives'] = sizeof( $responseRelatives );
					}
					unset( $person['relatives']);

					$people[$index] = $person;

				}
			}

			$personSearchResponse['authorPlan'] = $searchData['authorPlan'];

			$personSearchResponse['people'] = $people;

			$personSearchResponse['authorID'] = $searchData['authorID'];
			$personSearchResponse['price'] = $searchData['price'];
			$personSearchResponse['balance'] = round( woo_wallet()->wallet->get_wallet_balance( $searchData['authorID'] , true) , 2, PHP_ROUND_HALF_UP );

			print_r( json_encode( $personSearchResponse ) );
			return;
	
		}

	} else {
		$personSearchResponse['status'] = 'error';
		$personSearchResponse['errorMessage'] = 'Request error';
		print_r( json_encode( $personSearchResponse ) );
		return;
	}

}