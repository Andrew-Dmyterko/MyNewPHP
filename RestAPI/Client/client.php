<?php
/**
 * example cURL php extends for send POST, DELETE, PATCH http requests
 */

// json format
header("Content-Type: application/json");

//goto post;
//header('Location: http://localhost/MyNewPHP/RestAPI/index.php/posts/');


//curl PATCH
$data = '{
    "title": "spaceX",
    "body": "falcon9"
}';

$url = "http://localhost/MyNewPHP/RestAPI/index.php/posts/16";
$headers = array('Content-Type: application/json');
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);

//  CURLOPT_RETURNTRANSFER 	true для возврата результата передачи
//  в качестве строки из curl_exec() вместо прямого вывода в браузер.
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($curl);
// return response from server
var_dump($response);
curl_close($curl);

die;


//curl DELETE
$url = "http://localhost/MyNewPHP/RestAPI/index.php/posts/9";
//$headers = array('Content-Type: application/json');
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
$response = curl_exec($curl);
curl_close($curl);


//post:

// curl POST
$array = array(
    'title'   => 'admin',
    'body' => '1234'
);

$ch = curl_init('http://localhost/MyNewPHP/RestAPI/index.php/posts/');

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $array);

// Или предать массив строкой:
// curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($array, '', '&'));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);

$response = curl_exec($ch);
curl_close($ch);

echo ($response);