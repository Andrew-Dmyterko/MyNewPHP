<?php

require_once 'function_oop1.php';

//var_dump($_GET);

Html::getHeader("Просмотр книги ". ($_GET['title']));

$book = new Book($_GET['key']);

if ($book->getItemBook()) {
    echo "<img src='".$book->image ."' width='200px'>";
    echo "<h1>".$book->title ."</h1>";
    echo "<h2>".$book->author ."</h2>";
    echo "<p>".$book->description ."</p>";
} else echo "</p> Books list is empty!!! Internal error!!! </p>";

echo "<h5><a href='index.php'>Назад</a></h5>";

Html::getFooter();