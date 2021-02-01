<pre>
<?php

abstract class Technical
{
    protected $model;
    protected $brand;
    protected $price;
    protected $width;
    protected $height;
    protected $lenght;
    protected $weith;

    public function setModel($model) {
        $this->model = $model;
    }

    public function setBrand($brand) {
        $this->brand = $brand;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setVolume($width, $height, $lenght) {
        $this->width = $width;
        $this->height = $height;
        $this->lenght = $lenght;
    }

    public function setWeith($weith) {
        $this->width = $weith;
    }

    public function getModel() {
        return $this->model;
    }

    public function getBrand() {
        return $this->brand;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getHeight() {
        return $this->height/100;
    }

    public function getWidth() {
        return $this->width/100;
    }

    public function getLenght() {
        return $this->lenght/100;
    }

    public function getWeith() {
        return  $this->weith;
    }

    abstract public function getCost();

}


interface Show {
    public function getShow();
}
interface Delete {
    public function getDelete();
    public function getShow();
}
class Tv extends Technical implements Show, Delete
{
    use Cost;

    public function getShow()
    {
        // TODO: Implement getShow() method.
        echo "Show TV!!!";
    }

    public function getDelete()
    {
        // TODO: Implement getShow() method.
        echo " DeleteTV!!!";
    }

}

class Computer extends Technical
{

use CostVolum, Cost {
    Cost::getCost insteadof CostVolum;
    CostVolum::getCost as getCostVolume;
    }

}

class Smartphone extends Technical
{
    use Cost;

}

class Refr extends Technical
{
    use CostVolum;

}
trait Cost {
    public function getCost($a=0.05){
        return $this->price*$a;

    }
}

trait CostVolum {

    public function getCost(){
//        echo $this->price;
//        echo $this->getVolume();
//        die;
        return $this->price*$this->getVolume();
    }

    public function getVolume() {
        return $this->getWidth()*$this->getLenght()*$this->getHeight();
    }
}

$tv = new Tv();
$comp = new Computer();
$smart = new Smartphone();


$tv->setVolume(10,50,140);
$tv->setPrice(111);
$comp->setVolume(300,500,10);
$comp->setPrice(222);
$smart->setVolume(15,40,12);
$smart->setPrice(333);

//echo $tv->getCost(0.08);
//echo "<br>";
echo $comp->getCost();
echo "<br>";
echo $comp->getCostVolume();

$tv->getShow();
$tv->getDelete();

//echo $smart->getCost();


//var_dump($tv);
//var_dump($smart);
//var_dump($comp);



