<?php

require_once "Anketa.php";
require_once "City.php";

$listCity = City::getList();

if (isset($_POST['add'])) {

    $user = new Anketa();

    $user->name = $_POST['name'];
    $user->surname = $_POST['surname'];
    $user->age = $_POST['age'];
    $user->country = $_POST['country'];
    $user->address = $_POST['address'];
    $user->city = $_POST['city'];

    $user->add();

    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Создание записи</title>
        <style>
            select,input {
                width: 200px; /* Ширина списка в пикселах */
            }
        </style>
    </head>
    <body>
        <h2>Редактирование записи</h2>
        <form method="POST" action="">
            <b>Имя</b>
            <div>
                <input type="text" name="name" placeholder="Имя">
            </div>
            <b>Фамилия</b>
            <div>
                <input type="text" name="surname" placeholder="Фамилия">
            </div>
            <b>Возраст</b>
            <div>
                <input type="number" name="age">
            </div>
            <b>Страна</b>
            <div>
                <input type="text" name="country" >
            </div>
            <b>Адрес</b>
            <div>
                <input type="text" name="address">
            </div>
            <b>Город</b>
            <div>
                <select name="city" >
                    <?php foreach($listCity as $id=>$item){?>
                        <option value="<?=$item['id']?>"><?=$item['city']?></option>
                    <?php };?>
                </select>
            </div>
            <br>
            <div>
                <button type="submit" name="add" value="add">Изменяем</button>
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






