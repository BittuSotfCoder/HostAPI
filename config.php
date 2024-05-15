<?php
$api_key=$_SERVER["HTTP_API_KEY"] ?? "";
$Valid_api_secret= "ndeweidjwekdiwwednddw";
if($api_key!=$Valid_api_secret){
        header("HTTP/1.1 401 Unauthorized");
        $response['message'] = 'Invalid API_KEY';
        echo json_encode($response);
        die();
}
