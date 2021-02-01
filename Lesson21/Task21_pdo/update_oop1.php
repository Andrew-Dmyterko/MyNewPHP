<!--<pre>-->
<?php

require_once 'function_oop1.php';

if (isset($_POST['form_send'])) {

    $file = Book::ifBookUpload('uploadedFile'); // функция обработки загрузки файла

    if (!$file['error_flag']) {
                    $fileName = $file['dest_path'];
                } else $fileName = $_POST['image'];

    $book = new Book($_GET['key'],$_POST['title'],$_POST['author'],$_POST['description'], $fileName);
    $book->update();

    header('Location: index.php');

} else {
    $book = new Book($_GET['key']);

    if ($book->getItemBook()) {

        Html::getHeader("Изменение книги " . $book->title);// Создаем хедер ?>

        <h3>Изменение книги <?= $book->title ?></h3>

        <?php echo "<img src='" . $book->image . "' width='200px'>"; ?>

        <form action="update_oop1.php?key=<?= $book->key ?>&title=<?= str_replace(" ", "%20", $book->title) ?>" method="post"
              enctype="multipart/form-data">
            <div>
                <input type="file" name="uploadedFile">
            </div>
            <div>
                <input type="hidden" name="key" value="<?= $book->key ?>">
            </div>
            <div>
                <input type="hidden" name="image" value="<?= $book->image ?>">
            </div>
            <div>
                <input type="text" name="title" value="<?= $book->title ?>">
            </div>
            <div>
                <input type="text" name="author" value="<?= $book->author ?>">
            </div>
            <div>
                <textarea name="description"><?= $book->description ?></textarea>
            </div>
            <div>
                <button type="submit" name="form_send" value="yes">Изменить книгу</button>
            </div>
        </form>
        <h5><a href='index.php'>Назад</a></h5>

        <hr>

        <?php Html::getFooter(); // Создаем футер
    } else echo "</p> Books list is empty!!! Internal error!!! </p>";
}   ?>

