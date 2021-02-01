<?php

use Classes\Db;
use Classes\Rest;

// __autoload for used class
spl_autoload_register(function ($class) {
    $file_name = str_replace('\\', '/', $class) . '.php';
    if (file_exists($file_name)) {
        require_once($file_name);
    } else {
        echo "file does not exist!";
    }
});

// new Db object
$db = new Db();
// connect to databases
$db->connect();
// new Rest object with insert database connection property
$rest = new Rest($db->connection);

// json format
header("Content-Type: application/json");

if (isset($_SERVER["REQUEST_METHOD"]) && !empty($_SERVER["REQUEST_METHOD"])) {
    $requestMethod = $_SERVER["REQUEST_METHOD"];

    if (isset($_SERVER['PATH_INFO'])) {
        $url = $_SERVER['PATH_INFO'];

        switch ($requestMethod) {
            // if GET method
            case "GET":

//        var_dump(json_decode($rest->get($url),true));
                echo $rest->get($url);

                break;

            // if POST method
            case "POST":

                if (isset($_POST['title']) && isset($_POST['body'])) {
                    $data = $_POST;
                    echo $rest->post($url, $data);
                } else echo "Error!!! POST parameter is missing!!!";

                break;

            // if DELETE method
            case "DELETE":

                echo $rest->delete($url);

                break;

            // if PATCH method
            case "PATCH":

                echo $rest->patch($url);
//            var_dump(json_decode($rest->patch($url), true));

                break;

            default:
                echo "Unknown Request method!!";
        }

    }
    else echo ("Error!!! No 'Url'!!!");

//    $rest = new Rest($db->connection);
} else echo("Error!!! No 'REQUEST_METHOD'!!!");


?>