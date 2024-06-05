<?php 

require_once PLUGIN_DIR_PATH . '/inc/functions/open-people-search-auth.php';
require_once PLUGIN_DIR_PATH . '/inc/functions/person-display.php';

function person_search( $req ){

	$response = [];

	// $userId = $req['author-id'];
 	$searchPrice = (float) $req['search-price'];
	$walletBalance = (float) $req['wallet-balance'];
	$newWalletBalance = $walletBalance;


	if( $req['free-searches-balance'] && $req['free-searches-balance'] > 0 ){
		$newFreeSearchesBalance = $req['free-searches-balance'] - 1;
		update_user_meta(
			$userId,
			'free_searches_balance',
			$newFreeSearchesBalance,
			$req['free-searches-balance']
		);
		$response['freeSearchesBalance'] = $newFreeSearchesBalance;
	} else {
		$response['searchType'] = 'paid'; 
		woo_wallet()->wallet->debit(
			$user_id = $req['author-id'],
			$amount = $searchPrice
		);
		$newWalletBalance = $walletBalance - $searchPrice;
	}

	$searchPrice = $response['searchType'] == 'free' ? 'Free' : '$'.$searchPrice;


	$directskipResults = false;
	$openpeoplesearchResults = false;

	$directskipPeople = [];
	$openpeoplesearchPeople = [];
	$initialPeople = [];
	$finalPeople = [];
	$finalPeopleWithoutContacts = [];
	$additionalAddresses = [];

	// Direct Skip Search

	$directSkipSettings = get_field('direct_skip', 'option');

	$directSkipSearch = wp_remote_post(
		'https://app.directskip.com/apiv2/search_contact.php',
		array(
			'timeout' => 300,
            'httpversion' => '1.0',
            'sslverify' => false,
            'headers' => array(
                "accept" => "application/json",
                "Content-Type" => "application/json"
            ),
			'body' => json_encode(array(
				'api_key'			=> 'h6m8LA8YBUib2uTWZuUp65d869bb0dc69xissI',
				'first_name'		=> $req['first-name'],
				'last_name'			=> $req['last-name'],
				'mailing_address'	=> $req['street-address'],
				'mailing_city'		=> $req['city'],
				'mailing_state'		=> $req['state'],
				'mailing_zip'		=> $req['zip']
			))
		)
	);	
	
	$responseBody = json_decode( $directSkipSearch['body'] );
	$responseContacts = $responseBody->contacts;

	if( $directSkipSearch['response']['code'] == 200 ){

		foreach ($responseContacts as $contact) {

			$contactNames = $contact->names;
			$nameArray = $contactNames[0];
			
			$person = [];
			$dob = array();
			$middleName = array();
			$person['firstName'] = ucFirst( strtolower( $nameArray->firstname ) );
			$person['lastName'] = ucFirst( strtolower( $nameArray->lastname ) );

			if( $nameArray->age ){ $person['age'] = $nameArray->age; }

			if( sizeof( $contact->names ) > 1 ){ $person['multipleNames'] = true; }

			if( sizeof( $contact->confirmed_address ) > 0 ){
				$addresses = [];

				foreach ($contact->confirmed_address as $initialAddress) {
					$address = [];
					$streetInitial = strtolower( $initialAddress->street );
					$streetInitial = str_replace( ' street', ' st' , $streetInitial );
					$streetInitial = str_replace( ' suite', ' ste' , $streetInitial );
					$streetInitial = str_replace( ' lane', ' ln' , $streetInitial );
					$streetInitial = str_replace( ' avenue', ' ave' , $streetInitial );
					$streetInitial = str_replace( '-', '' , $streetInitial );
					$address['street']	= ucwords( $streetInitial );
					$address['city']	= ucwords( strtolower( $initialAddress->city ) );
					$address['state']	= strtoupper( $initialAddress->state );
					$address['zip']		= $initialAddress->zip;
					$address = json_encode( $address );
					array_push( $addresses , $address );
				}

				$addresses = (array) $addresses;

				$person['addresses'] = $addresses;
			} else {
				$person['addresses'] = [];
			}
			
			$emails = [];
			if( $contact->emails && sizeof( $contact->emails ) > 0 ){
				foreach ($contact->emails as $email) {
					array_push( $emails , strtolower( $email->email ) );
				}
			};
			$person['emails'] = $emails;
			$phones = [];
			if( $contact->phones && sizeof( $contact->phones ) > 0 ){
				foreach ($contact->phones as $phone) {
					array_push( $phones , strtolower( $phone->phonenumber ) );
				}
			};
			$person['phones'] = $phones;

			$directskipResults = true;

			$directskipPeople[] = json_encode( $person );

		}
	}


	// Open People Search

	$opsSettings = get_field('open_people_search', 'option');
	
	if( strtotime( $opsSettings['authorization_token_expiration_date'] ) < time() ){
		open_people_search_auth( $opsSettings );
	}

	$openPeopleSearchArgs = [
		'firstName'	=> $req['first-name'],
		'lastName'	=> $req['last-name'],
	];

	if( $req['street-address'] ){ $openPeopleSearchArgs['address'] = $req['street-address']; }
	if( $req['city'] ){ $openPeopleSearchArgs['city'] = $req['city']; }
	if( $req['state'] && !empty($req['state']) ){ $openPeopleSearchArgs['state'] = $req['state']; }
	if( $req['zip'] ){ $openPeopleSearchArgs['zip'] = $req['zip']; }

	$openPeopleSearch = wp_remote_post(
		'https://api.openpeoplesearch.com/api/v1/Consumer/NameSearch',
		array(
			'timeout' => 1000,
            'httpversion' => '1.0',
            'sslverify' => false,
            'headers' => array(
                "accept" => "application/json",
                "Content-Type" => "application/json",
				'Authorization' => 'Bearer ' . $opsSettings['authorization_token']
            ),
			'body' => json_encode( $openPeopleSearchArgs )
		)
	);

	if( $openPeopleSearch['response']['code'] == 200 ){
	
		$responseBody = json_decode( $openPeopleSearch['body'] );
		$responseContacts = $responseBody->results;


		foreach ($responseContacts as $contact) {
			
			$person = [];
			$person['firstName'] = ucFirst( strtolower( $contact->firstName ) );
			$person['lastName'] = ucFirst( strtolower( $contact->lastName ) );

			$person['age'] = array();
			$person['dob'] = $contact->dob ? [$contact->dob] : [];
			$person['middleName'] = $contact->middleName ? [$contact->middleName] : [];

			$addresses = [];
			if( $contact->address ){
				$address = [];
				$streetInitial = strtolower( $contact->address );
				$streetInitial = str_replace( ' street', ' st' , $streetInitial );
				$streetInitial = str_replace( ' suite', ' ste' , $streetInitial );
				$streetInitial = str_replace( ' lane', ' ln' , $streetInitial );
				$streetInitial = str_replace( ' avenue', ' ave' , $streetInitial );
				$streetInitial = str_replace( '-', '' , $streetInitial );
				$address['street']	= ucwords( $streetInitial );
				$address['city']	= ucwords( strtolower( $contact->city ) );
				$address['state']	= strtoupper( $contact->state );
				$address['zip']		= $contact->zip;
				$address = json_encode( $address );
				array_push( $addresses , $address );	
			} else {
				$person['addresses'] = [];
			}

			$addresses = (array) $addresses;
			$person['addresses'] = $addresses;

			$person['phones'] = $contact->phone ? [$contact->phone] : [];
			$person['emails'] = $contact->email ? [strtolower( $contact->email )] : [];

			$openpeoplesearchResults = true;

			$openpeoplesearchPeople[] = json_encode( $person );

		}
	}

	$peopleResult = (array) array_unique ( array_merge( $directskipPeople , $openpeoplesearchPeople) );

	$peopleResult = (array) array_map( function($p){ return json_decode($p); } , $peopleResult );

	function addressArrayComparison( $val1, $val2){
		return strcmp($val1['value'], $val2['value']);

	}

	$peopleResult = array_values( $peopleResult );

	foreach ($peopleResult as $key => $person) {
		$curItem = (array) $person;
		$emails = $curItem['emails'];
		$phones = $curItem['phones'];
		$addresses = $curItem['addresses'];
		$dob = (array) $curItem['dob'];
		$age = (array) $curItem['age'];
 		$middleName = (array) $curItem['middleName'];
		foreach ($peopleResult as $newKey => $newPerson) {
			$comparableItem = (array) $newPerson;
			$newAddresses = $comparableItem['addresses'];
			$newEmails = $comparableItem['emails'];
			$newPhones = $comparableItem['phones'];
			$newDob = (array) $comparableItem['dob'];
			$newMiddleName = (array) $comparableItem['middleName'];
			$newAge = (array) $comparableItem['age'];
			if( $key !== $newKey ){
				if( 
					sizeof( $emails ) > 0 && array_intersect( $emails , $newEmails) ||
					sizeof( $phones ) > 0 && array_intersect( $phones , $newPhones) ||
					array_intersect( $addresses , $newAddresses) ||
					sizeof( $dob ) > 0 && array_intersect( $dob , $newDob) ||
					sizeof( $middleName ) > 0 && array_intersect( $middleName , $newMiddleName) ||
					sizeof( $age ) > 0 && array_intersect( $age , $newAge)
				) {
				$peopleResult[$newKey] = $comparableItem;
				$addresses = array_merge( $addresses , $newAddresses );
				$emails = array_merge( $emails , $newEmails );
				$phones = array_merge( $phones , $newPhones ); 
				$dob = array_merge( $dob , $newDob );
				$middleName = array_merge( $middleName , $newMiddleName );
				$age = array_merge( $age , $newAge );
				unset( $peopleResult[$newKey] );
				}
			}
		}
		$curItem['addresses'] = array_values( array_unique( $addresses ) );
		$curItem['emails'] = array_values( array_unique( $emails ) );
		$curItem['phones'] = array_values( array_unique( $phones ) );
		$curItem['dob'] = array_values( array_unique( $dob ) );
		$curItem['middleName'] = array_values( array_unique( $middleName ) );
		$curItem['age'] = array_values( array_unique( $age ) );
		sort( $curItem['addresses'] );
		sort( $curItem['emails'] );
		sort( $curItem['phones'] );
		sort( $curItem['dob'] );
		sort( $curItem['middleName'] );
		sort( $curItem['age'] );
		ksort( $curItem );
		$peopleResult[$key] = $curItem;
	}

	$peopleResult = array_map( function($p){ return json_encode($p); } , $peopleResult );
	$peopleResult = array_unique( $peopleResult );
	$peopleResult = array_map( function($p){ return json_decode($p); } , $peopleResult );

	foreach ($peopleResult as $result) {
		$result = (array) $result;
		if(
			empty( $result['emails'] ) && empty($result['phones'] ) &&
			empty( $result['dob'] ) && empty( $result['age'] )
		){ 
			foreach ($result['addresses'] as $address) {
				$addressArr = (array) json_decode( $address );
				if( strtolower( $addressArr['street']) != 'address not available' ){
					$additionalAddresses[] = json_decode( $address );
				}
			}
		} else if( empty( $result['emails'] ) && empty($result['phones'] ) ){
			$finalPeopleWithoutContacts[] = $result;
		} else {
			$finalPeople[] = $result;
		}

	}

	$peopleCount = sizeof( $finalPeople );
	$peopleWithoutAddressesCount = sizeof( $finalPeopleWithoutContacts );
	$totalPeopleCount = $peopleCount + $peopleWithoutAddressesCount;
	$addressesCount = sizeof( $additionalAddresses );

	foreach ($finalPeople as $person) {
		$person = (array) $person;
		$addressesCount += sizeof( $person['addresses'] );
		$phoneNumbersCount += sizeof( $person['phones'] );
	}
	foreach ($finalPeopleWithoutContacts as $person) {
		$person = (array) $person;
		$addressesCount += sizeof( $person['addresses'] );
	}
	

	if( !$totalPeopleCount && !$addressesCount ){
		$searchStatus = 'failed';
	} else if( !$peopleCount ){
		$searchStatus = 'partial';
	} else {
		$searchStatus = 'success';
	}

	$responsePost = wp_insert_post(
		wp_slash(
			array(
				'post_type' => 'search',
				'post_author' => $req['author-id'],
				'post_title' => $req['first-name'] . ' ' . $req['last-name'],
				'post_status' => 'publish',
				'meta_input' => array(
					'people' => json_encode($finalPeople),
					'additionalAddresses' => json_encode($additionalAddresses),
					'finalPeopleWithoutContacts' => json_encode($finalPeopleWithoutContacts),
					'peopleCount' => $peopleCount,
					'peopleWithoutAddressesCount' => $peopleWithoutAddressesCount,
					'totalPeopleCount' => $totalPeopleCount,
					'addressesCount' => $addressesCount,
					'phoneNumbersCount' => $phoneNumbersCount,
					'searchStatus' => $searchStatus,
					'searchType' => $response['searchType'],
					'searchPrice' => $searchPrice,
				)
			)
		)
	);

	if( !is_wp_error( $responsePost ) ){
		$response['status'] = ['success'];
		$response['people'] = $finalPeople;
		$response['finalPeopleWithoutContacts'] = $finalPeopleWithoutContacts;
		$response['additionalAddresses'] = $additionalAddresses;
		$response['postUrl'] = get_permalink( $responsePost );
	} else {
		$response['status'] = ['error'];
		$response['people'] = $finalPeople;
		$response['finalPeopleWithoutContacts'] = $finalPeopleWithoutContacts;
		$response['additionalAddresses'] = $additionalAddresses;
		$response['post'] = $responsePost;
	}

	$response['status'] = ['success'];
	$response['people'] = $finalPeople;
	$response['finalPeopleWithoutContacts'] = $finalPeopleWithoutContacts;
	$response['additionalAddresses'] = $additionalAddresses;
	$response['peopleCount'] = $peopleCount;
	$response['peopleWithoutAddressesCount'] = $peopleWithoutAddressesCount;
	$response['totalPeopleCount'] = $totalPeopleCount;
	$response['addressesCount'] = $addressesCount;
	$response['phoneNumbersCount'] = $phoneNumbersCount;
	$response['searchStatus'] = $searchStatus;
	$response['newWalletBalance'] = $newWalletBalance;
	$response['searchPrice'] = $searchPrice;
	$response['wallet'] = woo_wallet( 1);

	return json_encode( $response );

}