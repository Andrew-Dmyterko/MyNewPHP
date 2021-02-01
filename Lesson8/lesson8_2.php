<pre>
<?php
session_start();

if (!isset($_COOKIE['count'])) {
            setcookie("count", 1, time()+60 );
} else {
//    ++$_COOKIE['count'];
    setcookie("count", ++$_COOKIE['count'], time()+60  );
    echo "Пользователь зашел - ".$_COOKIE['count']."раз\n";

}
//var_dump($_COOKIE);

if (!isset($_SESSION['time'])) {
    $_SESSION['time'] = time();
} else echo "Пользовалель зашел ".(time()-$_SESSION['time'])."sec";
//var_dump($_SESSION);
//
//if (!isset($_SESSION['count'])) {
//    echo "Вы еще не обновляли страницу!!\n";
//    $_SESSION['count'] = 1;
//} else {
//    echo "Вы обновляли страницу!! ---- ".$_SESSION['count'];
//    $_SESSION['count']++;
//    }
//
//if (isset($_POST['email'])) {
//    $_SESSION['email'] = $_POST['email'];
//    header("Location: lesson8_2.php");
//}
//

//
//?>

<form action="lesson8_1.php" method="post">
        <div>
            <input type="text" name="email" placeholder="email" value="<?=$_SESSION['email']?>">
        </div>
        <div>
            <button type="submit" name="form_send" value="yes">Перейти на другую</button>
        </div>
</form>

