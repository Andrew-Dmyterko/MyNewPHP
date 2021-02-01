<?php
require_once 'function.php';

if (!isset($_POST['delete'])) {

    getHeader("Добавить новую книгу");// Создаем хедер

        if ((empty($_POST['title']))) { ?>
            <form method="POST" action="add.php" enctype="multipart/form-data">
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
        <?php } else {

                    $image = 'book/image/none.png';

                    $file = ifBookUpload('uploadedFile'); // функция обработки загрузки файла

                    if (!$file['fileerror_flag']) {
                        if (!(empty($file['file_name']))) $image = $file['dest_path'];
                        $book[0] = [
                            'title' => $_POST["title"],
                            'author' => $_POST["author"],
                            'description' => $_POST["description"],
                            'image' => $image,
                        ];

                        writeToCsv($book, "a+");
                    }

                    header('Location: index.php');

            }
        // если выставили чекбоксы значит удаляем
        } else  {
            // удаляем книги
            deleteItemsBook($_POST['delete']);

            header('Location: index.php');
        }

    getFooter(); // Создаем футер ?>