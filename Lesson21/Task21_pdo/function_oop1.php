<?php

session_start();

if (isset($_SESSION['Messages'])) {
    echo '<div>'.$_SESSION['Messages'].'</div>';
    unset ($_SESSION['Messages']);
}

if (isset($_POST['login_send']) && (!empty($_POST['login']) || (!empty($_POST['password']) ))) {
    $passwd = [
        [
            'login' => 'Admin',
            'password' => 'e10adc3949ba59abbe56e057f20f883e', //123456
            'userName' => 'Ivan Ivanov',
        ],
        [
            'login' => 'Sky_Fox',
            'password' => '202cb962ac59075b964b07152d234b70', //123
            'userName' => 'Andrew',
        ]
    ];

    $passwordMd5 = md5($_POST['password']);

    foreach ($passwd as $key => $user) {
        if ($user['login'] === $_POST['login'] && $user['password'] === $passwordMd5) {

            $_SESSION['user_session_id'] = session_id();
            $_SESSION['user_id'] = $key;
            $_SESSION['userName'] = $user['userName'];
            $_SESSION['user'] = $user['login'];
            $_SESSION['time'] = time();

        }
    }
    if (!isset($_SESSION['user_session_id'])) {
        $_SESSION['Messages'] = 'Sorry!! Invalid username or password!!';
        header('Location: index.php');
    }
}

$name = trim(basename($_SERVER['SCRIPT_FILENAME'].PHP_EOL));

$allowPage = ['index.php','item_oop1.php'];

if (!(in_array($name,$allowPage)) && (!isset($_SESSION['user_session_id']))) {
    $error = 'error';
}

if (isset($_SESSION['user_session_id']) && (time() - $_SESSION['time'] >= 600) ) {
    $error = 'error';
}

if (isset($_POST['logout_send'])) {
    $error = 'logout';
}

if (isset($_SESSION['user_session_id'])) {
    $_SESSION['time'] = time();
    ?>

    <form method="POST" action='' enctype='multipart/form-data'>
        <div>
            <button type="submit" name="logout_send" value="logout_send">Logout <?=$_SESSION['userName'] ?></button>
        </div>
    </form>
    <hr>

    <?php
} else { ?>

    <form method="POST" action='' enctype='multipart/form-data'>
    <!-- Имя -->
    <div>
        <input type="text" name="login" placeholder="Login">
    </div>
    <!-- Пароль -->
    <div>
        <input type="password" name="password">
    </div>
    <div>
        <button type="submit" name="login_send" value="login_send">Login</button>
    </div>
</form>
<hr>

<?php }

if (isset($error)) {
    //<<<-----Правильное уничтожение сессии ----->>>
//    $_SESSION = []; // чистим суперглобальную переменную
//    if (isset($_COOKIE[session_name()])) {
//    setcookie(seession_name(),'',time()-3600,'/');
//    }

    session_unset();
//    session_destroy();

    header('Location: index.php');
    exit;
}

class PdoToBook {

    private static $driver = 'mysql';
    private static $host = 'localhost';
    private static $db_name = 'book_db';
    private static $db_user = 'root';
    private static $db_pass = '650351';
    private static $charset = 'utf8';
    private static $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];


    public static function dbConnect(){

        $driver = self::$driver;
        $host = self::$host;
        $charset = self::$charset;
        $db_name = self::$db_name;
        $db_user = self::$db_user;
        $db_pass = self::$db_pass;
        $options = self::$options;

        try {
            $pdo = new PDO("$driver:host=$host;dbname=$db_name;charset=$charset",$db_user,$db_pass,$options);
            return $pdo;

        }catch (PDOException $e) {
            die ("Не могу подключиться к базе данных");
        }

        $DBH = null;
    }

    public static function getUser () {}
}

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
        $pdo = PdoToBook::dbConnect();

        $result = $pdo->query('SELECT * from books');

        while ($book = $result->fetch(PDO::FETCH_ASSOC)) {
            $books[] = $book;
        }

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

        // подключаемся к базе
        $pdo = PdoToBook::dbConnect();

        // формируем запрос на добавление
        $sql = 'insert into books set title = :title, author = :author, description = :description, image = :image ';
        $stmt = $pdo->prepare($sql);
        $params = [ ':title' => $book['title'], ':author' => $book['author'], ':description' => $book['description'], ':image' => $book['image']];

        // если запрос віполняется то true нет false
        if ($stmt->execute($params)) return true;
        else return false;

    }

    /**
     * удаляем книгу по id (title)
     * false если ошибка
     *
     */
    public static function deleteItemsBook($deleteBook) {


// <--- work
//        $del = "(".implode(",", $deleteBook).")";

//        $pdo = PdoToBook::dbConnect();
//
//            // формируем запрос на обновление
//            $sql = 'delete from books where `key` in'.$del;
//            $stmt = $pdo->prepare($sql);
//            $params = [':key' => $del];
//
////         если запрос віполняется то true нет false
//        if ($stmt->execute($params)) return true;
//        else return false;
// <--- work

        $del = implode(',', $deleteBook);

        // подключаемся к базе
        $pdo = PdoToBook::dbConnect();

        $sql = "delete from books  where `key` in (".$del.")";

        $result = $pdo->query($sql);

//         если запрос выполняется то true нет false
        if ($result) return true;
        else return false;

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

        $pdo = PdoToBook::dbConnect();

        // формируем запрос на обновление
        $sql = 'update books set title = :title, author = :author, description = :description, image = :image where `key` = :key ';
        $stmt = $pdo->prepare($sql);
        $params = [ ':key' => $key, ':title' => $title, ':author' => $author, ':description' => $description, ':image' => $image ];

        // если запрос віполняется то true нет false
        if ($stmt->execute($params)) return true;
        else return false;

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