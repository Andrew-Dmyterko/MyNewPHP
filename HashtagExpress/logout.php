<?php


//require_once "Classes/ExpressAdmin.php";

//use Api\AdminFunction;
//require_once 'db.php';

// check the session status
// if sessions are enabled, but none exists
// start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use Classes\ExpressAdmin;


spl_autoload_register(function ($class) {
//    echo $class;
    $file_name = str_replace('\\', '/', $class) . '.php';
    if (file_exists($file_name)) {
        require_once($file_name);
    } else {
        echo "file does not exist!";
    }
});

ExpressAdmin::logout();







