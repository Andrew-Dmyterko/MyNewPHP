<?php

require_once 'function.php';

getHeader("Просмотр книги ". ($_GET['title']));

$book = getItemBook($_GET['title']);

if ($book) {
    echo "<img src='".$book['image'] ."' width='200px'>";
    echo "<h1>".$book['title'] ."</h1>";
    echo "<h2>".$book['author'] ."</h2>";
    echo "<p>".$book['description'] ."</p>";
} else echo "</p> Books list is empty!!! Internal error!!! </p>";

echo "<h5><a href='index.php'>Назад</a></h5>";

getFooter();