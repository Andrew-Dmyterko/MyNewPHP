<pre>
<?php
//goto s;
/**
 * Задача 1 вариант 1
 *
 * В переменной $date лежит дата в формате '31-12-2030'.
 * Преобразуйте эту дату в формат '2030.12.31'.
 *
 */

echo "Задача 1 вариант 1 \n\n";

$data = "31-12-2020";
echo $data."\n";

$arrData = explode("-", $data);
var_dump($arrData);
for ($i = count($arrData)-1; $i>=0; $i--){
    echo $arrData[$i];
    if ($i<>0) echo ".";
}

echo "<hr>";

/**
 * Задача 1 вариант 2 (разворачиваем массив)
 *
 * В переменной $date лежит дата в формате '31-12-2030'.
 * Преобразуйте эту дату в формат '2030.12.31'.
 *
 */

echo "Задача 1 вариант 2 (разворачиваем массив)\n\n";

$data = "31-12-2020";
echo $data."\n";
$newarr=[];
for ($i = count($arrData)-1; $i>=0; $i--){
    $newarr[] = $arrData[$i];
//    if ($i<>0) echo ".";
}

echo implode(".",$newarr);

echo "<hr>";

/**
 * Задача 2
 *
 * Дана строка 'london is the capital of great britain'.
 * Сделайте из нее строку 'London Is The Capital Of Great Britain’.
 *
 */
echo "Задача 2 \n\n";
$str = "london is the capital of great britain";
echo $str."\n";
$str = ucwords($str);
echo $str;

echo "<hr>";

/**
 * Задача 3 вариант 1 через реплейс строк
 *
 * Дана строка ‘london is the capital of great britain. and london is the largest city of england’.
 * Привести ее к правильному виду.
 *
 */

$dictionaris = [
    'London',
    'Great',
    'Britain',
    'England'
];
echo "Задача 3 вариант 1 через реплейс строк\n\n";
$str = "london is the capital of great britain. and london is the largest city of england";
echo $str."\n";

foreach ($dictionaris as $val) {
    $str = str_ireplace($val, $val, $str);
};

$sentensis = explode(".", $str);

foreach ($sentensis as &$val) {
    $val = ucfirst(trim($val));
//    echo $val;
}

$str = implode(". ", $sentensis);
echo $str;

echo "<hr>";

/**
 * Задача 3 вариант 2 через массивы
 *
 * Дана строка ‘london is the capital of great britain. and london is the largest city of england’.
 * Привести ее к правильному виду.
 *
 */

$dictionaris1 = [
    'London',
    'Great',
    'Britain',
    'England'
];
echo "Задача 3 вариант 2 через массивы\n\n";
$str1 = "london is the capital of great britain. and london is the largest city of england";
echo $str1."\n";

$str1 = str_ireplace($dictionaris1, $dictionaris1, $str1);

$sentensis1 = explode(".", $str1);

foreach ($sentensis1 as &$val11) {
    $val11 = ucfirst(trim($val11));
//    echo $val;
}

$str1 = implode(". ", $sentensis1);

echo $str1;

echo "<hr>";

/**
 * Задача 4
 *
 * Дана переменная $password, в которой хранится пароль пользователя.
 * Если количество символов пароля больше 5-ти и меньше 10-ти,
 * то выведите пользователю сообщение о том, что пароль подходит,
 * иначе сообщение о том, что нужно придумать другой пароль. (strlen)
 *
 */

echo "Задача 4 \n\n";

$password = 'dvd*90$X#@';
echo $password."\n";
if (strlen($password)>=5 && strlen($password)<=10) {
    echo "GoodPass!!! - ".strlen($password);
} else {
    echo "BadPass!!! - ".strlen($password);
}

echo "<hr>";

/**
 * Задача 5
 *
 * Дана строка. Проверьте, что она заканчивается на '.png' или на '.jpg'.
 * Если это так, выведите 'да', если не так - 'нет'.(substr)
 *
 */

echo "Задача 5 \n\n";

$shablon = ['.png', '.jpg'];
//$str = 'dcd.pngdfgg.jpg';

$str = 'dcd.pngdfgg';

print_r($shablon);
echo $str."\n";

//echo substr($str, -4);
if (array_search(substr($str, -4),$shablon)) {
    echo "да";
} else echo "нет";

echo "<hr>";

/**
 * Задача 5 вариант 1 через foreach
 *
 * Дана строка. Проверьте, что она заканчивается на '.png' или на '.jpg'.
 * Если это так, выведите 'да', если не так - 'нет'.(substr)
 *
 */

echo "Задача 5 вариант 1 через foreach\n\n";

$shablons = ['.png', '.jpg', '.docx', '.xlsx'];

$str = 'dcd.png.xlsxdfgg.docx.xlsx';
//$str = 'dcd.pngdfgg.jpg';
print_r($shablons);
echo $str."\n";

foreach ($shablons as $shablon ) {
    echo $shablon." ";
    if ($shablon == (substr($str, strlen($shablon)*-1))) {
        echo substr($str, strlen($shablon)*-1)." - да\n";
    } else echo substr($str, strlen($shablon)*-1)."- нет\n";

}

echo "<hr>";

/**
 * Задача 6
 * Дана строка с буквами и цифрами,
 * например, '1a2b3c4b5d6e7f8g9h0'.
 * Удалите из нее все цифры.
 * То есть в нашем случае должна получится строка 'abcbdefgh'.(str_replace)
 *
 */

echo "Задача 6 \n\n";

$str = '1a2b3c4b5d6e7f8g9h0';
$shablon = [1,2,3,4,5,6,7,8,9,0];

echo $str."\n";
$str = str_replace($shablon, "", $str,$i);
echo $str." ".$i;

echo "<hr>";
//s:
/**
 * Задача 7
 *
 * У нас есть список книг с описанием, надо вывести список в виде таблицы,
 * причем описание должно быть не больше 100 символов,
 * если больше обрезаем по окончанию предложения.
 *
 */

echo "<b>* Задача7</b>\n\n";
echo "<b>* Список книг</b>";
echo '<table border="1">';
echo '<tr><th>№</th><th>Title</th><th>Author</th><th>Description</th><th>Image</th></tr>';


require_once 'book/books.php';
//require_once '/var/www/html/MyNewPHP/Lesson4/book/books.php';

//var_dump($books);

foreach ($books as $key => $book) {
    $description = explode(' ', $book['description']);
    $desc1 = " ";
    foreach ($description as $index => $desc ) {
        if (mb_strlen($desc1.$desc)<= 100) {
            $desc1 = $desc1.$desc." ";
        } else break;
    }
//    echo $desc1." ".mb_strlen($desc1)."\n";
$desc1 = trim($desc1)."...".mb_strlen($desc1)."\n";

//    echo $description[0]." ".strlen($description[0])."\n";

    echo "<tr><td>".($key+1)."</td><td>".$book['title']."</td><td>".$book['author']."</td><td>".$desc1."</td><td>"."<img src=".$book['image'].' width="100"'."></td></tr>";
}

echo '</table>';

echo "<hr>";
//die();
/**
 * Задача 8
 *
 * Дан массив с элементами 1, 2, 3, 4, 5.
 * Выведите на экран его первый и последний элемент без использования цикла,
 * причем так, чтобы в исходном массиве они исчезли.
 *
 */

echo "Задача 8 \n\n";

$arr = [1,2,3,4,5];

print_r($arr);

echo "array_pop - ".array_pop($arr)."\n"; // Извлекает последний элемент массива

print_r($arr);

echo "array_shift - ".array_shift($arr)."\n"; // Извлекает первый элемент массива

print_r($arr);

echo "<hr>";

/**
 * Задача 9
 *
 * Дан массив с элементами 1, 2, 3, 4, 5 и массив с элементами 3, 4, 5, 6, 7.
 * Запишите в новый массив элементы, которые есть и в том, и в другом массиве.
 *
 */

echo "Задача 9 \n\n";

$a1 = [1,2,3,4,5];
$a2 =     [3,4,5,6,7];

print_r($a1);
print_r($a2);

$newArr = array_intersect($a1,$a2); // array_intersect — Вычисляет схождение массивов
var_dump($newArr);

echo "<hr>";

/**
 * Задача 10
 *
 * Дан массив с элементами 'a'=>1, 'b'=>2, 'c'=>3.
 * Выведите на экран случайный ключ из данного массива.
 *
 */

echo "Задача 10 \n\n";

$arr1 = [
    'a'=>1,
    'b'=>2,
    'c'=>3
];

print_r($arr1);

$rand_keys = array_rand($arr1, 1);

echo $rand_keys;

echo "<hr>";

/**
 * Задача 11
 *
 * Дан массив с элементами 'a'=>1, 'b'=>2, 'c'=>3.
 * Выведите на экран случайный элемент данного массива.
 *
 */

echo "Задача 11 \n\n";

$arr2 = [
    'a'=>1,
    'b'=>2,
    'c'=>3
];

print_r($arr2);

$rand_keys = array_rand($arr2, 1);

echo $rand_keys."\n";
echo $arr2[$rand_keys];

echo "<hr>";

/**
 * Задача 12
 *
 * Задача для разминки
 * Есть массив с техникой $ar = ['switch','tv','switch','tv','switch'];
 * Необходимо перезаписать в новый масиив так, чтобы повторющиемуся элементу в конце добавлять 1, 2 и тд.
 * Результат должен быть ['switch','tv','switch1','tv1','switch2'];
 *
 */

echo "Задача 12 \n\n";

$ar = ['switch','tv','switch','dvd','tv','switch','switch','tv','switch','tv','dvd'];
//$ar1 = $ar;

foreach ($ar as $value) {
    $i="";
    foreach ($ar as &$value1) {
        if ($value == $value1) {
            $value1 = $value1.$i++;
        }
    }
}

print_r($ar);

echo "<hr>";

echo "Задача 12 вариант Лены\n\n";

$ar = ['switch','tv','switch','tv','switch'];
$new_ar = array();
foreach($ar as $v){
    $a = $v;
    $count = 1;
    while(in_array($a,$new_ar)){
        $a = $v.$count++;
    }
    $new_ar[] = $a;
}
echo "<pre>";
var_dump($new_ar);
echo "</pre>";