<pre>

<?php

//phpinfo();


//$myName = "Юрій ";
//
//$hisName = &$myName;
// // Значення hisName також рівне “Юрій”.
//
//print '$hisName '."$hisName \n";
//print '$myName '."$myName \n";
//
//$hisName = "Олексій";   // Записуємо нові данні в область пам’яті.
//
////print "$hisName  <br>";  // На екран буде виведено  “Олексій”.
//
//print '$myName '."$myName  \n"; // На екран буде виведено  “Олексій”.
//print '$hisName '."$hisName  \n\n";
//
//unset($hisName);
//
//print '$myName '."$myName  \n"; // На екран буде виведено  “Олексій”.
//print '$hisName '."$hisName  \n";

//
//$towmName = "Кам`янець подільський";
//
//
//echo "Стаття називається \n\"$towmName\", вона опублікована в місцевій газеті.\n";


$a='1';


//echo gettype($a);

if ($a === 1) {
    echo "\n true";
} else {
    echo "\n false";
}


$var = 0;

if ($var){
    print '$var = TRUE<br>';
} else {
    print '$var = FALSE<br>';
}

////////////////////////////////
$myValue = 'new';
$yourValue = $myValue;

echo $myValue."\n"; //Який буде результат? 
echo $yourValue."\n"; //Який буде результат? 

unset($myValue);

echo $myValue."\n"; //Який буде результат? 
echo $yourValue."\n"; //Який буде результат? 

// Присвоєння по посиланню
$b = '128';//присвоюємо b = 128 
$a = &$b; //присвоюємо a = ‘a’ 
echo $a."\n";
$b = 10;
echo $a."\n";

// Повернення за посиланням
$a = 1;
$c = 2;
$b =&$a; 	// $b присвоюємо 1
$a =&$c; 	// $a присвоюємо 2, but $b вже 1;
echo $a, " ", $b."\n";

// Цікавий приклад
$a = '128';     //присвоюємо a = 128 
$b = 'a';       //присвоюємо b = ‘a’ 
$c = 128;       //присвоюємо c = 128 
echo $$b+$c."\n";    //який результат? 


$Bar = "a";
$Foo = "Bar";
$World = "Foo";
$Hello = "World";
$a = "Hello";

echo $a."\n"; //Returns Hello
echo $$a."\n"; //Returns World
echo $$$a."\n"; //Returns Foo
echo $$$$a."\n"; //Returns Bar
echo $$$$$a."\n"; //Returns a
echo $$$$$$a."\n"; //Returns Hello
echo $$$$$$$a."\n"; //Returns World

$a = 1234; // десятичное число
$a = 0123; // восьмеричное число (эквивалентно 83 в десятичной системе)
$a = 0x1A; // шестнадцатеричное число (эквивалентно 26 в десятичной системе)
$a = 0b11111111; // двоичное число (эквивалентно 255 в десятичной системе)
//$a = 1_234_567; // десятичное число (с PHP 7.4.0)


$var = '10'; //string
$sum = $var + 10; //integer
echo $sum."---\n";
$new_sum = $var + 1.1; //double
echo $new_sum."***\n";


echo '$var + 10';
echo "<br>";
echo "$var+10";
echo "<br>";
echo $var + "10";

//Функция
echo "\n".getType($var);


$intVar = 10; // це integer  
$floatVar = (float) $intVar; // це double (float)

//Функция
echo "\n".getType($floatVar);


$test = "0";

if ($test) {
    echo "\n true";
}else
    echo "\n false";



$a = 1;

$b = 2;

function test($a) {

    global $a;

    $b = 3;
    echo "b in function = $b";

    echo $a + $b;


}

test($a);





