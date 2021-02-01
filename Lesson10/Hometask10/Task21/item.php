<?php

$fileCsv = "books.csv";
$f = fopen($fileCsv,"r+"); // открываем файл для чтения/записи уаазатель в начало файла

$books = [];
// массив после fgetcsv индексный приводим к ассоциативному
while ($data = fgetcsv($f)) {
    list($book['title'],$book['author'], $book['description'],$book['image']) = $data;
    $books[] = $book;
}
// закрываем файл
fclose($f);

foreach($books as $book){
    if($book['title'] == $_GET['title']){
        echo "<img src='".$book['image'] ."' width='200px'>";
        echo "<h1>".$book['title'] ."</h1>";
        echo "<h2>".$book['author'] ."</h2>";
        echo "<p>".$book['description'] ."</p>";
    }
}
echo "<h5><a href='index.php'>Назад</a></h5>";