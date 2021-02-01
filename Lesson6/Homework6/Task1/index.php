<pre>
<?php

/**
 * Задача 1
 *
 * Виведіть список імен своїх улюблених акторів. При натисканні на ім’я актора,
 * по ключу маємо вибрати та вивести з іншого масиву самий відомий фільм з участю вибраного актора.
 * Імена та та посилання необхідно також прочитати з масиву.
 *
 */

require_once 'bd.php';

var_dump($_GET);
if (empty($_GET['id'])) {
    echo "<b>* Задача1</b> \n\n";

    echo "<b>* Список актеров</b>";
    echo '<table border="1">';
    echo '<tr><th>№</th><th>ID актера</th><th>Фамилия,Имя</th><th>Url</th></tr>';

    foreach ($actors as $key => $actor) {
        echo "<tr><td>$key</td><td>".$actor['id']."</td><td>".$actor['actor']."</td><td><a href='index.php?id=".$actor["id"]."'>".$actor['actor']."</a> </td></tr>";
    }

    echo '</table>';
} else {
    echo "<b>* Задача1</b> \n\n";

    $id = $_GET['id'];
    $colum = array_search($_GET["id"], array_column($actors, 'id')); // интересный поиск

    echo "<b>* Список фильмов актера " . $actors[$colum]['actor'] ."</b>";
    echo '<table border="1">';
    echo '<tr><th>№</th><th>ID актера</th><th>Фильм</th><th>imdb</th></tr>';

    foreach ($films as $key => $film) { // поиски в 2х мерном массиве можно сделать через array_map
        if ($film['id'] == $id) {
            if (!isset($max)) $max = $film['imdb'];
            if ($max <= $film['imdb']) $max = $film['imdb'];
            echo "<tr><td>$key</td><td>".$film['id']."</td><td>".$film['film']."</td><td>".$film['imdb']."</td></tr>";
        }
    }
    echo '</table>';

    echo "<br><b>* Самый популярный фильм актера " . $actors[$colum]['actor'] ." </b>";
    echo '<table border="1">';
    echo '<tr><th>№</th><th>ID актера</th><th>Фильм</th><th>imdb</th></tr>';

    foreach ($films as $key => $film) {
        if (($film['id'] == $id)&&($max == $film['imdb']) ) {
            echo "<tr><td>$key</td><td>".$film['id']."</td><td>".$film['film']."</td><td>".$film['imdb']."</td></tr>";
        }
    }
    echo '</table>';

    echo "\n\n $max";
}


echo "\n<hr>\n";