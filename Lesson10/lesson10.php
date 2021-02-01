<?php
$message_error =[];
$message = "";
$error_flag = false;
$name = '';
$age = '';
$gender = '';
$job ="";
$array_job = [
    'developer' => 'Разработчик',
    'desiner' => 'Дизайнер',
    'system admin' => 'Системный администратор',
    'teacher' => 'Учитель',
];
$lessons = [];
//$

//var_dump($_FILES);

if ($_FILES && $_FILES['upload_file']['error'] == UPLOAD_ERR_OK)
{
    var_dump($_FILES['upload_file']);
}

if(isset($_POST['name']) && !empty($_POST['name'])){
    if(mb_strlen($_POST['name']) <=1 || mb_strlen($_POST['name']) > 15) {
        $message_error['name'] = 'Недопустимое количество символов';
        $error_flag = true;
    } //else $name = $_POST['name'];
}

if (isset($_POST['age']) && !empty($_POST['age'])) {
    var_dump($_POST);
    if ($_POST['age'] < 12 ) {
        $error_flag = true;
        $message_error['age'] = "Вам еще рано";
    } //else $age = $_POST['age'];
}

if ($error_flag) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = (isset($_POST['gender']) && !empty($_POST['gender'])) ? $_POST['gender'] : "";
    $job = (isset($_POST['job']) && !empty($_POST['job'])) ? $_POST['job'] : "";
    $lessons = (isset($_POST['lessons']) && !empty($_POST['lessons'])) ? $_POST['lessons']: "";
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
<pre></pre>

<hr>
<?=$message?>
<h3>Анкета</h3>
<form action="lesson10.php" method="post" enctype="multipart/form-data">
    <div>
        <input type="text" name="name" placeholder="Ваше имя?" value="<?=$name?>">
        <?php if(isset($message_error['name'])):?><span style="color: red;"><?= $message_error['name'] ?></span><?php endif; ?>
    </div>
    <div><br>
        <input type="number" name="age" placeholder="Ваш возраст?" value="<?=$age?>">
        <?php if(isset($message_error['age'])):?><span style="color: red;"><?= $message_error['age'] ?></span><?php endif; ?>
    </div>
    <div><br>Ваш пол -
        <input type="radio" name="gender" value="m" class="radio" <?php if($gender == "m") echo "checked"; ?> >М
        <input type="radio" name="gender" value="f" class="radio" <?php if($gender == "f") echo "checked"; ?> >Ж
    </div>
    <div><br>Ваша профессия?
        <select name="job">
            <option disabled selected value="">Выберите сферу деятельности</option>
            <?php foreach($array_job as $value=>$title_job):?>
                <option value="<?= $value ?>" <?php if($value == $job)echo "selected"; ?>><?= $title_job ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div> <br>Чтобы вы хотели изучать?<br>
        <input type="checkbox" name="lessons[]" value="PHP" <?php if(in_array("PHP", $lessons)) echo "checked";?>> PHP<br>
        <input type="checkbox" name="lessons[]" value="JavaScript" <?php if(in_array("JavaScript", $lessons)) echo "checked";?>>JavaScript<br>
        <input type="checkbox" name="lessons[]" value="Java" <?php if(in_array("Java", $lessons)) echo "checked";?>>Java<br>
    </div><br>
    <div>
        <input type="checkbox" name="mailing">Подписка
        <input type="checkbox" name="sequrity" value="Yes">Согласны на обработку персональных данных?
    </div>
    <div>
        <input type="file" name="upload_file">
    </div>
    <div>
        <button type="submit" name="form_send" value="yes">Добавить анкету</button>
    </div>
</form>

<hr>

</body>
</html>
<pre>


