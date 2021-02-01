<?php
$driver = 'mysql';
$host = 'localhost';
$db_name = 'test';
$db_user = 'root';
$db_pass = '650351';
$charset = 'utf8';

if (isset($_POST['form_send'])) {

    try {
        $db = new \mysqli($host, $db_user, $db_pass, $db_name);
    } catch (\Exception $e) {
        echo 'Подключение не удалось: ' . $e->getMessage();
    }

    var_dump($_POST);

    $db->query("SET NAMES 'utf8'");

    $query1 = "insert into fio set name='".$_POST['name']."', surname='".$_POST['surname']."', age='".$_POST['age']."'";

    echo $query1;

    $db->query($query1);

    printf( "id новой записи %d.\n", $db->insert_id);

    $query2 = "insert into adress set id='".$db->insert_id."', country='".$_POST['country']."', city='".$_POST['city']."', address='".$_POST['address']."'";

    echo $query2;

    $db->query($query2);

    printf( "id новой записи %d.\n", $db->insert_id);


    var_dump($_POST);



$db->close();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <hr>

    <h3>Анкета</h3>
    <form action="index.php" method="post">
        Таблица 1
        <div>
            <input type="text" name="name" placeholder="Ваше имя?">
        </div>
        <div>
            <input type="text" name="surname" placeholder="Ваша фамилия?">
        </div>
        <div>
            <input type="number" name="age" placeholder="Ваш возраст?">
        </div>

        <hr> Таблица 2

        <div>
            <input type="text" name="country" placeholder="Ваша страна?">
        </div>
        <div>
            <input type="text" name="city" placeholder="Ваша город?">
        </div>
        <div>
            <input type="text" name="address" placeholder="Ваша адрес?">
        </div>

        <hr>

        <div>
            <button type="submit" name="form_send" value="yes">Добавить анкету</button>
        </div>
    </form>

</body>
</html>