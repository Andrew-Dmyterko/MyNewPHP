<?php

$file = "books.us";
$fileDesc = file_get_contents($file);
$books = unserialize($fileDesc);

foreach($books as $book){
    if($book['title'] == $_GET['title']){
        echo "<img src='".$book['image'] ."' width='200px'>";
        echo "<h1>".$book['title'] ."</h1>";
        echo "<h2>".$book['author'] ."</h2>";
        echo "<p>".$book['description'] ."</p>";
    }
}