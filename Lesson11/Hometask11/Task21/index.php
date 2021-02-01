<?php

require_once 'function.php';
getBooksArray(); // получаем массив книг books[]

?>

<?php getHeader("Все книги");// Создаем хедер ?>

<?php if(isset($books)){?>
    <form method="POST" action="add.php">
    <table>
        <?php foreach($books as $book){ ?>
            <tr>
                <td><a href="item.php?title=<?= $book["title"] ?>"> <?= $book["title"] ?><a></td>
                <td><?= $book["author"] ?></td><td><a href="update.php?title=<?= $book["title"] ?>">редактировать<a></td>
                <td><input type="checkbox" name="delete[]" value="<?= $book["title"] ?>">del</td>
            </tr>
        <?php } ?>
    </table>
        <form method="POST" action="add.php">
            <div>
                <button type="submit">Добавить/Удалить книгу</button>
            </div>
        </form>
<?php  } else { ?>
    <p> Books list is empty </p>
<?php } ?>

<?php getFooter(); // Создаем футер?>