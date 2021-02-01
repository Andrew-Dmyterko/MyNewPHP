<?php
/**
 * Набор функций для Task21 (задача про книги авторов)
 *
 */

$books = []; // массив книг

// читаем csv файл и формируем массив книг $books
function getBooksArray() {

    $fileCsv = "books.csv";
    $f = fopen($fileCsv,"r+"); // открываем файл для чтения/записи уаазатель в начало файла
    global $books;
    // массив после fgetcsv индексный приводим к ассоциативному
    while ($data = fgetcsv($f)) {
        list($book['title'],$book['author'], $book['description'],$book['image']) = $data;
        $books[] = $book;
    }
    // закрываем файл
    fclose($f);
}

// проверяем был ли загружен файл и обрабарывем
function ifBookUpload($tegFileName) {
    $error_flag = ""; // флаг ошибок
    if (isset($_FILES[$tegFileName]) && $_FILES[$tegFileName]['error'] === UPLOAD_ERR_OK) {

        $fileTmpPath = $_FILES[$tegFileName]['tmp_name']; //временый путь
        $fileName = $_FILES[$tegFileName]['name'];
        $fileSize = $_FILES[$tegFileName]['size'];
        $fileType = $_FILES[$tegFileName]['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');

        if (in_array($fileExtension, $allowedfileExtensions)) {
            // directory in which the uploaded file will be moved
            $uploadFileDir = 'book/image/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $message = 'Файл успешно загружен.';
            } else {
                $message = 'Возникла проблема при загрузке.';
                $error_flag = true;
            }
            //  echo $message;
        } else {
            $error_flag = true;
            $message = "Не загружен не то расширение.";
        }

    } else {$error_flag = true; $message = "Ошибка загрузки.";}

    return ['error_flag' => $error_flag,
            'error_code' => $_FILES['uploadedFile']['error'],
            'message'    => $message,
            'file_name'  => $fileName,
            'file_size'  => $fileSize,
            'file_type'  => $fileType,
            'dest_path'  => $dest_path
        ];
}

function getHeader($title) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
</head>
<body>
<?php }

function getFooter() { ?>
</body>
</html>
<style>
    table, tr, td {
        border: 1px solid black;
        padding: 5px;
    }
</style>
<?php } ?>