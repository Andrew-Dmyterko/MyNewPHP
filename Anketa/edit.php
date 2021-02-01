<?php

require_once "Anketa.php";
require_once "City.php";

if (isset($_POST['edit'])) {
    $user_id = $_POST['edit'];

    $user = new Anketa();

    $user->id = $user_id;
    $user->name = $_POST['name'];
    $user->surname = $_POST['surname'];
    $user->age = $_POST['age'];
    $user->country = $_POST['country'];
    $user->address = $_POST['address'];
    $user->city = $_POST['city'];

    $user->edit();

    header('Location: index.php');
}
elseif (isset($_GET['user_id'])) {

    $user_id = $_GET['user_id'];

    $user = new Anketa($user_id);

    $listCity = City::getList();
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Удаление записи</title>
        <style>
            select,input {
                width: 200px; /* Ширина списка в пикселах */
            }
        </style>
    </head>
    <body>
        <h2>Редактирование записи</h2>
        <table>
            <tr><td>id </td><td><?=$user->id?></td></tr>
            <tr><td>Имя</td><td><?=$user->name?></td></tr>
            <tr><td>Фамилия</td><td><?=$user->surname?></td></tr>
            <tr><td>Возраст</td><td><?=$user->age?></td></tr>
            <tr><td>Страна</td><td><?=$user->country?></td></tr>
            <tr><td>Адрес</td><td><?=$user->address?></td></tr>
            <tr><td>Город</td><td><?=$user->city?></td></tr>
        </table>
        <br>
        <form method="POST" action="">
            <b>Имя</b>
            <div>
                <input type="text" name="name" value="<?=$user->name?>">
            </div>
            <b>Фамилия</b>
            <div>
                <input type="text" name="surname" value="<?=$user->surname?>">
            </div>
            <b>Возраст</b>
            <div>
                <input type="text" name="age" value="<?=$user->age?>">
            </div>
            <b>Страна</b>
            <div>
                <input type="text" name="country" value="<?=$user->country?>">
            </div>
            <b>Адрес</b>
            <div>
                <input type="text" name="address" value="<?=$user->address?>">
            </div>
            <b>Город</b>
            <div>
                <?php if ($user->id !== "##########"):         ?>
                <select name="city" >
                    <?php foreach($listCity as $id=>$item){?>
                         <option <?php if ($item['city'] == $user->city) echo "selected";  ?> value="<?=$item['id']?>"><?=$item['city']?></option>
                    <?php };?>
                </select>
                <?php else: ?>
                <input type="text" name="city" value="<?=$user->city?>">
                <?php endif; ?>
            </div>
            <br>
            <div>
                <button type="submit" name="edit" value="<?=$user->id?>" <?php echo ($user->id == "##########") ? " disabled " : "";   ?>>Изменяем</button>
                <a href='index.php'>Назад</a>
            </div>
        </form>

    </body>
</html>
<style>
    table, tr, td {
        border: 1px solid black;
        padding: 5px;
    }
</style>






