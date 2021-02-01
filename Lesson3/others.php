<pre>
<?php
//

echo 'foo' . 42 + 'bar' . 'qwe';
// ответ 0qwe
//'foo' . 42 соединяются как стринг'foo42' приводятся к интеджер тоесть будет 0
// 'bar' приводится к интеджер тоесть будет 0
// 0 + 0 будет 0
// 0 . 'qwe'
// ответ 0qwe

echo "<hr>";

$a = 3;
$b = '3';
if ($a === $b)
        echo '$a равно $b'."\n";
else    echo '$a не равно $b'."\n";
// ответ $a не равно $b'."
// интеджен не эквивалентен стринг
// === эквивалентность тоесть кроме значения сравниваюстя типы

echo "<hr>";

$a = 10;
echo "Value of a = $a";
// ответ Value of a = 10

echo "<hr>";

if (null === 0) {
    echo 'true';
} else {
    echo 'false';
}
// ответ false
// тип null не еквивалентен integer


echo "<hr>";

if (null == 0) {
    echo 'true';
} else {
    echo 'false';
}
// ответ true
// Значение NULL всегда преобразуется в ноль (0).
// а 0 == 0

echo "<hr>";

echo 30 *  5.7;
// ответ 171

echo "<hr>";

$var = "Hello World!";
echo $var ?: "Goodby World!!";
// ответ Hello World!
// тернарная операция условие возвращает true и возвращаем значение после ?
// если его нет то возвращаем шначение  что в условие если
// false то возвращаем значение после :

echo "<hr>";

//$a = 10;
//
//if ($a > 5 OR <15)
//    echo "true";
//else echo "false";
// ответ возникнет ошибка

echo "<hr>";

$a = array(1, 3, 5);
$b = array(2, 4, 6);

$b += $a;
var_dump($b);
// ответ $b = array(2, 4, 6);
//Из официальной документации:
// "Оператор + возвращает левый массив, к которому был присоединен правый массив.
// Для ключей, которые существуют в обоих массивах, будут использованы значения из левого массива,
// а соответствующие им элементы из правого массива будут проигнорированы."

echo "<hr>";

if (-1) print "true";
else print "false";
// ответ true
// -1 приводиться к true.

echo "<hr>";

function a(&$n) {
    ++$n;
}
//function a1($n) {
//    ++$n;
//}
function b($n) {
    return ( a($n) * $n);
}
function c($n) {
    a($n);
    return ($n * $n);
}

//var_dump(a1(5));
//echo a(5);
echo b(5);
echo c(5);
// ответ 036
// в функции b функция a($n)  вернет null потомучто она без return null приводится к 0
// 0 * 6 = 0
// в функции с функция a($n) вернет null но и инкементируе $n до 6     6*6 =36

echo "<hr>";

$str = '1234567890';
echo $str[$str[1]] - $str[$str[3]] + $str[$str[5]];
// oтвет 5
// обращаемся к строке как к элементу массива
// $str[2] - $str[4] + $str[6];
// 3-5+7 = 5

echo "<hr>";

$numeric = 42;
$type = gettype(gettype($numeric + 0.0));
echo $type;
// ответ string
// gettype($numeric + 0.0) - double ---- gettype("double") - string

echo "<hr>";

define('FOO', 10);
$array = array(10 => FOO, "FOO" => 20);
print $array[$array[FOO]] * $array["FOO"];
// ответ 200
// $array[FOO] это 10 (FOO констанка 10) ; $array[10] это FOO а FOO это константа 10
// 10 * 20 = 200
// а вот еслибы было вот так $array = array(10 => "FOO", "FOO" => 20)
// а вот тут $array[FOO] уже "FOO" $array["FOO"] это 20
// а 20 * 20 = 400

echo "<hr>";

$i = 4;
$j = 30;
$k = 0;
$k = $j++/$i++;
echo $i. " " . $j . " " . $k . " ";
// ответ 5 31 7.5
// постинкермент k = 30/4 = 7,5
// а потом i=5 j = 31

echo "<hr>";

$Rent = 250;
function Expenses($Other) {
    $Rent = 250 + $Other;
    return $Rent;
}
Expenses(50);
echo $Rent;
// ответ 250
// все операции в функции Expenses произвожятся с локальными переменными а то что
// эта функция возвращает никуда не присваивается
// а вртом иде обращение к глобальной переменной