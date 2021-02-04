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

// new Db object
$db = new ExpressDb();
// connect to databases
$db->connect();

$order="";
$order_track=[];
$id=0;

if (isset($_GET['order_num'])) {

    $order_number = $_GET['order_num'];

    $order = ExpressPackage::getPackageByTrack($db->connection,$order_number);

    if (!$order) {
        $_SESSION['Messages'] = 'Error!!! Undefined Track number!!!<br>Check it!!!';
        header('Location: index.php');
        exit;
    }
//    var_dump($order);
//    die;
} else {
    $_SESSION['Messages'] = 'Track number is empty';
    header('Location: index.php');
    exit;
}

$order_track = ExpressPackage::getHistoryById($db->connection,$order['package_id']);

$user_send = "";
$user_recive = "";

$package = $order;

foreach ($users as $key => $val) {
    if ($val['user_phone'] == $package['user_phone_sender']) {
        $user_send = $val;
    }
    if ($val['user_phone'] == $package['phone_phone_recive']) {
        $user_recive = $val;
    }
}

// get point sender info
$point_sender = $db->getPointById($package['point_id_s']);
$point_name = $db->getPointById($package['point_id']);
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
    <div class="page-header">
        <img src="images/logo11.png">
<!--        <h1 style="margin-left: 20px"><span class="badge badge-primary">Служба срочной доставки</span> </h1>-->
    </div>
    <hr>

<div class="page-header">
    <u><h2><b><?=$order['order_num']?></b></u>
        <small>Статус заказа</small>
    </h2>
</div>
<br>
<h4>Заказ <?=$order['order_num']?> от <?=date("d.m.y",$order['timePkgCreate'])?></h4>
<table>
    <tr>
        <h5><td><u><b>Отправитель:</b></u></td> <td> <?=$user_send['user_name']?> отделение №<?=$point_sender[0]['point_number']." г.".$point_sender[0]['city_name'].", ".$point_sender[0]['point_address']?></td></h5>
    </tr>
    <tr>
        <h5><td><u><b>Получатель:</b></u> </td><td><?=$user_recive['user_name']?> отделение №<?=$point_name[0]['point_number']." г.".$point_name[0]['city_name'].", ".$point_name[0]['point_address']?></td></h5>
    </tr>
</table>
    <div>
<br>
        <div>
    <table class="table table-bordered table-sm table-hover">
<!--            <table border="2" >-->
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Дата статуса</th>
            <th scope="col">Где посылка</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($order_track as $value){ ?>
            <tr>
                <th scope="row"><?=++$id?></th>
                <td><?=date("d.m.y, H:m:s",$value["package_status_data"])?></td>
                <td><?=$value["package_status_message"]?></td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
    </div>
    </div>
    <p><a href='index.php'>Назад</a></p>
<!-- Подключаем jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Подключаем Bootstrap JS -->
<script src="css/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
</body>
</html>
