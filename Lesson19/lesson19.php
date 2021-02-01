<pre>
<?php

class Text
{
    protected $text;
    static protected $fffff="!!!hello";
}

class Message extends Text
{
    private $name;
    static $count;
    private $age;
    private $surname1;

    function  __construct($name,$text)
    {
        self::$count++;
        echo parent::$fffff;
            $this->name = $name;
//            echo "Hello ".$this->name.$text;
//            echo self::$count;
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
        echo "Die ". $this->name."\n";
    }

    function __get($property)
    {
        // TODO: Implement __get() method.
        return $this->$property;
    }

    function __set($param, $value) {
        if (property_exists($this, $param)) $this->$param = $value;
    }

}

$message = new Message('ffffff','efegf');
$message1 = new Message('Goga','efegf');
$message2 = new Message('Goga','efegf');
$message3 = new Message('Goga','efegf');
$message->surname = "Vasechkin";
$message->text = "dfgf";
var_dump($message);
echo $message->surname;


echo "<br>";
//echo $message->name;
//unset ($message);