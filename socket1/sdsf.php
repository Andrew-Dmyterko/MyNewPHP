<?php

set_time_limit(0);
define('PORT', '8099');

require_once __DIR__ . '/classes.php';

$connect = new Connect();

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);
socket_bind($socket, 0, PORT);

socket_listen($socket);

$clientSocketArray = [$socket];

while(true){

$newSocketArray = $clientSocketArray;
$nullA = [];
socket_select($newSocketArray, $nullA, $nullA, 0, 10);

if(in_array($socket, $newSocketArray)){

$newSocket = socket_accept($socket);
$clientSocketArray[] = $newSocket;
$header = socket_read($newSocket, 1024);
$connect->sendHeaders($header, $newSocket);

socket_getpeername($newSocket, $client_ip);
$createMessageConnect = $connect->createMessageConnect($client_ip);
$connect->sendMessage($createMessageConnect, $clientSocketArray);

$newSocketArrayIndex = array_search($socket, $newSocketArray);
unset($newSocketArray[$newSocketArrayIndex]);
}

foreach($newSocketArray as $newSocketArrayResourse){

//1
while(socket_recv($newSocketArrayResourse, $socketDataBufer, 1024, 0) >= 1){
$socketMessage = $connect->unseal($socketDataBufer);
$messageArr = json_decode($socketMessage);

$userClient = $messageArr->user;
$messageClient = $messageArr->text;
$pKey = $messageArr->pKey;

if($userClient && $messageClient && $pKey){
$chatMessage = $connect->createChatMessage($userClient, $messageClient, $pKey);
$connect->sendMessage($chatMessage, $clientSocketArray);
}else if($pKey){

}

break 2;
}

//2
$socketData = @socket_read($newSocketArrayResourse, 1024, PHP_NORMAL_READ);
if($socketData === false){
socket_getpeername($newSocketArrayResourse, $client_ip);
$disconnect = $connect->createMessageDisconnect($client_ip);
$connect->sendMessage($disconnect, $clientSocketArray);

$newSocketArrayIndex = array_search($newSocketArrayResourse, $clientSocketArray);
unset($clientSocketArray[$newSocketArrayIndex]);
}

}

}

socket_close($socket);
