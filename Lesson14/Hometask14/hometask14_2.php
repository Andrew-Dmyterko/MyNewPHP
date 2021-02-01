<pre>
<?php

/**
 * Сделайте класс User, в котором будут следующие
 * protected поля - name (имя), age (возраст), public методы setName, getName, setAge, getAge.
 *
 */

class User
{
    protected $name;
    protected $age;

    public function getName()
    {
        return $this->name;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setAge($age): void
    {
        $this->age = $age;
    }

}


/**
 * Class Employee2
 * Сделайте класс Employee, который наследует от класса User
 * и вносит дополнительное private поле salary (зарплата),
 * а также методы public getSalary и setSalary.
 *
 * Создайте 2 объекта этого класса: имя 'Петр', возраст 25, зарплата 10000
 * и имя 'Николай', возраст 28, зарплата 12000.
 * Выведите на экран сумму зарплат Петра и Николая.
 * Сравните и выведите на экран возраст и имя старшего сотрудника.
 *
 */
class Employee2 extends User
{
    protected $salary;

    public function getSalary()
    {
        return $this->salary;
    }

    public function setSalary($salary)
    {
        $this->salary = $salary;
    }
}

$emp1 = new Employee2();
$emp2 = new Employee2();

$emp1->setName("Петр");
$emp1->setAge(25);
$emp1->setSalary(10000);

$emp2->setName("Николай");
$emp2->setAge(28);
$emp2->setSalary(12000);

echo $emp1->getName()." - ".$emp1->getSalary();
echo "<br>";
echo $emp2->getName()." - ".$emp2->getSalary();
//$em = new User();
echo "<br>";

if ($emp1->getAge() > $emp2->getAge() ) var_dump("Старше ", $emp1);
elseif ($emp1->getAge() < $emp2->getAge() ) var_dump("Старше ", $emp2);
elseif ($emp1->getAge()== $emp2->getAge() ) var_dump("Возраст равен ", $emp1, $emp2 );

/**
 * Class Driver
 *
 * Сделайте класс Driver (Водитель), который будет наследоваться от класса Employee из предыдущей задачи.
 * Этот метод должен вносить следующие private поля: водительский стаж, категория вождения (A, B, C),
 * а также геттеры и сеттеры для них.
 *
 */
class Driver extends Employee2
{
    private $staj;
    private $kategoria;

    public function getStaj()
    {
        return $this->staj;
    }

    public function getKategoria()
    {
        return $this->kategoria;
    }

    public function setStaj($staj) : void
    {
        $this->staj = $staj;
    }

    public function setKategoria($kategoria) : void
    {
        $this->kategoria = $kategoria;
    }
}
echo "<hr>";

$dr1 = new Driver();
$dr2 = new Driver();

$dr1->setStaj(10);
$dr1->setKategoria(["A"]);
$dr1->setName("Jon");
$dr2->setStaj(7);
$dr2->setKategoria(["A","B"]);
$dr2->setName("Bob");
$dr2->setSalary(15);

var_dump($dr1);
var_dump($dr2);

var_dump($emp1);
var_dump($emp2);

/**
 * Class Student
 *
 * Сделайте класс Student, который наследует от класса User и вносит
 * дополнительные private поля стипендия, курс, а также геттеры и сеттеры для них.
 *
 */
class Student extends User
{
    private $stipendiya;
    private $course;

    public function getStipendiya()
    {
        return $this->stipendiya;
    }

    public function getCourse()
    {
        return $this->course;
    }

    public function setStipendiya($stipendiya)
    {
        $this->stipendiya = $stipendiya;
    }

    public function setCourse($course)
    {
        $this->course = $course;
    }
}
echo "<hr>";
$st1 = new Student();
$st2 = new Student();

$st1->setName("Вася");
$st1->setAge(22);
$st1->setCourse(4);
$st1->setStipendiya(3000);

$st2->setName("Петя");
$st2->setAge(23);
$st2->setCourse(5);
$st2->setStipendiya(3200);

echo $st1->getName()."<br>";
echo $st1->getAge()."<br>";
echo $st1->getCourse()."<br>";
echo $st1->getStipendiya()."<br>";

echo $st2->getName()."<br>";
echo $st2->getAge()."<br>";
echo $st2->getCourse()."<br>";
echo $st2->getStipendiya()."<br>";

var_dump($st1);
var_dump($st2);

class Worker extends Employee2
{
    private $rating = 5;

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($rating): void
    {
        $this->rating = $rating;
    }

    public function setSalary($salary): void
    {
        $this->salary = $salary*$this->rating;
    }

}


echo "<hr>";
$dr1 = new Driver();
$dr1->setSalary(10000);
echo $dr1->getSalary();

echo "<br>";

$wr1 = new Worker();
$wr1->setRating(2);
$wr1->setSalary(10000);
echo $wr1->getSalary();