<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!--    --><?php //require_once('books.php'); ?>
    <?php
    $file = "books.us";
    $fileDesc = file_get_contents($file);
    $books = unserialize($fileDesc);
    ?>
    <?php if(isset($books)){?>
    <table>
        <?php foreach($books as $book){ ?>
            <tr>
                <td><a href="item.php?title=<?= $book["title"] ?>"> <?= $book["title"] ?><a></td>
                <td><?= $book["author"] ?></td>
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