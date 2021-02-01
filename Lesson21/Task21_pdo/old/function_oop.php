<?php

/**
 * Набор функций для Task21 (задача про книги авторов)
 *
 */
class Books
{
    protected $fileCsv = "books.csv";
    protected $uploadFileDir = 'book/image/';

    /**
     * читаем csv файл и возвращаем массив книг $books
     * false если ошибка
     *
     */
    public function getListBook() {

        $fileCsv = $this->fileCsv;

        $f = fopen($fileCsv, "r+"); // or die("Can't open php://output");// открываем файл для чтения/записи уаазатель в начало файла

        if ($f) {
            // массив после fgetcsv индексный приводим к ассоциативному
            while ($data = fgetcsv($f)) {
                list($book['title'], $book['author'], $book['description'], $book['image']) = $data;
                $books[] = $book;
            }
        } else return false;

        // закрываем файл
        fclose($f);

        return $books;
    }

    /**
     * возвращаем книгу по id (title)
     * false если ошибка
     *
     */
    public function getItemBook($title) {
        $books = $this->getListBook();

        if ($books) {

            foreach ($books as $book) {
                if ($book['title'] == $title) {
                    return $book;
                }
            }
            return false;
        } else return false;
    }


    /**
     * удаляем книгу по id (title)
     * false если ошибка
     *
     */
    public function deleteItemsBook($deleteBook) {

        $books = $this->getListBook();

        if ($books) {

            foreach ($books as $key => $book) {
                if (in_array($book['title'], $deleteBook)) {
                    unset ($books[$key]);
                    continue;
                }
            }

            if (writeToCsv($books, "w") === false) return false;

        } else return false;

        return true;
    }

// проверяем был ли загружен файл и обрабарывем
    public function ifBookUpload($tegFileName) {
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
                $uploadFileDir = $this->uploadFileDir;
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

    /**
     * Пишем массив в csv файл
     * передаем массив и режим открытия файла
     *
     */
    public function writeToCsv(array $books, $mode) {
        $fileCsv = $this->fileCsv;

        $f = fopen($fileCsv,$mode); // открываем файл для чтения/записи уаазатель в начало файла

        if ($f) {
            foreach ($books as $book) {
                if ((fputcsv($f, $book)) === false)  {
                    fclose($f);
                    return false;
                }
            }
            // закрываем файл
            fclose($f);
        } else return false;

        return true;
    }
}


class Html
{

// выводим заголовок страницы
    public function getHeader($title) { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?=$title?></title>
        </head>
        <body>
    <?php }

// выводим футер страницы
    public function getFooter() { ?>
        </body>
        </html>
        <style>
            table, tr, td {
                border: 1px solid black;
                padding: 5px;
            }
        </style>
    <?php }
}











