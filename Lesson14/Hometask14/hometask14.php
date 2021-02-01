<pre>
<?php

/**
 * Сделайте класс Employee,
 * в котором будут следующие public поля - name (имя), age (возраст), salary (зарплата).
 * Создайте объект этого класса,
 * затем установите поля в следующие
 * значения - имя 'Петр', возраст 25, зарплата 10000.
 * Создайте второй объект этого класса,
 * установите поля в следующие значения - имя 'Николай', возраст 28, зарплата 12000.
 *
 * Выведите на экран сумму зарплат Петра и Николая. Сравните и выведите на экран возраст и имя старшего сотрудника.

 *
 *
 */

class Employee
{
    public $name;
    public $age;
    public $salary;

}

$emp1 = new  Employee();

$emp1->name = "Петр";
$emp1->age  = 25;
$emp1->salary = 10000;

var_dump($emp1);

$emp2 = new  Employee();

$emp2->name = "Николай";
$emp2->age  = 28;
$emp2->salary = 12000;

var_dump($emp2);

echo $emp1->name." - ".$emp1->salary;
echo "<br>";
echo $emp2->name." - ".$emp2->salary;
echo "<br>";

if ($emp1->age > $emp2->age ) echo "Старше ".$emp1->name."  ".$emp1->age." - ".$emp1->salary;
elseif ($emp1->age < $emp2->age ) echo "Старше ".$emp2->name."  ".$emp2->age." - ".$emp2->salary;
elseif ($emp1->age == $emp2->age ) echo "Возраст равен ".$emp1->name."  ".$emp1->age." - ".$emp1->salary."<br>".$emp2->name."  ".$emp2->age." - ".$emp2->salary;
