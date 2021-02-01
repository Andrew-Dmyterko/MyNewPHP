<?php

namespace Classes;

//// check the session status
//// if sessions are enabled, but none exists
//// start the session
//if (session_status() == PHP_SESSION_NONE) {
//    session_start();
//}
//
//require_once "db/db.php";


class ExpressAdmin {

// inactive timeout for logout sec
    private static $timeout = 600;

    public static function login($user, $password)
    {
        global $staff;
        global $access;

        $login = trim($user);
        $passwd = trim($password);

        // check if the session is established
        // this means that the user is authorized
        if (!isset($_SESSION['user_session_id'])) {

            // if session does not established
            // it means that the user must authorized
            // we check that the login and password is not null
            if (!empty($login) && !empty($passwd)) {

                $user = false;

                foreach ($staff as $id => $userArr) {

                    if ($userArr['login'] === $login && $userArr['pass'] === $passwd)
                        $user = $userArr;

                }

                // if users is ok we verify password
                if ($user) {
                    if ($login === $user['login'] && $passwd === $user['pass'] ) {

                        // password ok user ok
                        // set user SESSION
                        $_SESSION['user_session_id'] = session_id();
                        $_SESSION['user'] = $user['login'];
                        $_SESSION['userName'] = $user['name'];
                        $_SESSION['group'] = $user['group'];
                        $_SESSION['point'] = $user['point'];
                        $_SESSION['address'] = $user['address'];
                        $_SESSION['access_page'] = array_merge($access['all'],$access[$user['group']]);
                        $_SESSION['time'] = time();

                        // user session is set return true
                        return true;
                    } else {
                        // if password incorrect
                        $_SESSION['Messages'] = 'Sorry!! Not logged in!!<br>Invalid username or password!!';
                        return false;
                    }

                } else {
                    // if login does not exists
                    $_SESSION['Messages'] = 'Sorry!! Not logged in!!<br>Invalid username or password!!';
                    return false;
                }

            } else {
                // if login or password is null
                $_SESSION['Messages'] = 'Sorry!! Not logged in!!<br>Invalid username or password!!<br>Login or password is empty.';
                return false;
            }

        } else {
            // check that the session time is not expired
            if (isset($_SESSION['user_session_id']) && (time() - $_SESSION['time'] >= self::$timeout) ) {

                //
//                $_SESSION['Messages'] = 'Sorry!! Logout!!<br>Expired session time.';
                self::logout('Sorry!! Logout!!<br>Expired session time.');

                // session time exipred return false
                return false;
            } else {
                // session time is not expired
                // update $_SESSION['time']
                $_SESSION['time'] = time();
            }

// sessions is established
// this means that the user is authorized return true
            return true;
        }
    }
// Check for user right and session login
    public static function grant()
    {
        $page = trim(basename($_SERVER['SCRIPT_FILENAME'].PHP_EOL));

        // check if the session is established
        // this means that the user is authorized
        if (isset($_SESSION['user_session_id'])) {


//            echo $page."----";
            if (!in_array($page, $_SESSION['access_page'])) self::logOut('Sorry!! Access Error!! Logout!!<br>Is not your page.');

            // check that the session time is not expired
            if (isset($_SESSION['user_session_id']) && (time() - $_SESSION['time'] >= self::$timeout) ) {

                //
//                $_SESSION['Messages'] = 'Sorry!! Logout!!<br>Expired session time.';
                self::logOut('Sorry!! Logout!!<br>Expired session time.');

                // session time exipred return false
                return false;
            } else {
                // session time is not expired
                // update $_SESSION['time']
                $_SESSION['time'] = time();
            }

            // sessions is established
            // this means that the user is authorized return true
            return true;
        } else {
            if($page !== 'index.php') self::logOut('Sorry!!<br>You are not authorize.');
        }
    }

    public static function logOut($messages = null)
    {
        //<<<-----Правильное уничтожение сессии ----->>>
        $_SESSION = []; // чистим суперглобальную переменную

        session_unset();
        session_destroy();

        // check the session status
        // if sessions are enabled, but none exists
       // start the session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['Messages'] = $messages;

        header('Location: index.php');
        exit;
    }

    public static function goStartUserPage()
    {
        if ($_SESSION['group'] == 'oper') header('Location: operator.php');
        if ($_SESSION['group'] == 'sklad') header('Location: store.php');
        if ($_SESSION['group'] == 'manager') header('Location: manager.php');
        if (isset($_SESSION['user_session_id'])) {
        } else self::logOut("Сессии нету досвидос!!!");

    }
}


