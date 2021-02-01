<?php

require_once "Anketa.php";
//require_once "City.php";

if (isset($_POST['delete'])) {
    $user_id = $_POST['delete'];

    $user = new Anketa($user_id);

    $user->delete();

    if ($user)  header('Location: index.php');
    else {
        echo "Ошибка!!!";
    }

}
elseif (isset($_GET['user_id'])) {

    $user_id = $_GET['user_id'];

    $user = new Anketa($user_id);

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Удаление записи</title>
    </head>
    <body>
        <h2>Удаление записи</h2>
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
            <div>
                <button type="submit" name="delete" value="<?=$user->id?>">Удалить</button>
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







