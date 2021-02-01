<?php
require_once 'function_oop1.php';

if (!isset($_POST['delete'])) {

    Html::getHeader("Добавить новую книгу");// Создаем хедер

        if ((empty($_POST['title']))&&(empty($_POST['author']))) { ?>
            <form method="POST" action="add_oop1.php" enctype="multipart/form-data">
                <div>
                    <input type="text" name="title" placeholder="Названи книги">  <?php if (isset($_POST['sub_b'])) echo "Заполните поле"; ?>
                </div>
                <div>
                    <input type="text" name="author" placeholder="Автор книги" value="<?php if (isset($_POST['sub_b'])) echo $_POST['author']; ?>" >
                </div>
                <div>
                    <textarea name="description" placeholder="Краткое описание"><?php if (isset($_POST['sub_b'])) echo ($_POST['description']); ?></textarea>
                </div>
                <div>
                    <input type="file" name="uploadedFile">
                </div>
                <div>
                    <button type="submit" name="sub_b" value="Yes">Добавить книгу</button>
                </div>
            </form>
            <h5><a href='index.php'>Назад</a></h5>

        <?php } else {
                    $image = 'book/image/none.png';

                    $file = Book::ifBookUpload('uploadedFile'); // функция обработки загрузки файла

                    if (!$file['fileerror_flag']) {
                        if (!(empty($file['file_name']))) $image = $file['dest_path'];

                        // <--- находим максимальный ключ
                        $books = Book::getListBook();
                        $key = ++$books[max(array_keys($books))]['key'];
                        //<----

                        $book = new Book($key,$_POST["title"],$_POST["author"],$_POST["description"],$image);

                        $book->write();
                    }
                    header('Location: index.php');
            }
        // если выставили чекбоксы значит удаляем
        } else  {
            // удаляем книги
            Book::deleteItemsBook($_POST['delete']);

            header('Location: index.php');
        }

    Html::getFooter(); // Создаем футер ?>