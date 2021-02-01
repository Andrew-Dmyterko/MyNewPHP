<?php

require_once "books.php";

$file = "book.csv";

$f = fopen($file, "a+");
foreach ($books as $book) {
    fputcsv($f, $book);
}
 fclose($f);