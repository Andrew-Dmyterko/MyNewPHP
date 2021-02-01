<pre>
<?php
goto s;
//for($r=1000,$i=0;$r>50;$r/=2, $i++){
//echo $r." ".$i.'<br>';
////$f[]=$r;
//}

//sqrt() abc pow round ceil floor min max rand mt_rand

//$year = 2000;
//
//if ((!($year%4) && ($year%100)) || !($year%400)) {
//    echo "высокосный";
//} else {
//    echo "не высокосный";
//}

//echo "<hr>";
//
//$arr = [1, 5, 3, 0, -1, -2, 19];
//$min = $arr[0];
//foreach ($arr as $val) {
//    if ($min > $val) $min = $val;
//
//}
//echo $min;

$data = "31-12-2020";
$arrData = explode("-", $data);
var_dump($arrData);
for ($i = count($arrData)-1; $i>=0; $i--){
    echo $arrData[$i];
    if ($i<>0) echo ".";
}

echo "<hr>";

$newarr=[];
for ($i = count($arrData)-1; $i>=0; $i--){
     $newarr[] = $arrData[$i];
//    if ($i<>0) echo ".";
}

echo implode(".",$newarr);

echo "<hr>";

$str = "london is the capital of great britain";
$str = ucwords($str);
echo $str;

echo "<hr>";

$dictionaris = [
    'London',
    'Great',
    'Britain',
    'England'
];

$str = "london is the capital of great britain. and london is the largest city of england";


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
// 2й выриант через массивы

echo "<hr>";

$arr = ['a','b','c','d'];
//$arrNew = array_map('up', $arr);
$arrNew = array_map('strtoupper', $arr);
var_dump($arrNew);

//function up($st) {
//    $st = strtoupper($st);
//    return $st;
//}
echo "<hr>";


// реализовать самому!!!!!!
$input = array("a" => "green", "red", "b" => "green", "blue", "red");
print_r($input);
$result = array_unique($input);
print_r($result);

s:

require_once 'book/books.php';

//$a = [1,2,3,4,5,'kkjjhn,olkkjik'];

$a = serialize($books[0]);

echo $a;
//
//$b = unserialize($a);
////
//var_dump($b);