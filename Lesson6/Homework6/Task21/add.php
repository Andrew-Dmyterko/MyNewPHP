<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>

        <?php var_dump($_POST); ?>
        <?php if ((empty($_POST['title']) && empty($_POST['author']))) { ?>
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
                    <button type="submit">Добавить книгу</button>
                </div>
            </form>
        <?php } else {

                    $books = [
                        'title' => $_POST["title"],
                        'author' => $_POST["author"],
                        'description' => $_POST["description"],
                        'image' => 'book/image/none.png',
                        ];

                    $fileCsv = "books.csv";
                    $f = fopen($fileCsv,"a+"); // открываем файл для чтения/записи уаазатель в конец файла

                    // дописываем строку csv в файл newBooks.csv
                    fputcsv($f, $books);

                    // закрываем файл
                    fclose($f);

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