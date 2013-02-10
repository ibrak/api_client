<?php

function preparePostFields($array) {
  $params = array();

  foreach ($array as $key => $value) {
    $params[] = $key . '=' . urlencode($value);
  }

  return implode('&', $params);
}

function do_post_request($url, $json, $filedata = null, $optional_headers = null)
{
echo "\n Curl ".$url."\n";
$jsonString = json_encode($json, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
if ($filedata != null)
  return shell_exec("curl -F 'json=".$jsonString."' -F filedata='".$filedata."' ".$url);
return shell_exec("curl -F 'json=".$jsonString."' ".$url);
}

function iBrakAPI_action($json, $action, $filedata = null) {
        if ($filedata == null) {
                $responseStr = do_post_request("https://api.ibrak.com/".$action, $json);
        }
        else {
                $responseStr = do_post_request("https://api.ibrak.com/".$action, $json, $filedata);
        }
        $responseJson = json_decode($responseStr);

        if (isset($responseJson)){
                echo ">> " . $action . "\n";
                echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                echo "\n";
                echo json_encode($responseJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                echo "\n";
        }
}

function iBrakAPI_Clear($json){
        $responseStr = do_post_request("https://api.ibrak.com/list", $json);
        $list = json_decode($responseStr);

        for($i=0;$i<count($list);$i++){
                $jsonDelete = $json;
                $jsonDelete["service"] = $list[$i]->service;
                iBrakAPI_action($jsonDelete, "delete");
        }
}

?>
