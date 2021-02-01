<pre>
<?php

$driver = 'mysql';
$host = 'localhost';
$db_name = 'blog_db';
$db_user = 'root';
$db_pass = '650351';
$charset = 'utf8';


//$connection = mysqli_connect($host, $db_user, $db_pass);
//
//if (!$connection) {
//    echo "No database connection";
//    exit();
//} else {
//    echo "Database connect";
//}
//
//if (!mysqli_select_db( $connection, $db_name)) {
//    echo "<br>Cannot connect to database";
//    exit();
//}else echo ("<br>Database OK");
//
//$articles = mysqli_query($connection,"select * from article");
//
//if ($articles) {
//    $result = mysqli_fetch_assoc($articles);
//    var_dump($result);
//}
//echo "<hr>";
//if ($articles) {
//    $result = mysqli_fetch_object($articles);
////    var_dump($result);
//    echo $result->small_text;
//}
//echo "<hr>";
//if ($articles) {
//    $result = mysqli_fetch_row($articles);
//    var_dump($result);
////    echo $result->small_text;
//}

$mysqli = new \mysqli($host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_errno) {
    echo "Подключение к серверу невозможно. Код ошибки.", $mysqli->connect_error;
    exit;
}

if ($result = $mysqli->query("select * from article")) {

    var_dump($result->fetch_object());
}
    echo "<hr>";

$result->data_seek(10);

var_dump($result->fetch_object());





$row = $result->fetch_object();
echo $row->small_text;
echo "<hr>";

while ($row = $result->fetch_assoc()) {
    var_dump($row);
    echo "<hr>";
}



$query = "insert into article set small_text= 'текст'";

$mysqli->query($query);

printf( "id новой записи %d.\n", $mysqli->insert_id);



$result->close();
$mysqli->close();