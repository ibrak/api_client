<?php
/// Include iBrakAPI.php
/// Simple library. Curl require
include('./iBrakAPI.php');

// Create minimal json parameter
// Set our iBrak API User and Password 
$json = array();
$json["user"] = "demo-api-user";
$json["passwd"] = "demo-api-password";

// Display minimal json parameter and call Hello
echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
echo "\n================ START =======";
iBrakAPI_action($json, "hello");

// List services
iBrakAPI_action($json, "list");
return;
// Delete all serices
//iBrakAPI_Clear($json);

// Create Flickrstream sample
$json1 = $json;
$json1["service"] = "My1stService";
$json1["type"] = "FlickrStream.1";
$json1["name"] = "Explore";
$json1["description"] = "Architecture and Buildings";
$json1["flickr-nsid"] = "59549338@N04";
$json1["flickr-set"] = "72157627602086045";
//iBrakAPI_action($json1, "create");
iBrakAPI_action($json1, "update");

// Create the 1rst PDFReader
$json2 = $json;
$json2["service"] = "My2ndService";
$json2["type"] = "PDFReader.1";
$json2["name"] = "Wrong Name";
$json2["description"] = "no description";
//iBrakAPI_action($json2, "create", "@./docs/jet-tours.pdf");
iBrakAPI_action($json2, "update");

// Modify My2ndService and add a sammary
$json3 = $json2;
$json3["name"] = "Jet tours";
$json3["description"] = "Catalogue Eté 2013";
$json3["summary"] = json_decode(file_get_contents('./docs/jet-tours.json'));
iBrakAPI_action($json3, "update");

// Create another PDFReader. Add summary.
$json4 = $json;
$json4["service"] = "My3rdService";
$json4["type"] = "PDFReader.1";
$json4["name"] = "Jet tours";
$json4["description"] = "Catalogue Spa et Thalasso";
$json4["summary"] = json_decode(file_get_contents('./docs/jet-tours-spas-et-thalasso.json'));
//iBrakAPI_action($json4, "create", "@./docs/jet-tours-spas-et-thalasso.pdf");
iBrakAPI_action($json4, "update");

$json5 = $json;
$json5["service"] = "CatalogueCrisalidi";
$json5["type"] = "PDFReader.1";
$json5["name"] = "Crisalidi Design";
$json5["description"] = "Catalogue Crisalidi 2013";
//iBrakAPI_action($json5, "create", "@./docs/crisalidi.pdf");
iBrakAPI_action($json5, "update");

// List all Sercices
iBrakAPI_action($json, "list");
echo "\n \n";

?>
