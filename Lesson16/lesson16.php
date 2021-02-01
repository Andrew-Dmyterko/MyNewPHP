<?php
class Calc
{
    const PI = 3.14;

     static function sum( $a, $b) {
        return $a+$b;
    }

    public function forest() {
        self::sum(3,4);
    }

}

class superCalc extends Calc
{
    public function newSum() {
        parent::sum(2,3);
    }
}


echo Calc::PI;

$calc1 = new Calc();
echo "<br>";
echo $calc1->sum(3,4);
echo "<br>";
echo Calc::sum(3,4);


abstract class Animals
{

    public $name;

    abstract protected function sayHello($sss) ;
    public function sayGoodbye() {
        echo "say goodbye";
    }

}

class Cat extends Animals implements Action
{
    public function sayHello($fff, $rrr=8) {
        echo "Hello!!! $fff";
    }
    function eat() {

    }
    function walk() {

    }

}

class Dog extends Animals
{
    protected function sayHello($ggg) {
        echo "Hello!!! $ggg";
    }
}

$cat = new Cat();
$dog = new Dog();

echo "<br>";
$cat->sayHello("mmmaaayyy");
echo "<br>";
$dog->sayHello("gav");

interface Action
{
    function eat();
    function walk();
}

