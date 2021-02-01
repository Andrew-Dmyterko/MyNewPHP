<pre><?php

//require_once  "function_oop1.php";

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

    }
}


$pdo = PdoToBook::dbConnect();

$result = $pdo->query('SELECT * from book');

while ($book = $result->fetch(PDO::FETCH_ASSOC)) {
    $books[] = $book;
}

var_dump($books);