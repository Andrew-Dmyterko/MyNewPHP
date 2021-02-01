<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>

        <?php var_dump($_POST); ?>
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

                    $error_flag = "";
                    $image = 'book/image/none.png';

//                   if ($_FILES && $_FILES['uploadedFile']['error'] == UPLOAD_ERR_OK)
//                    {
//                        var_dump($_FILES);
//                    }

                   if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
                       $fileTmpPath = $_FILES['uploadedFile']['tmp_name']; //временый путь
                       $fileName = $_FILES['uploadedFile']['name'];
                       $fileSize = $_FILES['uploadedFile']['size'];
                       $fileType = $_FILES['uploadedFile']['type'];
                       $fileNameCmps = explode(".", $fileName);
                       $fileExtension = strtolower(end($fileNameCmps));
                       $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

                       $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');

                       if (in_array($fileExtension, $allowedfileExtensions)) {
                           // directory in which the uploaded file will be moved
                           $uploadFileDir = 'book/image/';
                           $dest_path = $uploadFileDir . $newFileName;
                           echo $dest_path;

                            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                                $message = 'Файл успешно загружен.';
                            } else {
                                $message = 'Возникла проблема при загрузке.';
                                $error_flag = true;
                            }
                        //  echo $message;
                       } else {
                            $error_flag = true;
                            echo "Не загружен не то расширение.";
                       }
                   } else $error_flag = true;
//            $image = $dest_path;
                    if (!$error_flag) {
                        if (!(empty($_FILES['uploadedFile']['name']))) $image = $dest_path;
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

            } ?>


    </body>
</html>
<style>
    table, tr, td {
        border: 1px solid black;
        padding: 5px;
    }
</style>