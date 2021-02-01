<pre><?php

$driver = 'mysql';
$host = 'localhost';
$db_name = 'blog_db';
$db_user = 'root';
$db_pass = '650351';
$charset = 'utf8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES=>false];


try {
    $pdo = new PDO("$driver:host=$host;dbname=$db_name;charset=$charset",$db_user,$db_pass,$options);

}catch (PDOException $e) {
     die ("Не могу подключиться к базе данных");
}

$result = $pdo->query('SELECT * from article_pic');

// метод построчного возврата
//$row = $result->fetch(PDO::FETCH_ASSOC
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    var_dump($row);
}

$result = $pdo->query('SELECT * from article_pic');

// метод возврата всех строк
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
echo ('<hr>');
var_dump($rows);

// именованные плейсхолдеры
$sql = 'select * from article_pic where id = :id';
$stmt = $pdo->prepare($sql);
$params = [':id' => '58'];
$stmt->execute($params);

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo ('<hr>');
var_dump($rows);

// позиционные плейсхолдеры
$sql_pos = 'select * from article_pic where id = ?';
$stmt_pos = $pdo->prepare($sql_pos);
$params = ['59'];
$stmt_pos->execute($params);

$rows = $stmt_pos->fetchAll(PDO::FETCH_ASSOC);


echo ('<hr>');
var_dump($rows);

