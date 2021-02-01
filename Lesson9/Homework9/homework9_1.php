<?php
/**
 * Задача 1
 *
 * Дан массив с вопросами и правильными ответами.
 * Реализуйте тест: выведите на экран все вопросы, под каждым инпут.
 * Пользователь читает вопрос, пишет свой ответ в инпут.
 * Когда вопросы заканчиваются - он жмет на кнопку, страница обновляется и вместо инпутов под
 * вопросами появляется сообщение вида: 'ваш ответ: ... верно!' или 'ваш ответ: ... неверно! Правильный ответ: ...'. .
 *
 * Попробуйте реализовать дополнение  к этой задаче -
 * правильно отвеченные вопросы должны гореть зеленым цветом,
 * а неправильно - красным.
 *
 */

$tests = [
    [
        'name' => "q1",
        'q' => "Столица Украины?",
        'a' => "Киев",
        'ua'=> ''
    ],
    [
        'name' => "q2",
        'q' => "Наш любимый язык программирования?",
        'a' => "PHP",
        'ua'=> ''
    ],
    [
        'name' => "q3",
        'q' => "Город в котором мы живем?",
        'a' => "Хмельницкий",
        'ua'=> ''
    ],
    [
        'name' => "q4",
        'q' => "2+2= ",
        'a' => "4",
        'ua'=> ''
    ],
    [
        'name' => "q5",
        'q' => "Что обозначает формула H2O? (Вода,Гелий,Кислород,Аммиак)",
        'a' => "Вода",
        'ua'=> ''
    ],
    [
        'name' => "q6",
        'q' => "Световые волны распространяются быстрее, чем звуковые? Да/Нет",
        'a' => "Да",
        'ua'=> ''
    ]
];

//var_dump($_POST);
if (isset($_POST)&&!empty($_POST)) {
    foreach ($tests as $key => &$test ) {
        // заполняем поле ua ответом пользователя
        $test['ua'] = trim($_POST[$test['name']], "\t\n\r\0\x0B");
        if ($test['a'] === $test['ua']) {
            echo '<h4 style="color: #00cc00">';
            echo ($key+1).".\t".$test['q']." Ваш ответ - \"".$test['ua']."\" Верно!!"." Правильный ответ - ".$test['a'];
            echo "</h4>";
        } else {
            echo '<h4 style="color: #9f1919">';
            echo ($key+1).".\t".$test['q']." Ваш ответ - \"".$test['ua']."\" Неверно!!"." Правильный Ответ - ".$test['a'];
            echo "</h4>";
        }
    }
    echo "<a href='homework9_1.php'>Начало теста</a>";
} else {

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

<form action="homework9_1.php" method="post">
    <?php foreach ($tests as $key => $test ) { ?>
    <div> <?=($key+1).".\t".$test['q'] ?>
        <input name="<?=$test['name']?>" rows="10" cols="45" placeholder="Вводите ответ">
    </div>
  <?php   } ?>
    <div>
        <button type="submit" name="form_send" value="yes">Тест</button>
    </div>
</form>

<hr>

</body>
</html>

<?php } ?>
