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

    /* Указать mysqli выбрасывать исключение в случае возникновения ошибки */
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    /* Начало транзакции */
$db->begin_transaction();

    try {
        /* Добавление каких-то значений */
        $query1 = "insert into fio set name='".$_POST['name']."', surname='".$_POST['surname']."', age='".$_POST['age']."'";

        echo $query1;

        $db->query($query1);

        /* Попытка добавить недопустимые значения */
        $id = $db->insert_id;
        $country = $_POST['country'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $salary = $_POST['salary'];

        $stmt = $db->prepare('insert into `adress` (`id`, `country`, `city`, `address`) VALUES (?,?,?,?)');
        $stmt1 = $db->prepare('insert into `salary` (`id`, `salary`) VALUES (?,?)');

//        var_dump($stmt);

        $stmt->bind_param('ssss', $id, $country, $city, $address);
        $stmt1->bind_param('si', $id, $salary);

        $stmt->execute();
        $stmt1->execute();

        /* Если код достигает этой точки без ошибок, фиксируем данные в базе данных. */
        $db->commit();

} catch (mysqli_sql_exception $exception) {

        $db->rollback();

        echo "Bad!!!!! index2";

        throw $exception;
}

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
    <form action="index2.php" method="post">
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
            <input type="number" name="salary" placeholder="Ваша зарплпта?">
        </div>
        <hr>

        <div>
            <button type="submit" name="form_send" value="yes">Добавить анкету</button>
        </div>
    </form>

</body>
</html>