<?php 

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