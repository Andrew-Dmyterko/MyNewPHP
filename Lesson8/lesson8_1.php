<pre>
<?php
session_start();

var_dump($_SESSION);
var_dump($_COOKIE);
//setcookie("andrew", "222222", time()+60);


if (!isset($_SESSION['count'])) {
    echo "Вы еще не обновляли страницу!!\n";
    $_SESSION['count'] = 1;
} else {
    echo "Вы обновляли страницу!! ---- ".$_SESSION['count'];
    $_SESSION['count']++;
    }

if (isset($_POST['email'])) {
    $_SESSION['email'] = $_POST['email'];
    header("Location: lesson8_2.php");
}



?>

<form action="lesson8_1.php" method="post">
        <div>
            <input type="text" name="email" placeholder="email" >
        </div>
        <div>
            <button type="submit" name="form_send" value="yes">Перейти на другую</button>
        </div>
    </form>

