<?php
require_once 'function.php';
getBooksArray(); // получаем массив книг books[]
?>

<?php if (!isset($_POST['delete'])) {?>

<?php getHeader("Добавить новую книгу");// Создаем футер?>

<!--        --><?php //var_dump($_POST); ?>
        <?php if ((empty($_POST['title']))) { ?>
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
                        $books = [
                            'title' => $_POST["title"],
                            'author' => $_POST["author"],
                            'description' => $_POST["description"],
                            'image' => $image,
                        ];

                        $fileCsv = "books.csv";
                        $f = fopen($fileCsv,"a+"); // открываем файл для чтения/записи уаазатель в конец файла

                        // дописываем строку csv в файл newBooks.csv
                        fputcsv($f, $books);

                        // закрываем файл
                        fclose($f);
                    }

                    header('Location: index.php');

            }
        // если выставили чекбоксы значит удаляем
        } else  {

            $fileCsv = "books.csv";
            $f = fopen($fileCsv,"w"); // открываем файл для чтения/записи уаазатель в начало файла

            foreach($books as $key => $book){
                if (in_array($book['title'], $_POST['delete'])){
                   unset ($books[$key]);
                   continue;
                }
                // дописываем строку csv в файл newBooks.csv
                fputcsv($f, $book);
            }
            // закрываем файл
            fclose($f);

            header('Location: index.php');
        }

        getFooter(); // Создаем футер ?>