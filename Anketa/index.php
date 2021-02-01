<?php
session_start();

use Model\Country;
use Model\Age;
use Model\City;
use Classes\Anketa;

 // __autoload for used class
spl_autoload_register(function ($class) {
    $file_name = str_replace('\\', '/', $class) . '.php';
    if (file_exists($file_name)) {
        require_once($file_name);
    } else {
        echo "file does not exist!";
    }
});


//список с фильтрацией
require_once 'db.php';

//require_once "Anketa.php";
//require_once "City.php";
//require_once "Age.php";
//require_once "Api1/Country.php";

$filters = [];

if (isset($_GET["city"]) || (isset($_GET["country"])) || (isset($_GET["age"]))) {
    $filters = $_GET;
}

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page=1;
}

if (isset($filters['page'])) unset($filters['page']);
if (isset($filters['submit'])) unset($filters['submit']);

$listUser = Anketa::getList($filters, $page);
$listCity = City::getList();
$listAge = Age::getList();
$listCountry = Country::getList();
$total = Anketa::getTotalUsers($filters);
$pages = ceil($total/Anketa::$numb);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <form action="add.php" method="GET" enctype="multipart/form-data">
                <input type="submit" name="new" value="new"><a href="AnketaAdmin.php">Admin</a>
            </form>
            <form action="" method="GET" enctype="multipart/form-data">
                <fieldset>
                    <legend>Город:</legend>
                    <?php foreach($listCity as $id=>$item){?>
                        <div>
                            <input type="checkbox" id="<?= $item['city']?>" name="city[]" value="<?= $item['city']?>" <?php if (isset($_GET["city"])) echo in_array($item['city'], $_GET["city"]) ? "checked" : "" ?> >
                            <label for="city"><?= $item['city']?></label>
                        </div>
                    <?php };?>
                </fieldset>
                <fieldset>
                    <legend>Страна:</legend>
                    <?php foreach($listCountry as $id=>$item){?>
                        <div>
                            <input type="checkbox" id="<?= $item['country']?>" name="country[]" value="<?= $item['country']?>" <?php if (isset($_GET["country"])) echo in_array($item['country'], $_GET["country"]) ? "checked" : "" ?> >
                            <label for="city"><?= $item['country']?></label>
                        </div>
                    <?php };?>
                </fieldset>
               <fieldset>
                   <legend>Возраст:</legend>
                    <?php foreach($listAge as $id=>$item){?>
                        <div>
                            <input type="checkbox" id="<?= $item['age']?>" name="age[]" value="<?= $item['age']?>" <?php if (isset($_GET["age"])) echo in_array($item['age'], $_GET["age"]) ? "checked" : "" ?> >
                            <label for="city"><?= $item['age']?></label>
                        </div>
                    <?php };?>
                </fieldset>
            <input type="submit" name="submit" value="Фильтровать">
            </form>
            <div>
                <h6>Login to Admin area</h6>
            </div>
            <?php
            if (isset($_SESSION['user_session_id'])) {
            $_SESSION['time'] = time();
            ?>

            <form method="POST" action='logout.php' enctype='multipart/form-data'>
                <div>
                    <button type="submit" name="logout_send" value="logout_send">Logout <?=$_SESSION['userName'] ?></button>
                </div>
            </form>
            <hr>

            <?php
} else { ?>
            <form method="POST" action='AnketaAdmin.php' enctype='multipart/form-data'>
                <!-- Имя -->
                <div>
                    <input type="text" name="login" placeholder="Login">
                </div>
                <!-- Пароль -->
                <div>
                    <input type="password" name="password" placeholder="Password">
                </div>
                <div>
                    <button type="submit" name="login_send" value="login_send">Login</button>
                </div>
            </form>
<?php } ?>

            <?php
            // to display messages
            if (isset($_SESSION['Messages'])) {
                echo '<div>'.$_SESSION['Messages'].'</div>';
                unset ($_SESSION['Messages']);
            }
            ?>

        </div>
        <div class="col-md-9">
            <table>
                <tr>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Возраст</th>
                    <th>Страна</th>
                    <th>Город</th>
                    <th>Адресс</th>
                    <th></th>
                </tr>
                <?php foreach($listUser as $user):?>
                    <tr>
                        <td><?=$user['name']?></td>
                        <td><?=$user['surname']?></td>
                        <td><?=$user['age']?></td>
                        <td><?=$user['country']?></td>
                        <td><?=$user['city']?></td>
                        <td><?=$user['address']?></td>
                        <td>
                            <a href="edit.php?user_id=<?=$user['id']?>">Редактировать</a>
                            <a href="delete.php?user_id=<?=$user['id']?>">Удалить</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php

            $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $url = explode('?', $url);
            $url = $url[0];
            ?>

            <?php

            $url .= "?";

            if (!empty($filters)) $url .= http_build_query($filters)."&";
            ?>
            <?php if ($pages > 1) : ?>
            <table>
            <tr>
                <td>
                    <?php if ($page == 1 || $pages == 0):
                        echo "Начало";
                    else: ?>
                        <a href="<?=$url?>page=1">Начало</a>
                    <?php endif;?>
                </td>
                <td>
                <?php if ($page == 1 || $pages == 0):
                    echo "Назад";
                else: ?>
                <a href="<?=$url?>page=<?=$page-1?>">Назад</a>
                <?php endif;?>
                </td>
                <?php for($pag=1; $pag <= $pages; $pag++ ): ?>
                 <td>

                <?php if ($pag != $page):  ?>
                    <a href="<?=$url?>page=<?=$pag?>"><?=$pag?></a>
                    <?php else:
                        echo $page;
                    endif;?>
                </td>

                <?php endfor; ?>
                <td>
                <?php if ($page == $pages || $pages == 0):
                    echo "Вперед";
                else: ?>
                    <a href="<?=$url?>page=<?=$page+1?>">Вперед</a>
                <?php endif;?>
                </td>
                <td>
                    <?php if ($page == $pages || $pages == 0):
                        echo "Конец";
                    else: ?>
                        <a href="<?=$url?>page=<?=$pages?>">Конец</a>
                    <?php endif;?>
                </td>
            </tr>
            </table>
            <?php endif; ?>
<!--            --><?php //echo $url; ?>

        </div>
    </div>
</div>
</body>
</html>