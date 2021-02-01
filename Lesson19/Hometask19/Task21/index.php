<?php

require_once 'function_oop1.php';

$books = Book::getListBook(); // получаем массив книг books[]

Html::getHeader("Все книги"); // Создаем хедер

if(isset($books)){?>
    <form method="POST" action="add_oop1.php">
    <table>
        <?php foreach($books as $book){ ?>
            <tr>
                <td><?=$book["key"]?></td>
                <td><a href="item_oop1.php?key=<?=$book["key"]?>&title=<?= str_replace(" ", "%20", $book['title']); ?>"> <?= $book["title"] ?><a></td>
                <td><?= $book["author"] ?></td>

                <?php if (isset($_SESSION['user_session_id'])) { ?>
                    <td><a href="update_oop1.php?key=<?=$book["key"]?>&title=<?= str_replace(" ", "%20", $book['title']) ?>">редактировать<a></td>
                    <td><input type="checkbox" name="delete[]" value="<?= $book["title"] ?>">del</td>
                <?php } ?>

            </tr>
        <?php } ?>
    </table>

        <?php if (isset($_SESSION['user_session_id'])) { ?>
        <form method="POST" action="add.php">
            <div>
                <button type="submit">Добавить/Удалить книгу</button>
            </div>
        </form>
        <?php } ?>

<?php  } else {
     echo "</p> Books list is empty!!! Internal error!!! </p>";
       }

Html::getFooter(); // Создаем футер

?>
