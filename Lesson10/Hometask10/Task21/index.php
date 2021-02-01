<!--работаем через csv файл-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
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
    ?>
    <?php if(isset($books)){?>
    <table>
        <?php foreach($books as $book){ ?>
            <tr>
                <td><a href="item.php?title=<?= $book["title"] ?>"> <?= $book["title"] ?><a></td>
                <td><?= $book["author"] ?></td><td><a href="update.php?title=<?= $book["title"] ?>">редактировать<a></td>
            </tr>
        <?php } ?>
    </table>
        <form method="POST" action="add.php">
            <div>
                <button type="submit">Добавить книгу</button>
            </div>
        </form>
<?php  } else { ?>
    <p> Books list is empty </p>
<?php } ?>
</body>
</html>
<style>
    table, tr, td {
        border: 1px solid black;
        padding: 5px;
    }
</style>