<?php
/**
 * Задача Blog
 *
 * Попробуйте сделать небольшой блок со статьями,
 * когда текст каждой статьи находится в текстовом файле
 * в одной папке (для 1 статьи один файл).
 * Главная страница выводит список статьей (заголовки),
 * при нажатии на статью переходим на страницу одной статьи (Заголовок, текст)
 *
 * версия когда все берем из файла первая строка хедер
 * вторая краткое описание
 * остальное текст
 *
 */

// подключили header
require_once "./header.php";

echo "<pre>";
echo '<div style="text-align: center;"><h2>Новости кино</h2></div><hr>';
if (!isset($_GET['id'])) {
    // если нету id выводим все строки
    $dir = 'blog_file';
    $files1 = array_values(array_diff(scandir($dir), ['.', '..']));
    $files2 = array_values(array_diff(scandir($dir, 1), ['.', '..']));

    //print_r($files1);
    //print_r($files2);

    foreach ($files1 as $file) {
        //    echo $file;
        $f = fopen("blog_file/" . $file, "r");

        $a_header = fgets($f); // читаем первую строку это заглавие
        $a_summary = fgets($f); // читаем вторую строку это краткое содержание

        echo "<h2><a href='index.php?id=" . $file . "'>" . $a_header . "</a></h2>";
        echo "<h3>" . $a_summary . "</h3>";
        echo "<hr>";
        fclose($f);
    }
} else {
    // если есть проваливаемся в статью
    $f = fopen("blog_file/" . $_GET['id'], "r");

    $a_header = fgets($f); // читаем первую строку это заглавие
    $a_summary = fgets($f); // читаем вторую строку это краткое содержание

    echo "<h2>" . $a_header . "</h2>";
    echo "<h5><a href='index.php'>Назад</a></h5>";

    echo "<h3>" . $a_summary . "</h3>";
    echo "<p>";

    while ($str_article = fgets($f) ) {
        echo $str_article;
    }
    echo "</p>";
}

// подключили header
require_once "./footer.php";