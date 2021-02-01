<?php
$message =[];

$name = '';

if(isset($_POST['name']) && !empty($_POST['name'])){
    if(strlen($_POST['name']) <=1 || strlen($_POST['name']) > 5) {
        $message_error['name'] = 'Недопустимое количество символов';
        $error_flag = true;
    } else $name = $_POST['name'];


}

if (isset($_POST['form_send'])) {
    var_dump($_POST);
    if ($_POST['age'] < 12 ) $message = "Вам еще рано";
    else $message = "";
} else $message = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<pre></pre>

<hr>
<?=$message?>
<h3>Анкета</h3>
<form action="index.php" method="post">
    <div>
        <input type="text" name="name" placeholder="Ваше имя?" value="<?=$name?>">
    </div>
    <div><br>
        <input type="number" name="age" placeholder="Ваш возраст?">
    </div>
    <div><br>Ваш пол -
        <input type="radio" name="gender" value="m" class="radio" checked >М
        <input type="radio" name="gender" value="no" class="radio" >Ж
    </div>
    <div><br>Ваша профессия?
        <select name="job">
            <option disabled selected value="">Выберите сферу деятельности</option>
            <option value="developer">Разработчик</option>
            <option value="designer">Дизайнер</option>
            <option value="system admin">Сисадмин</option>
            <option value="teacher">Учитель</option>
        </select>
    </div>
    <div> <br>Чтобы вы хотели изучать?<br>
        <input type="checkbox" name="lessons[]" value="PHP" checked> PHP<br>
        <input type="checkbox" name="lessons[]" value="JavaScript">JavaScript<br>
        <input type="checkbox" name="lessons[]" value="Java">Java<br>
    </div><br>
    <div>
        <input type="checkbox" name="mailing">Подписка
        <input type="checkbox" name="sequrity" value="Yes">Согласны на обработку персональных данных?
    </div>
    <div>
        <button type="submit" name="form_send" value="yes">Добавить анкету</button>
    </div>
</form>

<hr>

</body>
</html>
<pre>


