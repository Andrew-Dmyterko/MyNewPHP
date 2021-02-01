<!--<pre>-->
<?php

//var_dump($_GET);

$fileCsv = "books.csv";
$f = fopen($fileCsv,"r+"); // открываем файл для чтения/записи уаазатель в начало файла

$books = [];
// массив после fgetcsv индексный приводим к ассоциативному
while ($data = fgetcsv($f)) {
    list($book['title'],$book['author'], $book['description'],$book['image']) = $data;
    $books[] = $book;
}
// закрываем файл
fclose($f);


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


    foreach($books as &$book){
        if($book['title'] == $_GET['title']) {
            $book['image'] = $_POST['image'];
            $book['title'] = $_POST['title'];
            $book['author'] = $_POST['author'];
            $book['description'] = $_POST['description'];
        }

        // дописываем строку csv в файл newBooks.csv
        fputcsv($f, $book);

    }

    // закрываем файл
    fclose($f);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<pre></pre>

<hr>
<h3>Изменение книги</h3>

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

</body>
</html>
<pre>


