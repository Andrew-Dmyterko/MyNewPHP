<?php

$null = NULL;
$client_sockets = [];

error_reporting(E_ALL);

/* Позволяет скрипту ожидать соединения бесконечно. */
set_time_limit(0);

/* Включает скрытое очищение вывода так, что мы видим данные
 * как только они появляются. */
ob_implicit_flush();

$address = "192.168.1.100";
$port = 10000;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);


if( !$socket ) exit( socket_strerror( socket_last_error() ) );
else echo 'Socket_created!'."\n";

if( !socket_bind($socket, $address, $port) ) exit( socket_strerror( socket_last_error() ) );
else echo 'Socket_binded!'."\n";

if( !socket_listen($socket, 10) ) exit( socket_strerror( socket_last_error() ) );
else echo 'Socket_listen!'."\n";


$clientSocketArray = [$socket];


$newSocketArray = $clientSocketArray;


while(true) {

//    $newSocketArray = $clientSocketArray;

    socket_select($newSocketArray,$null,$null,0,10);

    /* Изменился ли главный сокет (новое подключение) */
    if(in_array($socket, $newSocketArray))
    {
        $client_socket = "";
        $client_socket = socket_accept($socket);
        $client_sockets[] = $client_socket;
        socket_write($client_socket, "Подключение установлено!!!\n", 1024);

    }


    /* Цикл по всем клиентам с проверкой изменений в каждом из них */
    foreach ($client_sockets as $key => $client) {
        /* Новые данные в клиентском сокете? Прочитать и ответить */
        if(in_array($client, $newSocketArray)) {
            $input = socket_read($client, 1024);
            echo $input."\n";

            if($input === false) {
                socket_shutdown($client);
                unset($client_sockets[$key]);
            }
            else {
                $input = trim($input);

                if (!@socket_write($client, "Вы сказали: $input\n") ) {
                    socket_close($client);
                    unset ( $client_sockets[$key] ) ;
                }
            }
            if($input == 'exit') {
                socket_shutdown($socket);
                break 2;
            }

        }

    }

//    var_dump($client_sockets);
//    var_dump($clientSocketArray);

    $clientSocketArray = $client_sockets;
    $clientSocketArray[] = $socket;
    $newSocketArray = $clientSocketArray;

    var_dump($newSocketArray);

}


//die;







//$connect = socket_accept($socket);
//
//do {
//    $result = socket_read($connect, 1024, PHP_NORMAL_READ);
//
//    echo 'Common data: ' . $result . "\n";
//
//    socket_write($connect, 'You sending me: ' . $result . "\n");
//
//    if (trim($result) == 'exit') {
//        echo "close socket!!!!". "\n";
//        socket_close($connect);
//
//        break;
//    }
//} while (true);
//
//echo "exit server!!!!". "\n";
//
//socket_close($socket);
//
//?>
