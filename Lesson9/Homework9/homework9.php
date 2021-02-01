<!--<pre>-->
<?php
/**
 * Задача 1
 *
 * Дан текстареа и кнопка. В текстареа через пробел вводятся слова.
 * По нажатию на кнопку выведите слова в таком виде: сначала заголовок 'слова на букву а'
 * и под ним все слова, которые начинаются на 'а',
 * потом заголовок 'слова на букву б' и все слова на 'б' и так далее.
 * Буквы должны идти в алфавитном порядке.
 * Брать следует только те буквы, на которые начинаются наши слова.
 * То есть: если нет слов, к примеру, на букву 'в' - такого заголовка тоже не будет.
 *
 */

$letter = "";

if(isset($_POST['words']) && !empty($_POST['words'])){
    $words = $_POST['words'];

//    echo $words;

//    $str = trim($words, " \t\n\r\0\x0B");

    // очищаем строку от ненужных символов заменяем их на пробел
    $words = str_replace(["\n","\t","\r","\x0B"], " ", $words);

    // переводим строку в массив
    $words_array = explode(" ", $words);
    // чистим массив от пустых записей
    $words_array = array_values(array_diff($words_array, array('')));
    // сортируем масив по алфавиту
    sort($words_array);
//    echo var_dump($words_array);

    foreach ($words_array as $value) {
        // беру mb_substr для корректного отображения русских символов
        if ($letter !== mb_substr($value, 0, 1)) {
            $letter = mb_substr($value, 0, 1);
            echo "<hr>Cлова на букву ".$letter."<br>";
            echo $value."<br>";
        } else echo $value."<br>";
    }
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

<form action="homework9.php" method="post">
    <div>
        <textarea name="words" rows="10" cols="45" placeholder="Вводите слова"></textarea>
    </div>
    <div>
        <button type="submit" name="form_send" value="yes">Поиск слов</button>
    </div>
</form>

<hr>

</body>
</html>
<pre>
