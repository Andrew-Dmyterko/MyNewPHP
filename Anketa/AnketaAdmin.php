<?php
session_start();

use Api\AdminFunction;
//require_once 'db.php';

// check the session status
// if sessions are enabled, but none exists
// start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

spl_autoload_register(function ($class) {
    $file_name = str_replace('\\', '/', $class) . '.php';
    if (file_exists($file_name)) {
        require_once($file_name);
    } else {
        echo "file does not exist!";
    }
});

require_once 'db.php';

class AnketaAdmin
{
    // inactive timeout for logout
    private static $timeout = 60;

// тут будут свойства класса (имя админа ид админа....)


// нужно подумать надо ли оставлять статические методи или переделать на обекты класса

    public static function getExistsTables($user = null) // потом будем передавать пользователя (пока незнаю нужно ли это)
    {
        global $db;

        // смотрим все таблицы в базе $db_name
        $sql = "show tables;";
        $select = $db->query($sql);

        $tables = $select->fetchAll(PDO::FETCH_ASSOC);

        return $tables;
    }

    public static function tableView($table, $user = null) // потом будем передавать пользователя (пока незнаю нужно ли это)
    {
        global $db;

        // смотрим все строки таблицы
        $sql = "select * from ".$table;

        $select = $db->prepare($sql);
        $select->execute();

        $tables = $select->fetchAll(PDO::FETCH_ASSOC);

        return $tables;
    }

    /* Get column names */
    public static function getHead($table)
    {
        global $db;

        $query = $db->prepare("DESCRIBE ".$table);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function getFieldById($table, $id)
    {
        global $db;

        $sql = "select * from ".$table;
        $sql .= " where id = ?";

        $query = $db->prepare($sql);
        $params = [$id];
        $query->execute($params);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function login($user, $password)
    {
        global $db;

        $login = trim($user);
        $passwd = trim($password);

        // check if the session is established
        // this means that the user is authorized
        if (!isset($_SESSION['user_session_id'])) {

            // if session does not established
            // it means that the user must authorized
            // we check that the login and password is not null
            if (!empty($login) && !empty($passwd)) {

                $sql = "select id, login, password, user_name from passwd where login = :login ";
                $params = [':login' => $login];

                $select = $db->prepare($sql);
                $select->execute($params);

                $user = $select->fetch(PDO::FETCH_OBJ);

                // if users is ok we verify password
                if ($user) {

                    if (password_verify($passwd, $user->password)) {

                        // password ok user ok
                        // set user SESSION
                        $_SESSION['user_session_id'] = session_id();
                        $_SESSION['user_id'] = $user->id;
                        $_SESSION['userName'] = $user->user_name;
                        $_SESSION['user'] = $user->login;
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
                AdminFunction::logout('Sorry!! Logout!!<br>Expired session time.');

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

//    // logout from admin area
//    public static function logout()
//    {
//        if (isset($error)) {
//
//            //<<<-----Правильное уничтожение сессии ----->>>
//            $_SESSION = []; // чистим суперглобальную переменную
//            if (isset($_COOKIE[session_name()])) {
//                setcookie(seession_name(),'',time()-3600,'/');
//            }
//
//            session_unset();
////    session_destroy();
//
//            header('Location: index.php');
//            exit;
//        }
//    }
}

$login = (isset($_POST['login'])) ? $_POST['login'] : "";
$password = (isset($_POST['password'])) ? $_POST['password'] : "";

echo $login;
echo $password;
var_dump($_SESSION);
echo time();


if (AnketaAdmin::login($login,$password)) {

    $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $url = explode('?', $url);
    $url = $url[0];

    //echo $url;


    //$pwd = password_hash("123", PASSWORD_DEFAULT);
    //
    //var_dump(password_verify ( "123456" , '$2y$10$yNsClrA/aqH4ImTWZp7nbujE05dHpYwFVGJKYJgY2tnzeINcN9cpK'));
    //
    //echo "<hr>";
    //echo $pwd;
    //echo "<hr>";


    ?>

    <?php // вывод всех таблиц в базе
    if (empty($_GET)) :
        $tables = AnketaAdmin::getExistsTables();

        ?>
        <h3>Таблицы базы данных <?= $db_name ?></h3>
        <table border="1">
            <tr>
                <th>Таблицы</th>
                <th>Действия с таблицой</th>
            </tr>
            <?php
            foreach ($tables as $kay => $val) {
                $table = $val[array_keys($val)[0]];
                echo "<tr><td>" . $table . "</td><td>Удалить<a href=\"$url?view=$table\">Просмотр</a><a href=\"$url?edit=$table\">Изменить</a></td></tr>";
            }
            ?>
        </table>
        <a href="index.php">to main page</a>
    <?php
    endif;
    ?>

    <?php // просмотр view
    if (isset($_GET['view'])) :
        $table = $_GET['view'];

        $headTable = AnketaAdmin::getHead($table);
        $dataTable = AnketaAdmin::tableView($table); ?>

        <h3>Данные таблицы <?= $table ?></h3>
        <table border="1">

            <tr>
                <?php
                foreach ($headTable as $kay => $val) : ?>
                    <td><?= $val ?></td>
                <?php endforeach; ?>
            </tr>
            <?php
            foreach ($dataTable as $kay => $val) {
                echo "<tr>";
                foreach ($headTable as $head) echo "<td>" . $val[$head] . "</td>";
                echo "<tr>";
            }
            ?>
        </table>

        <a href=<?= $url ?>>Назад</a>

    <?php
    endif; ?>

    <?php // редактирование edit
    if (isset($_GET['edit'])) :
        $table = $_GET['edit'];

        $headTable = AnketaAdmin::getHead($table);
        $dataTable = AnketaAdmin::tableView($table); ?>

        <h3>Данные таблицы <?= $table ?></h3>
        <table border="1">

            <tr>
                <?php
                foreach ($headTable as $kay => $val) : ?>
                    <th><?= $val ?></th>
                <?php endforeach; ?>
                <th>Действие с записью</th>
            </tr>
            <?php
            foreach ($dataTable as $kay => $val) {
                echo "<tr>";
                foreach ($headTable as $head) echo "<td>" . $val[$head] . "</td>";
                echo "<td>Удалить<a href=\"$url?edit=$table&id=" . $val['id'] . "\">Изменить</td>";
                echo "</tr>";
            }
            ?>
        </table>

        <a href=<?= $url ?>>Назад</a>

    <?php
    endif; ?>

    <?php
    if (isset($_GET['edit']) && isset($_GET['id'])) :
        $table = $_GET['edit'];
        $id = $_GET['id'];

        $headTable = AnketaAdmin::getHead($table);
        $dataField = AnketaAdmin::getFieldById($table, $id);

        ?>

        <h3>Изменить запись №<?= $id ?> таблица <?= $table ?></h3>
        <form action="" method="POST" enctype="multipart/form-data">
            <table border="1">
                <?php foreach ($headTable as $kay => $val) : ?>
                    <tr>
                        <td><?= $val ?></td>
                        <td>
                            <?php if ($val != 'id') : ?>
                                <input type="text" name="<?= $val ?>" value="<?= $dataField[$val] ?>">
                            <?php else : ?>
                                <input type="text" name="<?= $val ?>" value="<?= $dataField[$val] ?>" readonly>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <input type="submit" name="edit" value="write">
        </form>
        <a href=<?= $url ?>>Назад</a>

    <?php
    endif;
}
else header('Location: index.php');
?>