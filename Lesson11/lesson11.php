<?php
try {
    $myFile = @fopen('myfile2.txt', 'r');
    if (!$myFile) throw new Exception("Can't open file");
    fclose($myFile);
//  @$c =  5/0;

} catch (Exception $e) {
    echo 'error in line' . $e->getLine();
    echo $e->getMessage();
}
