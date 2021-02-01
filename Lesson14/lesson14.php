<pre>
<?php
//for ($i=1,$j="*";$i<=10;$i++) {
//    echo $j."<br>";
//    $j= $j."*";
//
//}

//for ($j="*";$j != "***********";$j.= "*") {
//    echo $j."<br>";
//}

class ClassName
{

}
class Transport
{
    public $speed;
    protected $name;

    public function run() {
        return 'Go'.$this->name;
    }

    public function stop() {
        return 'Stop';
    }

}


class Car extends Transport
{
    public $color = "green";
    private $size  = 60;
    public $prise  = 25;

    public function getFullCost($prise) {
        $cost = $this->size*$prise;
        return $cost;
    }

    public function setSize(Int $size) {
        $this->size = $size;
    }

    public function getSize() {
        return$this->size;
    }

}

$car1 = new Car();
$car2 = new Car();

$car1->color = "red";
//$car1->name = "bx4545";
$car2->color = "black";
$car1->setSize(45);


//var_dump($car1);
//var_dump($car1);
//
//echo $car1->color;
//
//$car3 = new Car();
//
//var_dump($car3);
//
//echo $car3->color;
//echo "<br>";
//echo $prize = $car1->size*$car1->prise;
echo "<br>";
echo $car1->getFullCost(20);
echo "<br>";
echo $car1->getSize();
//echo "<br>";
//echo $car2->getFullCost(30);

$transport = new Transport();
echo "<br>";
echo $transport->run();
echo "<br>";
echo "car1".$car1->run();