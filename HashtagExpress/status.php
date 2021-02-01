<?php

require_once "db/db.php";

$order="";
$order_track=[];
$id=0;


if (isset($_GET['order_num'])) {

    $order_number = $_GET['order_num'];

    foreach ($orders as $key => $val) {
        if ($val['order_number'] === $order_number) {
            $order = $val;
        }
    }
}

foreach ($orders_track as $key => $val) {
    if ($val['order_id'] === $order['order_id']) {
        $order_track[] = $val;
    }
}

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
    <u><h2><b><?=$order['order_number']?></b></u>
        <small>Статус заказа</small>
    </h2>
</div>
<br>
<h4>Заказ <?=$order['order_number']?> от <?=$order['order_date']?></h4>
<table>
    <tr>
        <h5><td><u><b>Отправитель:</b></u></td> <td> <?=$order['sender_name']?> отделение №<?=$order['from_department']?> город <?=$order['from_city']?></td></h5>
    </tr>
    <tr>
        <h5><td><u><b>Получатель:</b></u> </td><td><?=$order['reciver_name']?> отделение №<?=$order['to_department']?> город <?=$order['to_city']?></td></h5>
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
                <td><?=$value["order_status_data"]?></td>
                <td><?=$value["order_status_message"]?></td>

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
