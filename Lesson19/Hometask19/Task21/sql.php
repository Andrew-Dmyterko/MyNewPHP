

1         Знайдіть імена (name) всіх працівників (employees), зарплата (salary) яких більша за керівника (boss).
<----variant1---->
SELECT *
FROM `employees` a,
`employees` b
WHERE a.Salary > b.Salary
and b.EmployeeID=a.BossID

<----variant2---->
SELECT *
FROM `employees` a
WHERE a.Salary > (
                    select b.Salary from `employees` b where b.EmployeeID = a.BossID
                 )



2        Знайдіть працівників, котрі мають найбільшу зарплатню в своєму підрозділі (department).
<----variant1---->
SELECT Name, DepartamentID, MAX(Salary)
FROM `employees`
GROUP BY DepartamentID

<----variant2---->

SELECT Name, DepartamentID, Salary
FROM `employees` a
where a.Salary = (
                    SELECT max(b.Salary)
                    from `employees` b
                    WHERE IFNULL(b.DepartamentID, 555) = IFNULL(a.DepartamentID,555)
                  )

3        Знайдіть назви всіх підрозділи, котрі мають менш ніж 3-х працівників

SELECT count(a.Name) , IFNULL(a.DepartamentID,555)  // count(a.DepartamentID)
FROM `employees` a
group by IFNULL(a.DepartamentID,555)
HAVING count(a.Name)< 3


SELECT count(a.Name) , a.DepartamentID
FROM `employees` a
group by a.DepartamentID
HAVING count(a.Name) < 3


 4        Знайдіть працівників, котрі не мають керівників в своєму підрозділі

SELECT * FROM `employees` WHERE `BossID` is null or `BossID` = `EmployeeID`
тут с учетом что он сас себе начальнит то типа не начальниу


 5        Знайдіть котру загальну суму зарплатні отримує кожен підрозділ.

SELECT `DepartamentID` SUM(`Salary`)
FROM `employees`
GROUP BY `DepartamentID`


6. Найти все отделы, в которых есть сотрудники (нет сотрудников)

SELECT distinct(`DepartamentID`) FROM `employees` WHERE `DepartamentID` IS NOT NULL

SELECT `Name`, `DepartamentID` FROM `employees` WHERE `DepartamentID` IS NULL
сотрудники без отдела


7. Вибрати список людей, що мають однофамільців(одно имя, в нашем случае). Впорядкувати за алфавітом.

SELECT count(`Name`), `Name`
FROM `employees` a
group by `Name`
HAVING count(`Name`)>=2
order by `Name`

====================================

Боссам присваиваем среднюю зарплату по предприятию,

//SELECT AVG(`Salary`), sum(`Salary`), count(`Salary`) FROM `employees`

<---Это рабочий вариант--->
UPDATE `employees` SET `Salary`= (SELECT AVG(`Salary`) FROM `employees`) WHERE `BossID`=`EmployeeID`
<---Это рабочий вариант--->

//UPDATE `employees` SET `Salary`= `Salary`*110% WHERE `Salary`

а потом проверяем,
если максимальная зарплата в его отделе меньше, чем у него,
тогда ему переназначаем зарплату в 110% от максимальной по отделу.

// UPDATE employees1 a SET a.Salary= (select MAX(b.Salary)*1.1 from employees1 b where a.DepartamentID = b.DepartamentID) WHERE a.Salary <  (select MAX(c.Salary) from employees1 c where a.DepartamentID = c.DepartamentID)

<---Это рабочий вариант--->
UPDATE employees a
SET a.Salary=
(select MAX(b.Salary)*1.1
from employees b
where a.DepartamentID = b.DepartamentID)
WHERE a.Salary <  (select MAX(c.Salary)
from employees c
where a.DepartamentID = c.DepartamentID)
and a.BossID = a.EmployeeID
<---Это рабочий вариант--->
<---Это рабочий вариант--->
UPDATE employees1 a
SET a.Salary=
(select MAX(b.Salary)*1.1
from employees1 b
where a.DepartamentID = b.DepartamentID)
WHERE a.Salary <  (select MAX(c.Salary)
from employees1 c
where a.DepartamentID = c.DepartamentID)
and a.BossID = a.EmployeeID
<---Это рабочий вариант--->

12341.1429
172776
14

12355.928571
172983.00
14



AVG(`Salary`)
sum(`Salary`)
count(`Salary`)
17247.649286
241467.09
14
