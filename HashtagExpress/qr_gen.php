<?php
require_once __DIR__ . '/phpqrcode/qrlib.php';

$users = [
    'barCode' => 'asfsd34',
    'name' => 'Andrew',
    'doctavka' => 'в киев',
    'mess' => 'ваша посілка в городе киев'
];

if (isset($_GET['barCode'])) {
    echo $users['barCode']."<br>".$users['name']."<br>".$users['doctavka']."<br>".$users['mess'];
} else {


/* Генерация QR-кода во временный файл */
//    http://localhost/MyNewPHP/HashtagExpress/status.php?order_num=98006300258
QRcode::png('http://192.168.1.100/MyNewPHP/HashtagExpress/status.php?order_num=98006300258', __DIR__ . '/tmp/tmp.png', 'M', 6, 2);

$im = imagecreatefrompng(__DIR__ . '/tmp/tmp.png');
$width = imagesx($im);
$height = imagesy($im);

/* Цвет фона в RGB */
$bg_color = imageColorAllocate($im, 255, 225, 255);

for ($x = 0; $x < $width; $x++) {
    for ($y = 0; $y < $height; $y++) {
        $color = imagecolorat($im, $x, $y);
        if ($color == 0) {
            imageSetPixel($im, $x, $y, $bg_color);
        }
    }
}

///* Вывод в браузер */
//header('Content-Type: image/x-png');
//imagepng($im);

?>

<img src="tmp/tmp.png" alt="альтернативный текст">

<?php
}