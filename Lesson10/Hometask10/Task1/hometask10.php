<?php
/**
 * Задание 1
 *
 * Доделать анкету, оформить 2 последних чекбокса,
 * после успешной отправки формы,вывести сообщение
 *
 */
?>
<!--<pre>-->
<?php
$message_error =[];
$message = "";
$error_flag = false;
$name = '';
$age = '';
$gender = '';
$job ="";
$mailing = "";
$sequrity = "";
$array_job = [
    'developer' => 'Разработчик',
    'desiner' => 'Дизайнер',
    'system admin' => 'Системный администратор',
    'teacher' => 'Учитель',
];
$lessons = [];

//var_dump($_FILES);

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

//if ($_FILES && $_FILES['uploadedFile']['error'] == UPLOAD_ERR_OK)
//{
//    var_dump($_FILES);
//}

if (!$error_flag) {
    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {

        $fileTmpPath = $_FILES['uploadedFile']['tmp_name']; //временый путь
        $fileName = $_FILES['uploadedFile']['name'];
        $fileSize = $_FILES['uploadedFile']['size'];
        $fileType = $_FILES['uploadedFile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');

        if (in_array($fileExtension, $allowedfileExtensions)) {
            // directory in which the uploaded file will be moved
            $uploadFileDir = './uploaded_files/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $message = 'Файл успешно загружен.';
            } else {
                $message = 'Возникла проблема при загрузке.';
                $error_flag = true;
            }
//        echo $message;
        } else {
            $error_flag = true;
            echo "Не загружен не то расширение.";
        }
    }
}
//var_dump($_FILES);

if ($error_flag) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = (isset($_POST['gender']) && !empty($_POST['gender'])) ? $_POST['gender'] : "";
    $job = (isset($_POST['job']) && !empty($_POST['job'])) ? $_POST['job'] : "";
    $lessons = (isset($_POST['lessons']) && !empty($_POST['lessons'])) ? $_POST['lessons']: "";
    $mailing = (isset($_POST['mailing']) && !empty($_POST['mailing'])) ? $_POST['mailing']: "";
    $sequrity = (isset($_POST['sequrity']) && !empty($_POST['sequrity'])) ? $_POST['sequrity']: "";
}

if ($_POST && empty($error_flag))  {
    $message = $message." Ошибки отсутствуют. Анкета принята.";
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
<form action="hometask10.php" method="post" enctype="multipart/form-data">
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
        <input type="checkbox" name="lessons[]" value="PHP" <?php if(in_array("PHP", $lessons)) echo "checked";?>>PHP<br>
        <input type="checkbox" name="lessons[]" value="JavaScript" <?php if(in_array("JavaScript", $lessons)) echo "checked";?>>JavaScript<br>
        <input type="checkbox" name="lessons[]" value="Java" <?php if(in_array("Java", $lessons)) echo "checked";?>>Java<br>
    </div><br>
    <div>
        <input type="checkbox" name="mailing"  value="Yes" <?php if($mailing == "Yes") echo "checked";?>>Подписка
        <input type="checkbox" name="sequrity" value="Yes" <?php if($sequrity == "Yes") echo "checked";?>>Согласны на обработку персональных данных?
    </div>
    <div>
        <input type="file" name="uploadedFile">
    </div>
    <div>
        <button type="submit" name="form_send" value="yes">Добавить анкету</button>
    </div>
</form>

<hr>

</body>
</html>
<pre>



