<?php

namespace Api;

//// if sessions are enabled, but none exists
//// start the session
//if (session_status() == PHP_SESSION_NONE) {
//    session_start();
//}

class AdminFunction
{

    public static function logout($messages = null)
    {
        //<<<-----Правильное уничтожение сессии ----->>>
        $_SESSION = []; // чистим суперглобальную переменную
//        if (isset($_COOKIE[session_name()])) {
//            setcookie(seession_name(),'',time()-3600,'/');
//        }

        session_unset();
        session_destroy();

        $_SESSION['Messages'] = $messages;

        header('Location: index.php');
        exit;
    }
}
