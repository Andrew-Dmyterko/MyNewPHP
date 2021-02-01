<?php

$message_error = [];
$error_flag = false;
$name = '';
$age = '';
$job = '';
$gender = 'm';
$array_job = array();
$array_job = [
   'developer' => 'Разработчик',
   'desiner' => 'Дизайнер',
   'system admin' => 'Системный администратор',
   'teacher' => 'Учитель',
];

if(isset($_POST['name']) && !empty($_POST['name'])){    
    if(mb_strlen($_POST['name']) > 50 && mb_strlen($_POST['name'] < 1)){
        $message_error['name'] = 'Недопустимое количество символов';
        $error_flag = true;      
    }    
} 

if(isset($_POST['age']) && !empty($_POST['age'])){    
    if($_POST['age'] < 14){
        $message_error['age'] = 'Вам еще рано';
        $error_flag = true;      
    }    
} 

if($error_flag){
    $name = $_POST['name'];
    $age = $_POST['age'];
    if($_POST['gender']){
        $gender = $_POST['gender'];
    }
    $job = $_POST['job'];
}

if ($_FILES && $_FILES['upload_file']['error'] == UPLOAD_ERR_OK)
{

    if(move_uploaded_file($_FILES['upload_file']['tmp_name'], './uploaded_files/'.$_FILES['upload_file']['name']))
    {
      $message ='Файл успешно загружен';
    }
    else
    {
      $message = 'Возникла проблема';
    }
    echo $message;
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
   <h1>Анкета</h1> 
   <form method="POST" action='' enctype='multipart/form-data'>
    <!-- Имя -->
    <div>
        <input type="text" name="name" placeholder="Name" value=<?= $name ?>>
        <?php if(isset($message_error['name'])):?><span style="color: red;"><?= $message_error['name'] ?></span><?php endif; ?>
    </div> 
    <!-- Foto   -->
    <div>
        <input type="file" name="upload_file"> 
    </div>
    <!-- Возраст -->
    <div>
        <input type="number" name="age" placeholder="Age" $value=<?= $age ?>> 
        <?php if(isset($message_error['age'])):?><span style="color: red;"><?= $message_error['age'] ?></span><?php endif; ?>
    </div>
    <!-- Пол/radio -->
    <div>
        <input type="radio" name="gender" value ="m" <?php if($gender == "m") echo "checked" ?>>Male
        <input type="radio" name="gender" value ="f" <?php if($gender == "f") echo "checked" ?>>Female
    </div>
    <!-- Сфера деятельности -->
    <div>
        <select name="job"> <!-- $_POST[job] => developer -->
            <option disabled selected value> -- Сфера деятельности -- </option>
            <?php foreach($array_job as $value=>$title_job):?>
            <option value="<?= $value ?>" <?php if($value==$job)echo "selected"; ?>><?= $title_job ?></option>
            <?php endforeach; ?>
        </select>
    </div>
<hr>
<!-- 
["lessons"]=>
  array(3) {
    [0]=>
    string(10) "JavaScript"
    [1]=>
    string(2) "C#"
    [2]=>
    string(3) "C++"
  } -->
    <p>Что бы Вы хотели изучить:</p>
    <input type="checkbox" name="lessons[]" value = "PHP">PHP<br>
    <input type="checkbox" name="lessons[]" value = "JavaScript">JavaScript<br>
    <input type="checkbox" name="lessons[]" value = "Java">Java<br>
    <input type="checkbox" name="lessons[]" value = "C#">C#<br>
    <input type="checkbox" name="lessons[]" value = "C++">C++<br>
    <input type="checkbox" name="lessons[]" value = "C">C<br>
<hr>
    <!-- Согласие -->
    <input type="checkbox" name="mailing">Подписка<br>
    <input type="checkbox" name="sequrity">Согласие на обработку персональных данных<br>
    <!-- Send form-->
    <input type="submit" name="form_send">
   </form>
</body>
</html>
<?php
//$name = htmlspecialchars(trim($_POST['name']));
?>