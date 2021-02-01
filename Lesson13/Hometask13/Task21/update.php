<!--<pre>-->
<?php

require_once 'function.php';

if (isset($_POST['form_send'])) {

    $books = getListBook();

    $file = ifBookUpload('uploadedFile'); // функция обработки загрузки файла

    foreach($books as &$book){
        if($book['title'] == $_GET['title']) {

            if (!$file['error_flag']) {
                $book['image'] = $file['dest_path'];
            } else $book['image'] = $_POST['image'];

            $book['title'] = $_POST['title'];
            $book['author'] = $_POST['author'];
            $book['description'] = $_POST['description'];
        }
    }

    writeToCsv($books, "w");

    header('Location: index.php');

} else $book = getItemBook($_GET['title']);

getHeader("Изменение книги ". $book['title']);// Создаем хедер ?>

<hr>
<h3>Изменение книги <?=$book['title']?></h3>

<?php echo "<img src='".$book['image']."' width='200px'>"; ?>

<form action="update.php?title=<?= str_replace(" ", "%20", $book['title'])?>" method="post" enctype="multipart/form-data">
    <div>
        <input type="file" name="uploadedFile">
    </div>
    <div>
        <input type="hidden" name="image" value="<?=$book['image']?>">
    </div>
    <div>
        <input type="text" name="title" value="<?=$book['title']?>">
    </div>
    <div>
        <input type="text" name="author" value="<?=$book['author']?>">
    </div>
    <div>
        <textarea name="description"><?=$book['description']?></textarea>
    </div>
    <div>
        <button type="submit" name="form_send" value="yes">Изменить книгу</button>
    </div>
</form>

<hr>

<?php getFooter(); // Создаем футер ?>

