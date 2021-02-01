<?php
$message = "";

if (isset($_POST['form_send'])) {
    var_dump($_POST);
    if ($_POST['age'] < 12 ) $message = "Вам еще рано";
    else $message = "";
}

// если есть $_GET['a'] или $_GET['b'] то сумируем
if (isset($_GET['a'])||isset($_GET['b'])) {
    $message = "Ваш GET запрос - ".($_SERVER['REQUEST_URI'])."<br>";
    $message .= (string) $_GET['a']." + ".$_GET['b']." = ".($_GET['a']+$_GET['b']);
}

// если есть $_GET['hi'] то выводим привет/пока
if (isset($_GET['hi'])) {
    if ($_GET['hi']==1) $message = $_GET['hi']." - Привет!!!";
    elseif ($_GET['hi']==2) $message = $_GET['hi']." - Пока!!!";
}

// если нажата кнопка plus_form суммировать то формируем GET запрос с введенными аргументами
if (isset($_POST['plus_form'])) {
    header("Location: homework7.php?a=".$_POST['a']."&b=".$_POST['b']);
}

// если нажата кнопка hi_form Привет/пока то формируем GET запрос с введенными аргументами
if (isset($_POST['hi_form'])) {
    header("Location: homework7.php?hi=".$_POST['hi']);
}

// если нажата кнопка age_form Ваш возраст то выводим возраст
if (isset($_POST['age_form'])) {
    if ($_POST['age_select'] === "20")      $message = "Вам менее 20 лет";
    elseif ($_POST['age_select'] === "20-25")   $message = "Вам 20-25 лет";
    elseif ($_POST['age_select'] === "26-30")   $message = "Вам 26-30 лет";
    elseif ($_POST['age_select'] === "30")      $message = "Вам более 30 лет";
}

// если нажата кнопка hi_form Привет/пока то формируем GET запрос с введенными аргументами
if (isset($_POST['php_form'])) {
    if ($_POST['php_radio'] === "yes")      $message = "Вам нравится PHP!!!";
    elseif ($_POST['php_radio'] === "no")   $message = "Вам не нравится PHP!!!";
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
    <?=$message?>
<!--    --><?php //var_dump($_POST) ?>
    <hr>
    <h3>Анкета</h3>
    <form action="homework7.php" method="post">
        <div>
          <input type="text" name="name" placeholder="Ваше имя?" required>
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
          <input type="checkbox" name="sequrity" value="Yes" required>Согласны на обработку персональных данных?
        </div>
        <div>
            <button type="submit" name="form_send" value="yes">Добавить анкету</button>
      </div>
    </form>

    <hr>

    <h3>Задание 1 </h3>
    <p><pre>Отправьте с помощью GET-запроса два числа. Выведите его на экран сумму этих чисел.
Отправляем в адресной строке
http://edication/worksheet/index.php?a=5&b=6</pre></p>
    <?php
    /**
     * Задание 1
     *
     * Отправьте с помощью GET-запроса два числа. Выведите его на экран сумму этих чисел.
     * Отправляем в адресной строке
     * http://edication/worksheet/index.php?a=5&b=6
     *
     */
    ?>
    <form action="homework7.php" method="post">
        <div>
            <input type="number" name="a" placeholder="Введите переменную A" required>
        </div>
        <div>
            <input type="number" name="b" placeholder="Введите переменную B" required>
        </div>
        <div>
            <button type="submit" name="plus_form" value="yes">Суммировать числа</button>
        </div>
    </form>

    <hr>

    <h3>Задание 2</h3>
    <p><pre>Пусть с помощью GET-запроса отправляется число. Оно может быть или 1, или 2.
Сделайте так, чтобы если передано 1 - на экран вывелось слово 'привет',
а если 2 - то слово 'пока'.</pre></p>
    <?php
    /**
     * Задание 2
     *
     * Пусть с помощью GET-запроса отправляется число. Оно может быть или 1, или 2.
     * Сделайте так, чтобы если передано 1 - на экран вывелось слово 'привет',
     * а если 2 - то слово 'пока'.
     *
     */
    ?>
    <form action="homework7.php" method="post">
        <div>
            <input type="number" name="hi" placeholder="Введите 1 или 2" min="1" max="2" id="dva" required>
        </div>
        <div>
            <button type="submit" name="hi_form" value="yes">Вывести привет/пока</button>
        </div>
    </form>

    <hr>

    <h3>Задание 3</h3>
    <p><pre>Спросите у пользователя его возраст с помощью select.
Варианты ответа сделайте такими: менее 20 лет, 20-25, 26-30, более 30.</pre></p>
    <?php
    /**
     * Задание 3
     *
     * Спросите у пользователя его возраст с помощью select.
     * Варианты ответа сделайте такими: менее 20 лет, 20-25, 26-30, более 30.
     *
     */
    ?>
    <form action="homework7.php" method="post">
        <div>Ваш возраст?
            <select name="age_select" required> <!--Supplement an id here instead of using 'name'-->
                <option disabled selected value="">Выберите возраст</option>
                <option value="20">Менее 20 лет</option>
                <option value="20-25" >20-25</option>
                <option value="26-30" >26-30</option>
                <option value="30">более 30</option>
            </select>
        </div>
        <div>
            <button type="submit" name="age_form" value="yes">Вывести возраст</button>
        </div>
    </form>

    <hr>

    <h3>Задание 4</h3>
    <p><pre>Спросите у пользователя знает ли он PHP с помощью двух radio-кнопок.
Выведите результат на экран. Сделайте так, чтобы по умолчанию один из вариантов был уже отмечен.</pre></p>
    <?php
    /**
     * Задание 4
     *
     * Спросите у пользователя знает ли он PHP с помощью двух radio-кнопок.
     * Выведите результат на экран. Сделайте так, чтобы по умолчанию один из вариантов был уже отмечен.
     *
     */
    ?>
    <form action="homework7.php" method="post">
        <div>Вы знаете PHP?
            <input type="radio" name="php_radio" value="yes" class="radio" checked>Да
            <input type="radio" name="php_radio" value="no" class="radio">Нет
        </div>
        <div>
            <button type="submit" name="php_form" value="yes">PHP</button>
        </div>
    </form>

    <hr>

</body>
</html>
<style>
    #dva {
        width: 10em;
    }
</style>



