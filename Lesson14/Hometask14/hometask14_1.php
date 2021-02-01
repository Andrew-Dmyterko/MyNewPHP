<pre>
<?php
/**
 * Сделайте класс Employee,
 * в котором будут следующие private поля -
 * name (имя), age (возраст), salary (зарплата) и
 * следующие public методы setName, getName, setAge, getAge, setSalary, getSalary.
 *
 * Создайте 2 объекта этого класса:
 * имя 'Петр', возраст 25, зарплата 10000
 * и имя 'Николай', возраст 28, зарплата 12000.
 *
 * Выведите на экран сумму зарплат Петра и Николая.
 * Сравните и выведите на экран возраст и имя старшего сотрудника.
 *
 * Дополните класс Employee из предыдущей задачи private методом validateAge,
 * который будет проверять возраст на корректность (от 18 до 60 лет, как мы делали в задаче в начале курса).
 * Этот метод должен использовать метод setAge перед установкой нового возраста
 * (если возраст не корректный - он не должен меняться).
 *
 */

class Employee1
{
    private $name;
    private $age;
    private $salary;

    public function getName() {
        return $this->name;
    }

    public function getAge() {
        return $this->age;
    }

    public function getSalary() {
        return $this->salary;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAge($age) {
       if ($this->validateAge($age)) {
           echo "<br>good age!! $age!!!<br>";
           $this->age = $age;
       }
       else {
           echo "<br>wrong age!! $age!!!<br>";
           return false;
       }
    }

    public function setSalary($salary) {
        $this->salary = $salary;
    }

/**
 * Проверяем возраст на корректность (от 18 до 60 лет) если корректный устанавливаем если нет не меняем
 */
    private function validateAge($age) {
        if ($age >= 18 && $age <= 60) return true;
        else return false;
    }

}

$emp1 = new Employee1();
$emp2 = new Employee1();

$emp1->setName("Петр");
$emp1->setAge(25);
$emp1->setSalary(10000);

$emp2->setName("Николай");
$emp2->setAge(28);
$emp2->setSalary(12000);

var_dump($emp1);
var_dump($emp2);

echo $emp1->getName();
echo "<br>";
echo $emp1->getAge();
echo "<br>";
echo $emp1->getSalary();
echo "<br>";

echo $emp2->getName();
echo "<br>";
echo $emp2->getAge();
echo "<br>";
echo $emp2->getSalary();
echo "<br>";

if ($emp1->getAge() > $emp2->getAge() ) echo "Старше ".$emp1->getName()."  ".$emp1->getAge()." - ".$emp1->getSalary();
elseif ($emp1->getAge() < $emp2->getAge() ) echo "Старше ".$emp2->getName()."  ".$emp2->getAge()." - ".$emp2->getSalary();
elseif ($emp1->getAge()== $emp2->getAge() ) echo "Возраст равен ".$emp1->getName()."  ".$emp1->getAge()." - ".$emp1->getSalary()."<br>".$emp2->getName()."  ".$emp2->getAge()." - ".$emp2->getSalary();

echo "<br>";
echo "<br>";

$emp1->setAge(17);
echo $emp1->getAge();

$emp1->setAge(37);
echo $emp1->getAge();

$emp1->setAge(67);
echo $emp1->getAge();
