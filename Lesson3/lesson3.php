<pre>
<?php

$age = rand(1,100);

if ($age>=18 && $age<=59 ) {
    echo "Вам $age лет. Еще работать!!!\n";
} elseif ($age>=6 && $age<18) {
    echo "Вам $age лет. Вам учиться!!!\n";
} elseif ($age>=0 && $age<6) {
    echo "Вам $age лет. Вам в садик!!!\n";
} else {
    echo "Вам $age лет. Отдыхаем\n";
}

//echo rand();

echo "<hr>";

$monthes = [
    "Январь",
    "Февраль",
    "Март",
    "Апрель",
    "Май",
    "Июнь",
    "Июль",
    "Август",
    "Сентябрь",
    "Октябрь",
    "Ноябрь",
    "Декабрь"
];

$month = rand(0,15);

if (($month>=0 && $month<=1) || $month==11) {
    echo "$monthes[$month] месяц зимой!!\n";
} elseif ($month>=2 && $month<=4) {
    echo "$monthes[$month] месяц весной!!\n";
} elseif ($month>=5 && $month<=7) {
    echo "$monthes[$month] месяц летом!!\n";
} elseif ($month>=8 && $month<=10) {
    echo "$monthes[$month] месяц осенью!!\n";
} else {
    echo "Какаято фигня $month а не месяц!!!\n";
};


//
echo "<hr>";

$season = rand(0,3);

//$seasons = ['spring', 'summer', 'autumn', 'winter'];

$seasons = array(
    array(
        'name' => 'spring' ,
        'month' => array('March','April', 'May')
    ),
    array(
        'name' => 'summer' ,
        'month' => array('June', 'July', 'August')
    ),
    array(
        'name' => 'autumn' ,
        'month' => array('September','October', 'November')
    ),
    array(
        'name' => 'winter' ,
        'month' => array('December','January', 'February')
    ),
);

echo "Сезон ".$seasons[$season]['name']." месяцы:\n";

switch ($seasons[$season]['name']) {
    case 'spring':
        echo foo($seasons[$season]['month']);
        break;
    case 'summer':
        echo foo($seasons[$season]['month']);
        break;
    case 'autumn':
        echo foo($seasons[$season]['month']);
        break;
    case 'winter':
        foreach ($seasons[$season]['month'] as $mont) {
            echo $mont." ";
        }
        break;
    default:
        echo "дефолтное...";

}

function foo($data)
{
    $str = "";
    foreach ($data as $mont) {
        $str = $str . $mont . " ";
    }
    return $str;
}

echo "<hr>";

/**
 *
 * Дано число $num=1000.
 * Делите его на 2 столько раз, пока результат деления не станет меньше 50.
 * Какое число получится?
 * Посчитайте количество итераций, необходимых для этого (итерация - это проход цикла).
 * Решите задачу сначала через цикл while, а потом через цикл for.
 *
 */

$num =1000;
$count =1;

while ($num >= 50) {
    echo '$num = '.$num." итерация $count\n";
    $num = $num/2;
    $count++;
}

echo "\n\n";

$num =1000;

for ($i=1;$num>=50;$i++) {
    echo '$num = '.$num." итерация $i\n";
    $num = $num/2;
}

echo "<hr>";

//isset();//проверяем или существует
//empty(); //проверяем не пустая ли

$var = "";
echo '$var = "";<br>';

if (isset($var)) {
    echo '$var'."- существует \n" ;
} else echo '$var'." - НЕ существует \n" ;

if (empty($var)) {
    echo '$var'."- пустая \n" ;
} else echo '$var'." - НЕ пустая \n" ;

if (isset($var11)) {
    echo '$var11'."- существует \n" ;
} else echo '$var11'." - НЕ существует \n" ;
if (empty($var11)) {
    echo '$var11'."- пустая \n" ;
} else echo '$var11'." - НЕ пустая \n" ;


$var = null;
echo '<br>$var = null;<br>';

if (isset($var)) {
    echo '$var'."- существует \n" ;
} else echo '$var'." - НЕ существует \n" ;

if (empty($var)) {
    echo '$var'."- пустая \n" ;
} else echo '$var'." - НЕ пустая \n" ;



$var = "1";
echo '<br>$var = 1;<br>';

if (isset($var)) {
    echo '$var'."- существует \n" ;
} else echo '$var'." - НЕ существует \n" ;

if (empty($var)) {
    echo '$var'."- пустая \n" ;
} else echo '$var'." - НЕ пустая \n" ;

$var = "0";
echo '<br>$var = 0;<br>';

if (isset($var)) {
    echo '$var'."- существует \n" ;
} else echo '$var'." - НЕ существует \n" ;

if (empty($var)) {
    echo '$var'."- пустая \n" ;
} else echo '$var'." - НЕ пустая \n" ;

$var = "00";
echo '<br>$var = 00;<br>';

if (isset($var)) {
    echo '$var'."- существует \n" ;
} else echo '$var'." - НЕ существует \n" ;

if (empty($var)) {
    echo '$var'."- пустая \n" ;
} else echo '$var'." - НЕ пустая \n" ;

goto a;
echo 'Foo<br>';
a:
echo 'Bar<br>';

echo "<hr>";

$a = 10;
while ($a > 1) {
    echo "$a\n";
    $a = $a - 1;
}

echo "<hr>";

$a = 10;
do {
    echo "$a\n";
    $a = $a - 1;
} while ($a > 1);

echo "<hr>";

$a = 10;
for ($i = 0; $i < $a; $i++) {
    echo "$i\n";
}
