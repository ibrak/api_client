<?php
// this PHP script require curl and json method
// Check if your PHP installation is ok. 
// if not, you must use PHP 5 >= 5.2.0, PECL json >= 1.2.0 and curl extension
// Use in command line  : 
// PROMPT$ /path/to/php ./tester.php

if( !function_exists("curl_init") &&
	!function_exists("curl_setopt") &&
	!function_exists("curl_exec") &&
	!function_exists("curl_close") &&
	!function_exists("json_encode")) {
	echo 'This script need curl extension and PHP 5.2.0 ';	
	exit;
}

// This script use curl to connect iBrak API.
// We wrap curl in this simple function to call iBrak methods URL
function iBrakAPI_CallMethode($methodName, $postData){
	// create curl resource
	$ch = curl_init();
	
	// set url for iBrak API Methode
	// we start with a 'hello' methode
	curl_setopt($ch, CURLOPT_URL, "https://api.ibrak.com/" . $methodName);	
	// curl_setopt($ch, CURLOPT_URL, "http://api.ibrak.com/" . $methode);	
	// use post request 
	curl_setopt($ch, CURLOPT_POST, TRUE);
	// set postdata to curl
	curl_setopt($ch, CURLOPT_POSTFIELDS,  $postData);
	// quiet mode
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	// $response contain iBrak API Method response
	$response = curl_exec($ch);

	// close curl resource to free up system resources
	curl_close($ch);      

	return $response;
}

//
// We are ready to test iBrak API
//

// First, we need to store parameters as json
$json = array();

// Authentication to iBrak API
// Set your iBrak username and iBrak password
// Send us an email to contact@ibrak.com to get yours.
$json['user'] = 'demo-api-user';
$json['passwd'] = 'demo-api-password';

// 1 - Say Hello to iBrak
function Hello_iBrak($json) {
	// Just call iBrak API hello methode
	echo iBrakAPI_CallMethode('hello', array(
		'json' => json_encode($json)
	));
}
Hello_iBrak($json);

// 2 - Create FlickrStream service
function Create_FlickrStream($json) {
	// chose a unique ID for your service
	// this unique identifier will be used to updata, start and stop your service
	$json["service"] = "FlickrStream-No-01-for-example";
	
	// Here we specify the type of service we want to create
	$json["type"] = 'FlickrStream.1';
	
	// Set the flickr nsid
	$json["flickr-nsid"] = "48868409@N07"; // Paisley patches (coming and going)
	
	// Set the flickr photoset id
	$json["flickr-set"] = "72157624701632749"; // Explored & explore front page
	
	// Set the service name and description
	$json["name"] = "Paisley's flickrstream by iBrak.com";
	$json["description"] = "Explored and explore front page by Paisley patches (coming and going)";
	
	// Call Create methode 
	echo iBrakAPI_CallMethode('create', array(
		'json' => json_encode($json)
	));
}
//Create_FlickrStream($json);

// 2 - List all services
function List_all_services($json) {
	// Just call iBrak API List methode
	echo iBrakAPI_CallMethode('list', array(
		'json' => json_encode($json)
	));
}
//List_all_services($json);

// 3 - Delete my FlickrStream service
function Delete_my_FlickrStream_service($json) {
	// set the service unique identifier you want to delete
	$json["service"] = "FlickrStream-No-01-for-example";
	
	// then, call iBrak API delete methode
	echo iBrakAPI_CallMethode('delete', array(
		'json' => json_encode($json)
	));
}
//Delete_my_FlickrStream_service($json);

// 4 - Create PDFReader service
function Create_PDFReader($json){
	// chose a unique ID for your service
	// this unique identifier will be used to update. start and stop your service
	$json["service"] = "PDFReader-20130225-1";
	
	// Here we specify the type of service we want to create
	$json["type"] = 'PDFReader.1';
	
	// Set the service name and description
	$json["name"] = "My Fist iBrak PDFReader";
	$json["description"] = "No description for the moment...";
	
	// Path of my local PDF
	$local_pdf_file_path = "./docs/mydocument.pdf";
	
	// Call Create methode 
	echo iBrakAPI_CallMethode('create', array(
		'json' => json_encode($json),
		'filedata' => '@' . $local_pdf_file_path
	));
}
//rCreate_PDFReader($json);

// 5 - Update PDFReader service
function Update_PDDFReader($json) {
	$json["service"] = "PDFReader-20130225-1";
	
	$json["name"] = "bou";
	$json["description"] = "";
	$json["summary"] = "";
	
	// Call Update methode 
	echo iBrakAPI_CallMethode('update', array(
		'json' => json_encode($json)
	));

}
//Update_PDDFReader($json);

// 5 - Delete my PDFReader service
function Delete_my_PDFReader_service($json) {
	// set the service unique identifier you want to delete
	$json["service"] = "PDFReader-No-01-for-example";
	
	// then, call iBrak API delete methode
	echo iBrakAPI_CallMethode('delete', array(
		'json' => json_encode($json)
	));
}
//Delete_my_PDFReader_service($json);

?>