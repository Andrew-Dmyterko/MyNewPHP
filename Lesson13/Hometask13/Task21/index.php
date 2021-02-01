<?php

require_once 'function.php';

$books = getListBook(); // получаем массив книг books[]

getHeader("Все книги");// Создаем хедер

if(isset($books)){?>
    <form method="POST" action="add.php">
    <table>
        <?php foreach($books as $book){ ?>
            <tr>
                <td><a href="item.php?title=<?= str_replace(" ", "%20", $book['title']); ?>"> <?= $book["title"] ?><a></td>
                <td><?= $book["author"] ?></td><td><a href="update.php?title=<?= str_replace(" ", "%20", $book['title']) ?>">редактировать<a></td>
                <td><input type="checkbox" name="delete[]" value="<?= $book["title"] ?>">del</td>
            </tr>
        <?php } ?>
    </table>
        <form method="POST" action="add.php">
            <div>
                <button type="submit">Добавить/Удалить книгу</button>
            </div>
        </form>
<?php  } else {
     echo "</p> Books list is empty!!! Internal error!!! </p>";
       }

        getFooter(); // Создаем футер

?>