<pre>

<?php
$a = 1;

$b = 2;

function test() {

    global $a;

    $b = 3;

    echo "b from function = ".$GLOBALS['b']."\n";
    echo "b in function = $b\n";

    echo $a + $b."\n";
    echo $a + $GLOBALS['b'];


}
$a = 1; /* глобальная область видимости */

function tes()
{
    echo $a; /* ссылка на переменную в локальной области видимости */
}

test();


tes();

echo "<hr>";

function testStatic()
{
    static $a = 0;
    echo $a;
    $a++;
}

function testStatic1()
{
    static $a = 7;
    echo $a;
    $a++;
}


testStatic();
testStatic();
testStatic();
testStatic();

echo "\n";
testStatic1();
testStatic1();
testStatic1();


echo "\n";
testStatic();
testStatic();
testStatic();

echo "\n";
testStatic1();
testStatic1();
testStatic1();

echo "\n";
echo $a;










//$b=0;
//$c=0;
//
//
//
//function test1() {
//    global $b;
//    echo $b++;
//
//}
//
//
//function test2(& $m) {
//
//    echo $m++;
//}
