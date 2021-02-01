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