<?php
session_start();

use Classes\ExpressDb;
use Classes\ExpressAdmin;
use Classes\ExpressPackage;

// __autoload for used class
spl_autoload_register(function ($class) {
    $file_name = str_replace('\\', '/', $class) . '.php';
    if (file_exists($file_name)) {
        require_once($file_name);
    } else {
        echo "file does not exist!";
    }
});

// check the session status // if sessions are enabled, but none exists // start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once "db/db.php";

require_once "Classes/ExpressAdmin.php";

//var_dump($_SESSION);

ExpressAdmin::grant();

//var_dump($_POST);
//var_dump($_GET['city_id']);
//var_dump($_SESSION);
//var_dump($_GET);

$order="";
$order_track=[];
$id=0;
$user_send = "";
$user_recive = "";

if (isset($_GET['user_phone_sender'])) {

    $user_phone = $_GET['user_phone_sender'];

    foreach ($users as $key => $val) {
        if ($val['user_phone'] === $user_phone) {
            $user_send = $val;
        }
    }
}
$city_id =  $_GET['city_id'] ?? null;
$point_id =  $_GET['point_id'] ?? null;
$pack_descr = $_GET['pack_descr'] ?? '';
$pack_weight = $_GET['pack_weight'] ?? '';
$pack_length = $_GET['pack_length'] ?? '';
$pack_width = $_GET['pack_width'] ?? '';
$pack_height = $_GET['pack_height'] ?? '';

// new Db object
$db = new ExpressDb();
// connect to databases
$db->connect();

// get point sender info
$point_sender = $db->getPointById($_SESSION['point']);

if (isset($_GET['phone_phone_recive'])) {

    $user_phone = $_GET['phone_phone_recive'];

    foreach ($users as $key => $val) {
        if ($val['user_phone'] === $user_phone) {
            $user_recive = $val;
        }
    }


    // get city from db
    $citiesList = $db->getCities();

// get points from db
    if (isset($city_id)) {
        $pointsList = $db->getPoints($city_id);
        $city_name = $db->getCityById($city_id);
//        echo $city_name[0]['city_name'];
    }
    else $pointsList = null;

    if (isset($point_id)) {
        $point_name = $db->getPointById($point_id);
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
    <div class="row">
    <div class="page-header">
        <img src="images/logo11.png">
    </div>
    <div>
        <table>
            <tr>

                <?php
                if (isset($_SESSION['user_session_id'])) {
                    $_SESSION['time'] = time();
                    ?>
                    <td>
                        <!--                        <br>--><h6></h6>
                        <form method="POST" action='logout.php' enctype='multipart/form-data' style="margin-top: 1px">
                            <div>
                                <button type="submit" class="btn btn-outline-primary" name="logout_send" value="logout_send">Logout <?=$_SESSION['userName'] ?></button>
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

<?php if(!isset($_GET['send_offer'])) {?>


 <?php if (!isset($_GET['user_phone_sender'])) { ?>

        <div class="page-header">
            <u><h1><b>Отправка заказа</b></u>
            <small>Оформление отправки</small>
            </h1>
            <br>
        </div>

    <form action="send.php" class="form-inline">
        <div class="form-group mb-2  mx-sm-3">
            <label for="user_phone_sender" class="sr-only"></label>
            <input type="text" class="form-control" id="user_phone_sender" name="user_phone_sender" placeholder="Телефон отправителя">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Оформить отправку</button>
    </form>

    <?php } else {?>

     <div class="page-header">
         <u><h3><b>Данные отправителя</b></u></h3>
     </div>

     <form>
         <div class="form-row">
             <div class="col-md-2 mb-2">
                 <label for="validationDefault01">Телефон</label>
                 <input type="text" class="form-control" id="validationDefault01" name="user_phone_sender" placeholder="Телефон отправителя" value="<?=$user_send['user_phone']?>" required>
             </div>
             <div class="col-md-3 mb-3">
                 <label for="validationDefault02">ФИО</label>
                 <input type="text" class="form-control" id="validationDefault02" placeholder="Имя отправителя" value="<?=$user_send['user_name']?>" required>
             </div>
             <div class="col-md-2 mb-3">
                 <label for="validationDefaultUsername">Дисконтная карта #</label>
                 <input type="text" class="form-control" id="validationDefaultUsername" placeholder="Дисконтная карта" value="<?=$user_send['user_client_card']?>" required>
             </div>
             <div class="col-md-2 mb-3">
                 <label for="validation1">Число отправок</label>
                 <input type="text" class="form-control" id="validation1" placeholder="Число отправок" value="<?=$user_send['user_count']?>" required>
             </div>
             <div class="col-md-2 mb-3">
                 <label for="validation2">Скидка %</label>
                 <input type="text" class="form-control" id="validation2" placeholder="Скидка клиента %" value="<?=$user_send['user_bonus']?>%" required>
             </div>
         </div>
         <div class="page-header">
             <u><h3><b>Отделение отправки</b></u></h2>
         </div>
         <div class="form-row">
             <div class="col-md-3 mb-3">
                 <label for="validationDefault03">Номер отделения</label>
<!--                 <input type="text" class="form-control" name="point_num" id="validationDefault03" value="--><?//= $_SESSION['point'] ?><!--" required>-->
                 <input type="text" class="form-control" name="point_num" id="validationDefault03" value="<?= $point_sender[0]['point_number'] ?>" required>
             </div>
             <div class="col-md-6 mb-3">
                 <label for="validationDefault04">Адрес отделения</label>
<!--                 <input type="text" class="form-control" name="point_address" id="validationDefault04"  value="--><?//=$_SESSION['address'] ?><!--" required>-->
                 <input type="text" class="form-control" name="point_address" id="validationDefault04"  value="<?=$point_sender[0]['city_name'].", ".$point_sender[0]['point_address'] ?>" required>
             </div>
         </div>
         <div class="page-header">
             <u><h3><b>Данные о посылке</b></u></h2>
         </div>
         <div class="form-row">
             <div class="col-md-4 mb-3">
                 <label for="validationDefault03">Описание посылки</label>
                 <input type="text" class="form-control" name="pack_descr" id="validationDefault03" placeholder="Описание посылки"  value="<?= $pack_descr ?>" required>
             </div>
             <div class="col-md-1 mb-3">
                 <label for="validationDefault04">Вес (кг)</label>
                 <input type="text" class="form-control" name="pack_weight" id="validationDefault04" placeholder="Вес" value="<?=$pack_weight ?>" required>
             </div>
             <div class="col-md-1 mb-3">
                 <label for="validationDefault04">Длина (мм)</label>
                 <input type="text" class="form-control" name="pack_length" id="validationDefault04" placeholder="Длина" value="<?=$pack_length ?>" required>
             </div>
             <div class="col-md-1 mb-3">
                 <label for="validationDefault04">Ширина (мм</label>
                 <input type="text" class="form-control" name="pack_width" id="validationDefault04" placeholder="Ширина" value="<?=$pack_width ?>" required>
             </div>
             <div class="col-md-1 mb-3">
                 <label for="validationDefault04">Высота (мм)</label>
                 <input type="text" class="form-control" name="pack_height" id="validationDefault04" placeholder="Высота" value="<?=$pack_height ?>" required>
             </div>
         </div>
         <div class="page-header">
             <u><h3><b>Данные о получателе</b></u></h3>
         </div>

         <?php if (!isset($_GET['phone_phone_recive'])) { ?>

         <div class="form-row">
         <div class="col-md-4 mb-4">
             <label for="phone_num_reciver" class="sr-only"></label>
             <input type="text" class="form-control" id="phone_num_reciver" name="phone_phone_recive" placeholder="Телефон получателя">
         </div>
         </div>
         <button class="btn btn-primary" type="submit">Найти получателя</button>
        <?php } else { ?>
             <div class="form-row">
                 <div class="col-md-2 mb-2">
                     <label for="validationDefault01">Телефон</label>
                     <input type="text" class="form-control" id="validationDefault01" name="phone_phone_recive" placeholder="Телефон отправителя" value="<?=$user_recive['user_phone']?>" required>
                 </div>
                 <div class="col-md-3 mb-3">
                     <label for="validationDefault02">ФИО</label>
                     <input type="text" class="form-control" id="validationDefault02" placeholder="Имя отправителя" value="<?=$user_recive['user_name']?>" required>
                 </div>
                 <div class="col-md-2 mb-3">
                     <label for="validationDefaultUsername">Дисконтная карта #</label>
                     <input type="text" class="form-control" id="validationDefaultUsername" placeholder="Дисконтная карта" value="<?=$user_recive['user_client_card']?>">
                 </div>
                 <div class="col-md-2 mb-3">
                     <label for="validation1">Число отправок</label>
                     <input type="text" class="form-control" id="validation1" placeholder="Число отправок" value="<?=$user_recive['user_count']?>" required>
                 </div>
                 <div class="col-md-2 mb-3">
                     <label for="validation2">Скидка %</label>
                     <input type="text" class="form-control" id="validation2" placeholder="Скидка клиента %" value="<?=$user_recive['user_bonus']?>%" required>
                 </div>
             </div>

             <div class="page-header">
                 <u><h3><b>Отделение получателя</b></u></h2>
             </div>
             <div class="form-row">
                 <div class="col-md-3 mb-3">
                     <label for="validationDefault03">Город получателя</label>
                     <select class="form-select form-control" aria-label="Default select example" id="validationDefault03" name="city_id">
                         <option disabled selected>Выберите город</option>
                         <?php foreach ($citiesList as $id => $city) :?>

                         <option value=<?= $city['city_id']?> <?= ($city['city_id'] == $city_id) ? " selected" : ""; ?>><?= $city['city_name']?> </option>

                        <?php endforeach; ?>
                     </select>
                     <button class="btn btn-primary" type="submit">Найти отделения в городе</button>
                 </div>
                <?php if (isset($city_id)) :?>
                 <div class="col-md-6 mb-6">
                     <label for="validationDefault03">Номер отделения</label>
                     <select class="form-select form-control" aria-label="Default select example" id="validationDefault03" name="point_id">
                         <option disabled selected>Выберите отделение в г.<?= $city_name[0]['city_name'] ?></option>
                         <?php foreach ($pointsList as $id => $point) :?>

                             <option value=<?= $point['point_id']?> <?= ($point['point_id'] == $point_id && isset($_GET['go_cost'])) ? " selected" : ""; ?>><?= $point['point_number']." - ".$city_name[0]['city_name'].", ".$point['point_address']?> </option>

                         <?php endforeach; ?>
                     </select>
<!--                     <button class="btn btn-primary" type="submit">Посчитать стоимость</button>-->
                 </div>
                 <div class="col-md-2 mb-2">
                     <label for="validationDefault04"><b>Расчет стоимости</b></label>
                     <button class="btn btn-primary form-control" name="go_cost" value="cost" type="submit">Посчитать стоимость</button>
                 </div>
<!--             </div>-->
             <?php if (isset($_GET['go_cost']) && isset($point_id)) : ?>

                 <div class="text" style="margin-left: 220px;margin-top: 0px;">
<!--                     <h4>Заказ <b>98006300258</b> от <b>20.12.2020</b></h4>-->
                     <table>
                         <tr>
                                 <td><u><b>Отправитель:</b></u></td>
                                 <td><?=$user_send['user_phone']." ".$user_send['user_name']." отделение №".$point_sender[0]['point_number']." г.".$point_sender[0]['city_name'].", ".$point_sender[0]['point_address']?></td>
<!--                                 <td>--><?//=$user_send['user_phone']." ".$user_send['user_name']." отделение №".$point['point_number']." г.".$city_name[0]['city_name']?><!--</td>-->
                         </tr>
                         <tr>
                                 <td><u><b>Получатель:</b></u></td>
                                 <td><?=$user_recive['user_phone']." ".$user_recive['user_name']." отделение №".$point_name[0]['point_number']." г.".$city_name[0]['city_name'].", ".$point_name[0]['point_address']?></td>
                         </tr>
                         <tr>
                             <td><u><b>Cтоимость доставки:</b></u></td><td><?= Package::countDelivery() ?> грн</td>
                         </tr>
                         <tr>
                                     <td>  <div class="form-check">
                                             <input type="checkbox" name="pay_beznal" class="form-check-input" id="exampleCheck1">
                                             <label class="form-check-label" for="exampleCheck1">Оплата безналичная</label>
                                         </div>
                                     </td>
                                     <td>  <div class="form-check">
                                             <input type="checkbox" name="pay" class="form-check-input" id="exampleCheck11">
                                             <label class="form-check-label" for="exampleCheck1">Оплата совершена</label>
                                         </div>
                                         <div class="form-check">
                                             <input type="checkbox" name="pay_reciver" class="form-check-input" id="exampleCheck12">
                                             <label class="form-check-label" for="exampleCheck12">Платит получатель</label>
                                         </div>
                                     </td>
                         </tr>
                     </table>
                 </div>
             </div>
         <button class="btn btn-primary" name="send_offer" value="send_offer" type="submit">Оформить заказ</button>
             <?php endif; ?>
             <?php endif; ?>
             </div>

<!--             <button class="btn btn-primary" name="send_offer" value="send_offer" type="submit">Оформит заказ</button>-->
         <?php } ?>
<!--         <button class="btn btn-primary" name="send_offer" value="send_offer" type="submit">Оформит заказ</button>-->
     </form>

    <?php } } else {
    require_once __DIR__ . '/phpqrcode/qrlib.php';

//echo "<pre>";
//    var_dump($_GET);
//    var_dump($_SESSION);
//die;
        $pay_beznal = $_GET["pay_beznal"] ?? null;
        $pay = $_GET["pay"] ?? null;
        $pay_reciver = $_GET["pay_reciver"] ?? null;

    $package = new ExpressPackage(
        $_GET["user_phone_sender"],
        $_GET["point_num"],
        $_SESSION["point"],
        $_GET["point_address"],
        $_GET["pack_descr"],
        $_GET["pack_weight"],
        $_GET["pack_length"],
        $_GET["pack_width"],
        $_GET["pack_height"],
        $_GET["phone_phone_recive"],
        $_GET["city_id"],
        $_GET["point_id"],
        $pay_beznal,
        $pay,
        $pay_reciver
    );

//        public $package_id; // id package
//        public $user_phone_sender; // sender phone
//        public $point_id_s; // sender point id
//        public $point_num; // sender point num
//        public $point_address; // sender point address
//        public $pack_descr; // package description
//        public $pack_weight; // package weight
//        public $pack_length; // package length
//        public $pack_width; // package width
//        public $pack_height; // // package height
//        public $phone_phone_recive; // receiver phone
//        public $city_id;
//        public $point_id;
//        public $pay_beznal; // pay cashless/cash
//        public $pay;        // is payment
//        public $pay_reciver; // is receiver pay?
//        public $order_num; // track code
//        public $status_msg; //status massage
//        public $status_id; //status massage
//        public $timePkgCreate; // time when package created


    $package->create($db->connection);

    /* Генерация QR-кода во временный файл */
    //    http://localhost/MyNewPHP/HashtagExpress/status.php?order_num=98006300258
    QRcode::png('http://172.16.10.101/MyNewPHP/HashtagExpress/status.php?order_num='.$package->order_num, __DIR__ . '/tmp/tmp.png', 'M', 6, 2);

    $im = imagecreatefrompng(__DIR__ . '/tmp/tmp.png');
    $width = imagesx($im);
    $height = imagesy($im);

    /* Цвет фона в RGB */
    $bg_color = imageColorAllocate($im, 255, 225, 255);

    for ($x = 0; $x < $width; $x++) {
        for ($y = 0; $y < $height; $y++) {
            $color = imagecolorat($im, $x, $y);
            if ($color == 0) {
                imageSetPixel($im, $x, $y, $bg_color);
            }
        }
    }

    ///* Вывод в браузер */
    //header('Content-Type: image/x-png');
    //imagepng($im);

    ?>
    <div class="page-header">
        <h3><b>Заказ оформлен.</b></h3>
        <u><h3><b>Чек  заказа.</b></u>
        <small>Использвйте QR-код для отслеживания.</small>
        </h3>
    </div>
<hr>
    <div class="box" style="overflow: hidden;">
        <div class="image" style="width: 200px; float: left;">
            <img src="tmp/tmp.png" alt="" style="float: left; width: 200px;"/>
        </div>
        <div class="text" style="margin-left: 220px;">
            <h4>Заказ <b><?=$package->order_num?></b> от <b><?=date("d.m.y",$package->timePkgCreate)?></b></h4>
            <table>
                <tr>

                    <h6>
                        <td><u><b>Отправитель:</b></u></td>
                        <td><?=$user_send['user_phone']." ".$user_send['user_name']." отделение №".$point_sender[0]['point_number']." г.".$point_sender[0]['city_name'].", ".$point_sender[0]['point_address']?></td>
                    </h6>
                </tr>
                <tr>
                    <h6>
                    <td><u><b>Получатель:</b></u></td>
                    <td><?=$user_recive['user_phone']." ".$user_recive['user_name']." отделение №".$point_name[0]['point_number']." г.".$city_name[0]['city_name'].", ".$point_name[0]['point_address']?></td>
                    </h6>
                </tr>
                <tr>
                    <h6><td><u><b>Посылка:</b></u> </td><td><?=$pack_descr?></td></h6>
                </tr>
                <tr>
                    <h6><td><u><b>Доставка:</b></u> </td><td>25.12.2020р. </td></h6>
                </tr>
                <tr>
                    <h6><td><u><b>Цена доставки:</b></u> </td><td><?= Package::countDelivery() ?> грн</td></h6>
                </tr>
                <tr>
                    <h6><td><u><b>Подпись отправителя:</b></u> </td><td>   ______________ <?=$user_send['user_name']?></td></h6>
                </tr>
            </table>
        </div>
    </div>
    <div>
<!--     тут текст под картинкой   ...-->
    </div>

    <?php
    }
   ?>
    <hr>
    <p><a href='operator.php'>Назад</a></p>
</div>

<!-- Подключаем jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Подключаем Bootstrap JS -->
<script src="css/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
</body>
</html>
