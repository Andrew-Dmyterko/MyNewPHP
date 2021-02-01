<?php



class Book
{
    /**
     * возращает список книг из файла
     */

    public $key;
    private $title;
    private $author;
    private $description;
    private $image;

    static protected $fileCsv = "books.csv";
    static protected $uploadFileDir = 'book/image/';

    /**
     * метод принимает текстовое значение,
     * проверяет количество символов
     * и присваивает его в свойство $title
     */
    function __construct($key,$title="",$author="",$description="",$image="")
    {
        $this->key = $key;
        $this->title = $title;
        $this->author = $author;
        $this->description = $description;
        $this->image = $image;
    }

    /**
     * читаем csv файл и возвращаем массив книг $books
     * false если ошибка
     *
     */
    public static function getListBook()
    {

        $fileCsv = self::$fileCsv;

        $f = fopen($fileCsv, "r+"); // or die("Can't open php://output");// открываем файл для чтения/записи уаазатель в начало файла

        if ($f) {
            // массив после fgetcsv индексный приводим к ассоциативному
            while ($data = fgetcsv($f)) {
                list($book['key'], $book['title'], $book['author'], $book['description'], $book['image']) = $data;
                $books[$book['key']] = $book;
            }
        } else return false;

        // закрываем файл
        fclose($f);

        return $books;
    }

    /**
     * присваивает значение всем существующим свойствам,
     * к которым пользоватль обратился напрямую
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    /**
     * выдает значение всех существующих свойств,
     * к которым пользоватль обратился напрямую
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
           return $this->$property;
        }
    }

    public function getItemBook() {

        $books = self::getListBook();

        if ($books) {

            foreach ($books as $key => $book) {
                if ($book['key'] == $this->key) {

                    $this->title = $book['title'];
                    $this->author = $book['author'];
                    $this->description = $book['description'];
                    $this->image = $book['image'];

                    return true;
                }
            }
            return false;
        } else return false;
    }

    // проверяем был ли загружен файл и обрабарывем
    public static function ifBookUpload($tegFileName) {
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
                $uploadFileDir = self::$uploadFileDir;
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
     * Пишем объект в csv файл
     *
     */
    public function write() {

        $book = [
            'key' => $this->key,
            'title' => $this->title,
            'author' => $this->author,
            'description' => $this->description,
            'image' => $this->image,
        ];

        $fileCsv = self::$fileCsv;

        $f = fopen($fileCsv,"a+"); // открываем файл для чтения/записи уаазатель в начало файла

        if ($f) {
                if ((fputcsv($f, $book)) === false)  {
                    fclose($f);
                    return false;
                }
            // закрываем файл
            fclose($f);
        } else return false;

        return true;
    }

    /**
     * удаляем книгу по id (title)
     * false если ошибка
     *
     */
    public static function deleteItemsBook($deleteBook) {

        $books = self::getListBook();
        file_put_contents(self::$fileCsv, ''); //чистим файл

        if ($books) {

            foreach ($books as $key => $book) {
                if (in_array($book['title'], $deleteBook)) {
                    unlink($book['image']); // удаляем файл с удалением записи (проверку на удаление не делаю пока)
                    unset ($books[$key]);
                    continue;
                }

                $bookToWrite = new Book($book['key'],$book["title"],$book["author"],$book["description"],$book['image']);

                $bookToWrite->write();
            }

        } else return false;

        return true;
    }

    /**
     * обновляем данные обекта
     */
    public function update() {

        $key = $this->key;
        $title = $this->title;
        $author = $this->author;
        $description = $this->description;
        $image = $this->image;

        $books = Book::getListBook();

        file_put_contents(self::$fileCsv, ''); //чистим файл

        foreach($books as &$book){
            if($book['key'] == $key) {

                $book['key'] = $key;
                $book['title'] = $title;
                $book['author'] = $author;
                $book['description'] = $description;
                $book['image'] = $image;
            }
            $bookToWrite = new Book($book['key'],$book["title"],$book["author"],$book["description"],$book['image']);

            $bookToWrite->write();
        }
    }

}

class Html
{

// выводим заголовок страницы
    public static function getHeader($title) { ?>
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
    public static function getFooter() { ?>
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