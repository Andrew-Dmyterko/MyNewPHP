<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<?php
//список с фильтрацией

if ( isset($_GET)) {
    var_dump($_GET);
}


require_once "Anketa.php";
require_once "City.php";

$filters = [];

if (isset($_GET["city"])) {
    $filters = $_GET["city"];
}

$listUser = Anketa::getList($filters);
$listCity = City::getList();
//var_dump($listUser);
//die;
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
            <form action="" method="GET" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Город:</legend>
                        <?php foreach($listCity as $id=>$item){?>
                            <div>
                                <input type="checkbox" id="<?= $item?>" name="city[]" value="<?= $item?>" <?php if (isset($_GET["city"])) echo in_array($item, $_GET["city"]) ? "checked" : "" ?> >
                                <label for="city"><?= $item?></label>
                            </div>
                        <?php };?>
                    </fieldset>
                <input type="submit" name="submit">
                </form>
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
<!--                    <th>Количество</th>-->
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
                            <a href="edit.php?product_id=<?=$item['product_id']?>">Редактировать</a>
                            <a href="delete.php?product_id=<?=$item['product_id']?>">Удалить</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>