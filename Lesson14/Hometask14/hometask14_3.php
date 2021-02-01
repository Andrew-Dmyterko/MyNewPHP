<pre>
<?php
/**
 *
 * Сделайте класс Rectangle (прямоугольник), в котором в свойствах будут записаны ширина и высота.
 * В классе Rectangle сделайте метод getSquare, который будет возвращать площадь этого прямоугольника.
 * В классе Rectangle сделайте метод getPerimeter, который будет возвращать периметр этого прямоугольника
 *
 */

class Rectangle
{
    private $x = 5;  // ширина
    private $y = 15; // высота

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function setX(int $x): void
    {
        $this->x = $x;
    }

    public function setY(int $y): void
    {
        $this->y = $y;
    }

// получит площадь
    public function getSquare() {
        return $this->x*$this->y;
    }

// получить периметер
    public function getPerimeter() {
        return ($this->x+$this->y)*2;
    }
}

$r1 = new Rectangle();
$r2 = new Rectangle();

echo $r1->getSquare();
echo "<br>";
echo $r1->getPerimeter();
echo "<br>";

$r2->setX(10);
$r2->setY(10);

echo $r2->getSquare();
echo "<br>";
echo $r2->getPerimeter();
echo "<br>";