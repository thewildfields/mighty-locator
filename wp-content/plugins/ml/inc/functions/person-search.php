<?php 

function person_search(){

	global $wpdb;

	$personSearchResponse = [];

	$searchData = $_POST['skipData'];

	$personSearch = wp_remote_post(
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
					'last_name'			=> $searchData['lastName'],
					'first_name'		=> $searchData['firstName'],
					'mailing_address'	=> $searchData["streetAddress"],
					'mailing_city'		=> $searchData["city"],
					'mailing_state'		=> $searchData["state"],
					'mailing_zip'		=> $searchData["zip"]
				)
			)
		)
	);

	if( !is_wp_error( $skip ) ){

		$payload = $skip['body'];

		$response['skip'] = $skip;

		if( $searchData['authorFreeSearches'] > 0 ){

			$newFreeSearchesBalance = $searchData['authorFreeSearches'] - 1;
			update_user_meta( get_current_user_id() , 'free_searches_balance' , $newFreeSearchesBalance );
			$personSearchResponse['freeSearchesBalance'] = $newFreeSearchesBalance;
			$personSearchResponse['balance'] = $searchData['balance'];

		} else {

			$wpdb->insert(
				$wpdb->prefix . 'woo_wallet_transactions',
				[
					'blog_id' => 1,
					'user_id' => $searchData['authorID'],
					'type' => 'debit',
					'amount' => $searchData['price'],
					'balance' => $searchData['balance'] - $searchData['price'],
					'currency' => 'USD',
					'created_by' => $searchData['authorID'],
					'date' => time()
				]
			);

			$response['balance'] = $searchData['balance'] - $searchData['price'];

		}

	}

	if( !is_wp_error( $personSearch ) ){

		$responseBody = json_decode( $personSearch['body'] );
		$requestInput = $responseBody->input;
		$responseContacts = $responseBody->contacts;
		$responseContactsCount = sizeof( $responseContacts );
	
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
			if(
				$requestInput->address ||
				$requestInput->city ||
				$requestInput->state ||
				$requestInput->zip
			){

				$personSearchResponse['status'] = 'error';
				$personSearchResponse['errorMessage'] = 'Person Not Found with this name and address combination. Do you want to retry the search without the address?';
				print_r( json_encode( $personSearchResponse ) );
				return;
			} else {
				$personSearchResponse['status'] = 'error';
				$personSearchResponse['errorMessage'] = 'Person Not Found';
				print_r( json_encode( $personSearchResponse ) );
				return;
			}
		} else {
			
			$personSearchResponse['status'] = 'success';
			$personSearchResponse['successMessage'] = $responseContactsCount == 1 ? 'A person was found' : $responseContactsCount . ' people were found';

			$people = [];
			
			foreach ($responseContacts as $contact) {
	
				$person = [];
	
				// Names
				$names = $contact->names;
				$namesArray = [];   
				foreach( $names as $name ) {
					$nameRecord = [];
					$nameRecord['firstName'] = ucfirst( strtolower( $name->firstname ) );
					$nameRecord['lastName'] = ucfirst( strtolower( $name->lastname ) );
					$nameRecord['age'] = $name->age;
					switch ($name->deceased) {
						case 'N':
							$nameRecord['deceased'] = false;
							break;
						case 'Y':
							$nameRecord['deceased'] = true;
							break;
						default:
							$nameRecord['deceased'] = strtolower( $name->deceased );
							break;
					}
					array_push( $namesArray , $name );
				}
				$person['names'] = $namesArray;
	
				// Phones
				$phones = $contact->phones;
				$phonesArray = [];
				foreach ( $phones as $phone ) {
					$phoneRecord = [];
					$phoneRecord['number'] = $phone->phonenumber;
					if( $phone->phonetype ){
						$phoneRecord['type'] = $phone->phonetype;
					}
					array_push( $phonesArray , $phoneRecord );
				}
				$person['phones'] = $phonesArray;
	
				// Emails
				$emails = $contact->emails;
				$emailsArray = [];
				foreach ( $emails as $email ) {
					array_push( $emailsArray , strtolower( $email->email ) );
				}
				$person['emails'] = $emailsArray;
	
				// Addresses
				$addresses = $contact->confirmed_address;
				$addressesArray = [];
				foreach ( $addresses as $address ) {
					$addressRecord = [];
					$addressRecord['street'] = ucfirst( strtolower( $address->street ) );
					$addressRecord['city'] = ucfirst( strtolower( $address->city ) );
					$addressRecord['state'] = strtoupper( $address->state );
					$addressRecord['zip'] = $address->zip;
	
					array_push( $addressesArray , $addressRecord );
				}
				$person['addresses'] = $addressesArray;
				
				// Relatives
				$relatives = $contact->relatives;
				$relativesArray = [];
				foreach ( $relatives as $relative ) {
					$relativeRecord = [];
					$relativeRecord['name'] = ucfirst( strtolower( $relative->name ) );
					$relativeRecord['age'] = $relative->age;
					$phones = $relative->phones;
					$phonesArray = [];
					foreach ( $phones as $phone ) {
						$phoneRecord = [];
						$phoneRecord['number'] = $phone->phonenumber;
						if( $phone->phonetype ){
							$phoneRecord['type'] = ucfirst( strtolower( $phone->phonetype ) );
						}
						array_push( $phonesArray , $phoneRecord );
					}
					$relativeRecord['phones'] = $phonesArray;
					array_push( $relativesArray , $relativeRecord );
				}
				$person['relatives'] = $relativesArray;

				array_push( $people , $person );
	
			}

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
					$names = $person['names'];
					$name = $names[0];
					update_post_meta( $personPost, 'input', serialize( $requestInput ) );
					update_post_meta( $personPost, 'firstName', ucfirst( strtolower( $name->firstname ) ) );
					update_post_meta( $personPost, 'lastName', ucfirst( strtolower( $name->lastname ) ) );
					update_post_meta( $personPost, 'age', $name->age );
					update_post_meta( $personPost, 'deceased', strtolower( $name->deceased ) );
					if( sizeof( $names ) > 1 ){
						update_post_meta( $personPost, 'multipleNames', serialize( $person['names'] ) );
					}
					update_post_meta( $personPost, 'phones', serialize( $person['phones'] ) );
					update_post_meta( $personPost, 'emails', serialize( $person['emails'] ) );
					update_post_meta( $personPost, 'addresses', serialize( $person['addresses'] ) );
					update_post_meta( $personPost, 'relatives', serialize( $person['relatives'] ) );
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