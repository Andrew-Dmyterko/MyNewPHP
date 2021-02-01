<?php

require_once 'function_oop.php';

$books_oop = new Books();

$books = $books_oop->getListBook(); // получаем массив книг books[]

$form = new Html();

$form->getHeader("Все книги");// Создаем хедер

if(isset($books)){?>
    <form method="POST" action="add_oop.php">
    <table>
        <?php foreach($books as $book){ ?>
            <tr>
                <td><a href="item_oop.php?title=<?= str_replace(" ", "%20", $book['title']); ?>"> <?= $book["title"] ?><a></td>
                <td><?= $book["author"] ?></td><td><a href="update_oop.php?title=<?= str_replace(" ", "%20", $book['title']) ?>">редактировать<a></td>
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

$form->getFooter(); // Создаем футер

?>

<?php


class Book
{
    private $title;
    private $author;
    private $description;
    private $image;

    function __construct($title)
    {
        $this->title = $title;
        $books = self::getList();
        foreach ($books as $book) {
            $this-> aythor = $book['author'];
        }
    }

    /**
     * метод применяет текстовое значение и присваивает его в с
     *
     */
    public function setTitle($title) {

        $this->title = $title;

    }

    /**
     * присваивает значение всем существующим свойствам к которым пользователь обратился напрямую
     * @param $property
     * @param $value
     */
    public function __set($property, $value) {
        if(property_exists($this,$property)) {
            $this->$property = $value;
        }
    }

}