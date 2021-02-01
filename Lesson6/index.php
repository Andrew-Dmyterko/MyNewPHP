<?php require_once('books.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="add.php">
        <div>
            <input type="text" name="title" placeholder="Названи книги">
        </div>
        <div>
            <input type="text" name="author" placeholder="Автор книги">
        </div>
        <div>
            <textarea name="description" placeholder="Краткое описание"></textarea>
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
    <?php if(isset($books)){?>
    <table>
        <?php foreach($books as $book){ ?>
            <tr>
                <td><a href="item.php?title=<?= $book["title"] ?>"> <?= $book["title"] ?><a></td>
                <td><?= $book["author"] ?></td>
                <!--<td><?php
                /*$new_s = substr($book["description"], 0, 300); //новая строка максимальной длины
                $simb = strripos($new_s, '.');//возвращает номер символа до которого надо обрезать
                echo substr($new_s, 0, $simb+1);*/
                ?></td>-->
            </tr>
        <?php } ?>
    </table>
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