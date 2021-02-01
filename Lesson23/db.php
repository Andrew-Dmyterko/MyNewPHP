<?php

$driver = 'mysql';
$host = 'localhost';
$db_name = 'test';
$db_user = 'root';
$db_pass = '650351';
$charset = 'utf8';


try {
        $db = new \mysqli($host, $db_user, $db_pass, $db_name);
} catch (\Exception $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}

/* Указать mysqli выбрасывать исключение в случае возникновения ошибки */
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


