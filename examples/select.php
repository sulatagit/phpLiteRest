<?php

/* phpLiteRest
 * An example to fetch records using CURL
 */

$url = 'http://localhost/phpLiteRest/'; //Provide API URL
$fields = array(
    'sql' => 'SELECT * FROM countries',
    'api_key' => 'YOUR_API_KEY',
    'debug' => 'TRUE'
);

//url-ify the data for the POST
foreach ($fields as $key => $value) {
    $fields_string .= $key . '=' . $value . '&';
}
rtrim($fields_string, '&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, count($fields));
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);

//print output
echo $result;
