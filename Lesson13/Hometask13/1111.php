<?php

$name = ('book.txt');
/**
 * дістаємо перелік книг
 * дістати з файлу стрічку і переробка в масив
 */
function getListBook()
{
    global $name;
    $str = file_get_contents($name);
    $books = unserialize($str);
    return $books;
}

function getItemBook($title)
{
    $books = getListBook();
    foreach ($books as $book) {
        if ($book['title'] == $title) {
            return $book;
        }
    }
    return false;
}

function putListBook($books)
{
    global $name;
    // новый массив преобразуем в строку для записи - serialize
    $books_str = serialize($books);
    // Записываем новую строку в файл -
    file_put_contents($name, $books_str);
}

function noValidate($title, $author)
{
    $error = false;
    if (!isset($title) || empty($title)) {
        $error = true;
    }

    if (!isset($author) || empty($author)) {
        $error = true;
    }
    return $error;
}
function addImage($file, $title)
{
    $image = '';
    //проверяем загужен ли файл и загружен без ошибок
    if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
        $ext = explode('/', $file["type"]);
        $name = $title . "." . $ext[1];

        //переносим наш файл из временной папки tmp_name в нашу папку img/ и взяли его название
        /**
         * $e = explode('/', $_FILES["book_foto"]["type"]); расширение файла
         * "какое-то свое имя.".$e
         */

        if (move_uploaded_file($file['tmp_name'], 'img/' . $name)) {
            $image = 'img/' . $name;
        }
    }
    return $image;
}

function myPrint($array)
{
    echo '<pre>';
    var_dump($array);
    echo '</pre>';
}
