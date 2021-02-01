<pre>
<?php

//goto s;
/**
 * Задача 1
 *
 * Сделайте функцию, которая параметрами принимает 2 числа.
 * Если эти числа равны - пусть функция вернет true,
 * а если не равны - false.
 *
 */

echo "Задача 1 \n\n";

$val1 = 5;
$val2 = 15;

echo "$val1\n$val2\n".func1($val1,$val2);

function func1($a, $b) {
    if ($a == $b) {
        return "true";
    }
    else {
        return "false";
    }
}

echo "<hr>";

/**
 * Задача 2
 *
 * Создайте функцию, которая преобразует строку 'var_text_hello' в 'varTextHello'.
 * Скрипт должен работать с любыми стоками такого рода.
 *
 */
//s:
echo "Задача 2 \n\n";

$shablon = ['_','+'];
//$str2 = 'var_text_hello';
$str2 = '_text_to_up___+_text_+';
//$str2 = 'text_to_up____text_';

echo strTransfer2($str2,$shablon);

function strTransfer2($str, $strShablon) {
    $str = lcfirst(str_replace($strShablon, '', trim(ucwords($str, "_"))));
//    $str = trim(str_replace("_", " ", $str));
    return $str;
}

// вариант Лены
//function f($str){
//    $str_arr = explode('_', $str);
//    for($i= 1; $i<count($str_arr);$i++){
//        $str_arr[$i] = ucfirst($str_arr[$i]);
//    }
//    return implode($str_arr);
//}
//$str="var_text_hello";
//echo f($str2);

//die;

echo "<hr>";

/**
 * Задача 3
 *
 * Пусть в корне вашего сайта лежит файл test.txt,
 * в котором записан текст '12345'.
 * Откройте этот файл, запишите в конец текста восклицательный знак и сохраните новый текст обратно в файл.
 *
 */

echo "Задача 3 \n\n";

$file = 'test.txt';

$f = fopen($file, "a+");

echo "read test.txt... \n";
echo "----------test.txt---------- \n";
while (!feof($f)) {
    echo fread($f,1);
}
echo "\n----------test.txt---------- \n";

$str3 = "!";
echo "write '!' to the eof test.txt... \n";
echo "----------test.txt---------- \n";

fwrite($f,$str3);

fseek($f,0);

while (!feof($f)) {
    echo fread($f,1);
}

echo "\n----------test.txt---------- \n";

fclose($f);

echo "<hr>";

/**
 * Задача 4
 *
 * Пусть в корне вашего сайта лежат файлы 1.txt, 2.txt и 3.txt.
 * Вручную сделайте массив с именами этих файлов.
 * Переберите его циклом, прочитайте содержимое каждого из файлов,
 * слейте его в одну строку и запишите в новый файл new.txt.
 * Изначально этого файла не должно быть.
 *
 */

echo "Задача 4 \n\n";

$files = [
    '1.txt',
    '2.txt',
    '3.txt'
    ];

$newFile = "new.txt";
echo "читаем '1.txt', '2.txt', '3.txt....'\n";
$strToWrite = (array_map('file_get_contents',$files));
$strToWrite = str_replace(["\n"], '', $strToWrite); // чистим от возвратов каретки

echo "Пишем в new.txt\n";

//echo $strToWrite;

file_put_contents($newFile, $strToWrite); // пишем в файл

echo "Читаем из new.txt\n";

echo "----------test.txt----------\n";
echo file_get_contents($newFile);
echo "\n----------test.txt----------\n";


echo "<hr>";

/**
 * Задача 5
 *
 * Дополнительно переносим наш список книг в файл,
 * массив с книгами преобразуем в необходимый вид с помощью функции serialize(),
 * соответвсенно при считывании из файла возвращаем к типу массив функцией unserialize()
 *
 */

//s:
echo "Задача 5 \n\n";

require_once 'books.php';

$filesToWrite = 'books.us';

$usBooks = serialize($books);

file_put_contents($filesToWrite, $usBooks);

// читаем сериализированый файл books.us
$newRead = file_get_contents($filesToWrite);

echo "Прочитали сериализированый books.us. делаем unserialize в массив и выводим var_damp...\n";
$newBooks = unserialize($newRead);

var_dump($newBooks);

echo "<hr>";
// сдеать через свою функцию