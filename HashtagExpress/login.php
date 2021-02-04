<?php

// check the session status
// if sessions are enabled, but none exists
// start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use Classes\ExpressAdmin;

// __autoload for used class
spl_autoload_register(function ($class) {
    $file_name = str_replace('\\', '/', $class) . '.php';
    if (file_exists($file_name)) {
        require_once($file_name);
    } else {
        echo "file does not exist!";
    }
});

require_once "db/db.php";
//require_once "Classes/ExpressAdmin.php";

$login = (isset($_POST['login'])) ? $_POST['login'] : "";
$password = (isset($_POST['password'])) ? $_POST['password'] : "";

//echo $login;
//echo $password;
//var_dump($_SESSION);
//echo time();


if(ExpressAdmin::login($login, $password)) {
    ExpressAdmin::grant();
ExpressAdmin::goStartUserPage();


} else header('Location: index.php');;

echo "<hr>";

//echo $login;
//echo $password;
//var_dump($_SESSION);
//echo time();

