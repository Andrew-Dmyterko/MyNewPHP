<?php
session_start();

// check the session status
// if sessions are enabled, but none exists
// start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use Classes\ExpressAdmin;
use Classes\ExpressPackage;
use Classes\ExpressDb;
require_once "db/db.php";


// __autoload for used class
spl_autoload_register(function ($class) {
    $file_name = str_replace('\\', '/', $class) . '.php';
    if (file_exists($file_name)) {
        require_once($file_name);
    } else {
        echo "file does not exist!";
    }
});

//$_SESSION['Messages'] = 'Error!!';
//require_once "Classes/ExpressAdmin.php";

//var_dump($_SESSION);

ExpressAdmin::grant();

// new Db object
$db = new ExpressDb();
// connect to databases
$db->connect();

$point_id = $_SESSION['point'];
$point_num = $_SESSION['point_num'];

$packages = ExpressPackage::getDepartmentPackage($db->connection,$point_id,$point_num,1);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>#HashtegExpress</title>
    <!-- Подключаем Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap-4.5.3-dist/css/bootstrap.min.css" >
</head>
<body>
<div style="margin-left: 20px; margin-right: 500px">
    <div class="row">
        <div class="page-header">
            <img src="images/logo11.png">
            <h1 style="margin-left: 20px"><span class="badge badge-primary">Служба срочной доставки</span> </h1>

        </div>
        <div>
            <table>
                <tr>

                    <?php
                    if (isset($_SESSION['user_session_id'])) {
                        $_SESSION['time'] = time();
                        ?>
                        <td>
                            <br>
                            <form method="POST" action='logout.php' enctype='multipart/form-data'>
                                <div>
                                    <button type="submit" name="logout_send" class="btn btn-outline-primary" value="logout_send">Logout <?=$_SESSION['userName'] ?></button>
                                </div>
                            </form>
                        </td>

                        <?php
                    } else ExpressAdmin::logOut('Sorry!!<br>You are not authorize.'); ?>

                    <td>
                        <?php
                        // to display messages
                        if (isset($_SESSION['Messages'])) {
                            echo '<div>'.$_SESSION['Messages'].'</div>';
                            unset ($_SESSION['Messages']);
                        }
                        ?>
                    </td>

                </tr>
            </table>

        </div>
    </div>
    <hr>
    <div class="page-header">
        <u><h2><b>Рабочее место Работника Склада.</b></u>
        <small>Кладовщик <?=$_SESSION['userName']?></small>
        </h2>
    </div>
    <h5><b>Отделение  №<?=$_SESSION['point_num']?></b></h5>
    <h6><b>Адрес - <?=$_SESSION['address']?></b></h6>

    <?php if (!isset($_GET['pack'])) :?>
    <div>
        <a href="store.php?pack=yes" class="btn btn-primary">Упаковка посылок</a>
        <a href="checkandrecive.php?page=book&key={url}" class="btn btn-primary">Прием и проверка посылок</a>
    </div>
    <?php else : ?>
        <hr>
        <h3><b>Принятые посылки на предотправную проверку/упаковку:</b></h3>
        <hr>
    <?php

//        echo "<pre>";
//        var_dump($packages);
        foreach ($packages as $id => $package) :
            $user_send = "";
            $user_recive = "";

            foreach ($users as $key => $val) {
                if ($val['user_phone'] == $package['user_phone_sender']) {
                    $user_send = $val;
                }
                if ($val['user_phone'] == $package['phone_phone_recive']) {
                    $user_recive = $val;
                }
            } // get point sender info
            $point_sender = $db->getPointById($package['point_id_s']);
            $point_name = $db->getPointById($package['point_id']);
             ?>
            <div class="text">
                <h5>Заказ <b><?=$package['order_num']?></b> создан <b><?=date("d.m.y, H:m:s",$package['timePkgCreate'])?></b></h5>
                <table>
                    <tr>
                        <td><u><b>Отправитель:</b></u></td>
                        <td><?=$user_send['user_phone']." ".$user_send['user_name']." отделение №".$point_sender[0]['point_number']." г.".$point_sender[0]['city_name'].", ".$point_sender[0]['point_address']?></td>
                    </tr>
                    <tr>
                        <td><u><b>Получатель:</b></u></td>
                        <td><?=$user_recive['user_phone']." ".$user_recive['user_name']." отделение №".$point_name[0]['point_number']." г.".$point_name[0]['city_name'].", ".$point_name[0]['point_address']?></td>
                    </tr>
                    <tr>
                        <td>
                            <u><b>Упаковка/проверка:  </b></u>
                        </td>
                        <td>
                               <input type="checkbox" name="packcheck[]" id="exampleCheck1" style="margin-left: 5px">  Упаковка/проверка выполнена
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
        <?php endforeach; ?>
                     <button class="btn btn-primary" name="send_offer" value="send_offer" type="submit">Упаковать посылки</button>

    <?php endif;?>

    <hr>
    <p><a href='store.php'>Назад</a></p>
    <!-- Подключаем jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Подключаем Bootstrap JS -->
    <script src="css/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
</body>
</html>