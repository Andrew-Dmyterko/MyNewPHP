<pre>

<?php
$a = 1;

$b = 2;

function test($a) {

    global $a;

    $b = 3;
    echo "b in function = $b";

    echo $a + $b;


}

$b=0;
$c=0;


test1();
test1();
test1();
test1();

function test1() {
    global $b;
    echo $b++;

}

echo "\n";

test2($c);
test2($c);
test2($c);
test2($c);
test2($c);
test2($c);


function test2(& $m) {

    echo $m++;
}
function str_split_unicode($str, $length = 1) {
    $tmp = preg_split('~~u', $str, -1, PREG_SPLIT_NO_EMPTY);
    if ($length > 1) {
        $chunks = array_chunk($tmp, $length);
        foreach ($chunks as $i => $chunk) {
            $chunks[$i] = join('', (array) $chunk);
        }
        $tmp = $chunks;
    }
    return $tmp;
}

$myWorld = 'Привет';
echo $myWorld;
$myWorldarray = str_split_unicode($myWorld);
var_dump($myWorldarray);
$m = (string) $myWorld[0];
$n = $myWorld[4];

$myWorld1[] = explode('','Привет аларарп');

die();


define("PI", 3.1415);

echo "\n".PI;

//PI = 325151;

//define("PI", 251616);

echo "\n".PI;


$a = 1;

$b = $a++ + 8;   //1
echo "\n $b  $a\n";

$b = ++$a + 8;  //3
echo " $b  $a\n";

$b =  2* ++$a + 8;  //3
echo " $b  $a\n";


$str = "flgfgflkjg";


$a--;//$a = $a - 1;

echo "\n-----------\n";

//test4(23);
//
//
//function test4($r) {
//
//    if ($r%2) {
//        echo "\n $r нечетное";
//    } else {
//        echo "\n $r четное";
//    }
//
//}


$myArray[10] = "dfdf";


$newArray =array();

$a = 0;

for ($i=1; $i<=100; $i++) {
    $newArray[]=$i;
}


var_dump($newArray);

echo count($newArray)."\n";

echo implode($newArray,",");


echo "\n-------------------------\n";

$newArray1 = [];

$newArray1[] = 0;
$newArray1[] = 1;
//var_dump($newArray1);


foreach ($newArray1 as $value) {

    $newArray1[] = $a++;
    var_dump($newArray1);
    echo $value;
reset($newArray1);
//    if ($a=100) exit;

}

echo "\nstop\n";

//$n = 3;
//
//$a = [1,2];
//
//var_dump($a);
//
//foreach($a as &$v) {
//    echo "\n$v";
//    $a[count($a)]=$n++;
//    if ($n==100) exit;
//}
//
//var_dump($a);


$a = [1,2]; // должен быть как минимум один єлемент в массиве иначе не войдем в foreach или вернее сразу выйдем :)
foreach($a as &$v) {
//    echo "$v\n";
    $a[count($a)]=count($a)+1;
    if (count($a)==100) break;
}

var_dump($a);

?>
