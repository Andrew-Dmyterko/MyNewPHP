<pre>
<?php

///**
// * Алан
// * 7 - черных
// * 3 - красных
// * 4 - белых
// * 2 - зеленых
// *
// */
//
//$socks = [
//  'black' => 7,
//  'red'   => 3,
//  'white' => 4,
//  'green' => 2
//];
//
//
//$pair_socks =[];
////$a =alan('black', 7);
//
//
//foreach ($socks as $key => $val) {
//
//    $pair_socks[] = alan($key, $val);
//
//}
//
//var_dump($pair_socks) ;
//var_dump($socks) ;
//
//function alan($color, $count) {
//
//    $pair =  (int)round($count/2,0,PHP_ROUND_HALF_DOWN);
//
//    return [$color => $pair];
//
//}
//
// зеленый - 10
// красный - 20
// черній  - 30
// белій   - 40

$socks = [10, 20, 10, 30, 40, 10, 40, 20, 10, 20, 10, 30];
$socks_count = [];
$socks_pair = [];

foreach ($socks as $s) {
    $count =0;
    str_replace($s,$s,$socks,$count);
    $socks_count[$s] = $count;
}
foreach ($socks_count as $key => $values) {
    $socks_pair[$key] = alan($values);
}

var_dump($socks_count);
var_dump($socks_pair);

function alan($count) {

    $pair = (int)round($count / 2, 0, PHP_ROUND_HALF_DOWN);

    return $pair;
}
//
//session_start();
//
//$_SESSION['name'] = "oleg";
//
//$arr = ['fiest', 'second', 'third'];
//$_SESSION['arr'] = $arr;
