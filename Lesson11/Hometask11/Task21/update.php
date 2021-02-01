<!--<pre>-->
<?php

require_once 'function.php';
getBooksArray(); // получаем массив книг books[]

foreach($books as $book){
    if($book['title'] == $_GET['title']){
        $image = $book['image'];
        $title = $book['title'];
        $author = $book['author'];
        $description = $book['description'];
    }
}

if (isset($_POST['form_send'])) {
    $fileCsv = "books.csv";
    $f = fopen($fileCsv,"w"); // открываем файл для чтения/записи уаазатель в конец файла

    $file = ifBookUpload('uploadedFile'); // функция обработки загрузки файла

    foreach($books as &$book){
        if($book['title'] == $_GET['title']) {

            if (!$file['error_flag']) {
                $book['image'] = $file['dest_path'];
            } else $book['image'] = $_POST['image'];

            $book['title'] = $_POST['title'];
            $book['author'] = $_POST['author'];
            $book['description'] = $_POST['description'];

            $image = $book['image'];
            $title = $book['title'];
            $author = $book['author'];
            $description = $book['description'];
        }
        // дописываем строку csv в файл newBooks.csv
        fputcsv($f, $book);
    }
    // закрываем файл
    fclose($f);

    header('Location: index.php');
}
?>

<?php getHeader("Изменение книги $title");// Создаем хедер ?>

<hr>
<h3>Изменение книги <?=$title?></h3>

<?php echo "<img src='".$image."' width='200px'>"; ?>

<form action="update.php?title=<?= $title?>" method="post" enctype="multipart/form-data">
    <div>
        <input type="file" name="uploadedFile">
    </div>
    <div>
        <input type="hidden" name="image" value="<?=$image?>">
    </div>
    <div>
        <input type="text" name="title" value="<?=$title?>">
    </div>
    <div>
        <input type="text" name="author" value="<?=$author?>">
    </div>
    <div>
        <textarea name="description"><?=$description?></textarea>
    </div>
    <div>
        <button type="submit" name="form_send" value="yes">Изменить книгу</button>
    </div>
</form>

<hr>

<?php getFooter(); // Создаем футер ?>

