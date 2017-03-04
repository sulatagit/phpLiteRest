# phpLiteRest

**phpLiteRest** is a PHP + SQLite3 RESTful API, developed by [Sulata iSoft](http://www.sulata.com.pk) - [www.sulata.com.pk](http://www.sulata.com.pk)

GitHub Download Link: [https://github.com/sulatagit/phpLiteRest](https://github.com/sulatagit/phpLiteRest)

It has been kept as simple as possible to use and supports SQL input. The output is a JSON array.

The only thing you need to set in the script is your database configurations and provide an API Key. The API Key should be at least 32 characters.

To make it easy to use and understand, all requests need to be sent as POST and the parameters accepted by phpLiteRest are:

* sql
* api_key
* debug

The POST request 'sql' should carry a valid SQL.

The POST request 'api_key' is the API Key required to perform any action.

The POST request 'debug' is optional and if sent to phpLiteRest, it will display SQLite errors and error numbers as well. By default, debug is off but the parameter 'debug' can be switched on by sending parameter value as 1 or TRUE. Only in the case of duplication error, error number is returned even if the 'debug' is off.

This is a single page script but comes with sample codes in the 'examples' folder. There is no need to upload the 'examples' folder to the server.

## Examples
Below are some examples to understand phpLiteRest functionality using PHP and CURL.

### SELECT records with 'debug' set to TRUE

	$url = 'http://localhost/phpLiteRest/'; //Provide API URL
	$fields = array(
	    'sql' => 'SELECT * FROM countries',
	    'api_key' => '5fs37Jg5UrvwhvBtEpTufU9yWY47YZx6',
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

### SELECT records without debug

	$url = 'http://localhost/phpLiteRest/'; //Provide API URL
	$fields = array(
	    'sql' => 'SELECT * FROM countries',
	    'api_key' => '5fs37Jg5UrvwhvBtEpTufU9yWY47YZx6'
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

### INSERT a record

	$url = 'http://localhost/phpLiteRest/'; //Provide API URL
	$fields = array(
	    'sql' => "INSERT INTO countries (name) VALUES ('Pakistan')",
	    'api_key' => '5fs37Jg5UrvwhvBtEpTufU9yWY47YZx6',
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
	
### UPDATE a record

	$url = 'http://localhost/phpLiteRest/'; //Provide API URL
	$fields = array(
	    'sql' => "UPDATE countries SET name='Jamica' WHERE id='10'",
	    'api_key' => '5fs37Jg5UrvwhvBtEpTufU9yWY47YZx6',
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

### DELETE a record

	$url = 'http://localhost/phpLiteRest/'; //Provide API URL
	$fields = array(
	    'sql' => "DELETE FROM countries WHERE id='1'",
	    'api_key' => '5fs37Jg5UrvwhvBtEpTufU9yWY47YZx6',
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




