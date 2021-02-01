<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>

        <?php var_dump($_POST); ?>
        <?php if (empty($_POST)) { ?>
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
                $file = "books.us";
                $fileDesc = file_get_contents($file);
                $books = unserialize($fileDesc);

                if(isset($books)){

                    $books[] = [
                        'title' => $_POST["title"],
                        'author' => $_POST["author"],
                        'description' => $_POST["description"],
                        'image' => 'book/image/none.png',
                        ];

//                    var_dump($books); die;

                    $usBooks = serialize($books);

                    file_put_contents($file, $usBooks);
                    header('Location: index.php');
                }

            } ?>


    </body>
</html>
<style>
    table, tr, td {
        border: 1px solid black;
        padding: 5px;
    }
</style>