

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
---------------------------------------------------------
5
SELECT *
FROM `5_messeges` a, 5_page b, 5_users c
WHERE
a.`user_id` = c.id
and a.`page_id` = b.id

(2) получить все комментарии данного пользователя
SELECT *
FROM `5_messeges` a, 5_page b, 5_users c
WHERE
a.`user_id` = c.id
and a.`page_id` = b.id
and c.user = 'fox'

1) получить все комментарии к данной странице,
SELECT *
FROM `5_messeges` a, 5_page b, 5_users c
WHERE
a.`user_id` = c.id
and a.`page_id` = b.id
and b.`page_name` = 'contact'

или без таблицы юсерс если пользователи пишут свое имя в форме а не регаются

SELECT *
FROM `5_messeges` a, 5_page b
WHERE
a.`page_id` = b.id
and a.`user_name` = 'qqq'

---------------------------------------------------------
3

(1) достать все товары вместе с их категориями
SELECT *
FROM `3_product_name` a, `3_product` b, `3_category_name` c
WHERE b.product_id = a.`product_id`
and b.categoria_id = c.categoria_id

(2) достать товар 'Огурец' вместе с его категориями
SELECT *
FROM `3_product_name` a, `3_product` b, `3_category_name` c
WHERE b.product_id = a.`product_id`
and b.categoria_id = c.categoria_id
and a.`product_name` = 'огурец'

(3) достать все товары из категории 'Овощи',
SELECT *
FROM `3_product_name` a, `3_product` b, `3_category_name` c
WHERE b.product_id = a.`product_id`
and b.categoria_id = c.categoria_id
and c.`categoria_name` = 'овощи'

(4) достать все товары, которые принадлежат более чем одной категории
SELECT COUNT(b.product_id), a.product_name
FROM `3_product_name` a, `3_product` b, `3_category_name` c
WHERE b.product_id = a.`product_id`
and b.categoria_id = c.categoria_id
group by b.product_id
HAVING COUNT(b.product_id)>1
---------------------------------------------------------
2
(1) достать всех пользователей вместе с их городом и страной
SELECT *
FROM `2_users` a, 2_country b, 2_city c
WHERE a.`city_id` = c.city_id
and c.country_id = b.country_id

(2) достать все города с их странами
SELECT *
FROM  2_country b, 2_city c
WHERE
c.country_id = b.country_id

3) достать всех пользователей из страны Беларусь (без городов),
SELECT `user_name`, b.country_name
FROM `2_users` a, 2_country b, 2_city c
WHERE a.`city_id` = c.city_id
and c.country_id = b.country_id
and b.country_name = 'Беларусь'

(4) достать всех пользователей из города Минск (без страны),
SELECT `user_name`, c.city_name
FROM `2_users` a,  2_city c
WHERE a.`city_id` = c.city_id
and c.city_name = 'Минск'

(5) вывести список стран с количеством пользователей в них.
SELECT count(a.user_id), b.country_name
FROM `2_users` a, 2_country b, 2_city c
WHERE a.`city_id` = c.city_id
and c.country_id = b.country_id
group by b.country_id
---------------------------------------------------------
4
(1) вывести пользователей вместе с их покупками,
SELECT *
FROM `4_buy` a, 4_users b, 4_product_name c
WHERE a.`product_id` = c.product_id
and a.`user_id` = b.user_id
order by a.`user_id`, a.`buy_date`

(2) вывести пользователей вместе с суммами всех их покупок
SELECT sum(a.`bue_price`) , a.`user_id`, b.user_name
FROM `4_buy` a, 4_users b, 4_product_name c
WHERE a.`product_id` = c.product_id
and a.`user_id` = b.user_id
group by a.`user_id`

(3) найти суммарные покупки на сайте за определенный месяц,
SELECT sum(a.`bue_price`)
FROM `4_buy` a, 4_users b, 4_product_name c
WHERE a.`product_id` = c.product_id
and a.`user_id` = b.user_id
and MONTH(a.`buy_date`) = 3

(4) найти суммарные покупки на сайте помесячно
(то есть результат будет в таком виде: март 2010 — сумма1, апрель 2010 — сумма2, май 2010 — сумма3 и тд).
SELECT sum(a.`bue_price`), CONCAT(MONTHNAME(a.`buy_date`),' ', year(a.`buy_date`))
FROM `4_buy` a, 4_users b, 4_product_name c
WHERE a.`product_id` = c.product_id
and a.`user_id` = b.user_id
GROUP by MONTH(a.`buy_date`) , year(a.`buy_date`)
---------------------------------------------------------
1
(1) достать товары вместе с категориями
SELECT  b.product_name, c.category_name
FROM `1_product` a, 1_product_name b, 1_category_name c
WHERE a.`product_id`= b.product_id
and a.`country_id`= c.category_id
order by 1

(2) достать товары из категории 'Овощи',
SELECT *
FROM `1_product` a,
1_product_name b,
1_category_name c,
1_store d
WHERE a.`product_id`= b.product_id
and a.`country_id`= c.category_id
and b.product_id = d.product_id
and  c.category_name ='овощи'

(3) достать товары из категорий 'Овощи', 'Мясо', 'Морепродукты'
SELECT *
FROM `1_product` a,
1_product_name b,
1_category_name c,
1_store d
WHERE a.`product_id`= b.product_id
and a.`category_id`= c.category_id
and b.product_id = d.product_id
and  c.category_name in ('овощи', 'мясо', 'морепродукты')

(4) достать все категории (без товаров, только названия категорий)
SELECT *
FROM `1_category_name`

(5) достать все категории, в которых есть товары (без товаров, только названия категорий, без дублей).


------------------------
-------------------------- с джотнами
5
SELECT *
FROM `5_messeges` a, 5_page b, 5_users c
WHERE
a.`user_id` = c.id
and a.`page_id` = b.id

SELECT *
FROM `5_messeges` a
INNER JOIN
5_page b on a.`page_id` = b.id
INNER JOIN
5_users c on a.`user_id` = c.id

(2) получить все комментарии данного пользователя
SELECT *
FROM `5_messeges` a, 5_page b, 5_users c
WHERE
a.`user_id` = c.id
and a.`page_id` = b.id
and c.user = 'fox'


SELECT *
FROM `5_messeges` a
INNER JOIN
5_page b on a.`page_id` = b.id
INNER JOIN
5_users c on a.`user_id` = c.id
WHERE
c.user = 'fox'

1) получить все комментарии к данной странице,
SELECT *
FROM `5_messeges` a, 5_page b, 5_users c
WHERE
a.`user_id` = c.id
and a.`page_id` = b.id
and b.`page_name` = 'contact'

SELECT *
FROM `5_messeges` a
INNER JOIN
5_page b on a.`page_id` = b.id
INNER JOIN
5_users c on a.`user_id` = c.id
WHERE
b.`page_name` = 'contact'



или без таблицы юсерс если пользователи пишут свое имя в форме а не регаются

SELECT *
FROM `5_messeges` a, 5_page b
WHERE
a.`page_id` = b.id
and a.`user_name` = 'qqq'

---------------------------------------------------------

3

(1) достать все товары вместе с их категориями
SELECT *
FROM `3_product_name` a, `3_product` b, `3_category_name` c
WHERE b.product_id = a.`product_id`
and b.categoria_id = c.categoria_id

SELECT *
FROM `3_product_name` a
inner join `3_product` b on b.product_id = a.`product_id`
inner join`3_category_name` c on b.categoria_id = c.categoria_id



(2) достать товар 'Огурец' вместе с его категориями
SELECT *
FROM `3_product_name` a, `3_product` b, `3_category_name` c
WHERE b.product_id = a.`product_id`
and b.categoria_id = c.categoria_id
and a.`product_name` = 'огурец'

SELECT *
FROM `3_product_name` a
inner join `3_product` b on b.product_id = a.`product_id`
inner join`3_category_name` c on b.categoria_id = c.categoria_id
where
a.`product_name` = 'огурец'


(3) достать все товары из категории 'Овощи',
SELECT *
FROM `3_product_name` a, `3_product` b, `3_category_name` c
WHERE b.product_id = a.`product_id`
and b.categoria_id = c.categoria_id
and c.`categoria_name` = 'овощи'

SELECT *
FROM `3_product_name` a
inner join `3_product` b on b.product_id = a.`product_id`
inner join`3_category_name` c on b.categoria_id = c.categoria_id
where c.`categoria_name` = 'овощи'

(4) достать все товары, которые принадлежат более чем одной категории
SELECT COUNT(b.product_id), a.product_name
FROM `3_product_name` a, `3_product` b, `3_category_name` c
WHERE b.product_id = a.`product_id`
and b.categoria_id = c.categoria_id
group by b.product_id
HAVING COUNT(b.product_id)>1


SELECT COUNT(b.product_id), a.product_name
FROM `3_product_name` a
inner join `3_product` b on b.product_id = a.`product_id`
inner join`3_category_name` c on b.categoria_id = c.categoria_id
group by b.product_id
HAVING COUNT(b.product_id)>1

---------------------------------------------------------
4
(1) вывести пользователей вместе с их покупками,
SELECT *
FROM `4_buy` a, 4_users b, 4_product_name c
WHERE a.`product_id` = c.product_id
and a.`user_id` = b.user_id
order by a.`user_id`, a.`buy_date`

SELECT *
FROM `4_buy` a
inner join 4_users b on   a.`user_id` = b.user_id
inner join 4_product_name c on a.`product_id` = c.product_id
order by a.`user_id`, a.`buy_date`

(2) вывести пользователей вместе с суммами всех их покупок
SELECT sum(a.`bue_price`) , a.`user_id`, b.user_name
FROM `4_buy` a, 4_users b, 4_product_name c
WHERE a.`product_id` = c.product_id
and a.`user_id` = b.user_id
group by a.`user_id`

SELECT sum(a.`bue_price`) , a.`user_id`, b.user_name
FROM `4_buy` a
inner join 4_users b on   a.`user_id` = b.user_id
inner join 4_product_name c on a.`product_id` = c.product_id
group by a.`user_id`

(3) найти суммарные покупки на сайте за определенный месяц,
SELECT sum(a.`bue_price`)
FROM `4_buy` a, 4_users b, 4_product_name c
WHERE a.`product_id` = c.product_id
and a.`user_id` = b.user_id
and MONTH(a.`buy_date`) = 3

SELECT sum(a.`bue_price`)
FROM `4_buy` a
inner join 4_users b on   a.`user_id` = b.user_id
inner join 4_product_name c on a.`product_id` = c.product_id
WHERE MONTH(a.`buy_date`) = 3

(4) найти суммарные покупки на сайте помесячно
(то есть результат будет в таком виде: март 2010 — сумма1, апрель 2010 — сумма2, май 2010 — сумма3 и тд).
SELECT sum(a.`bue_price`), CONCAT(MONTHNAME(a.`buy_date`),' ', year(a.`buy_date`))
FROM `4_buy` a, 4_users b, 4_product_name c
WHERE a.`product_id` = c.product_id
and a.`user_id` = b.user_id
GROUP by MONTH(a.`buy_date`) , year(a.`buy_date`)

SELECT sum(a.`bue_price`), CONCAT(MONTHNAME(a.`buy_date`),' ', year(a.`buy_date`))
FROM `4_buy` a
inner join 4_users b on   a.`user_id` = b.user_id
inner join 4_product_name c on a.`product_id` = c.product_id
GROUP by MONTH(a.`buy_date`) , year(a.`buy_date`)
---------------------------------------------------------
2
(1) достать всех пользователей вместе с их городом и страной
SELECT *
FROM `2_users` a, 2_country b, 2_city c
WHERE a.`city_id` = c.city_id
and c.country_id = b.country_id

SELECT *
FROM `2_users` a
inner join 2_city c  on  a.`city_id` = c.city_id
inner join 2_country b  on c.country_id = b.country_id

(2) достать все города с их странами
SELECT *
FROM  2_country b, 2_city c
WHERE
c.country_id = b.country_id

SELECT *
FROM  2_country b
inner join 2_city c on c.country_id = b.country_id

3) достать всех пользователей из страны Беларусь (без городов),
SELECT `user_name`, b.country_name
FROM `2_users` a, 2_country b, 2_city c
WHERE a.`city_id` = c.city_id
and c.country_id = b.country_id
and b.country_name = 'Беларусь'

SELECT *
FROM `2_users` a
inner join 2_city c  on  a.`city_id` = c.city_id
inner join 2_country b  on c.country_id = b.country_id
where b.country_name = 'Беларусь'

(4) достать всех пользователей из города Минск (без страны),
SELECT `user_name`, c.city_name
FROM `2_users` a,  2_city c
WHERE a.`city_id` = c.city_id
and c.city_name = 'Минск'

(5) вывести список стран с количеством пользователей в них.
SELECT count(a.user_id), b.country_name
FROM `2_users` a, 2_country b, 2_city c
WHERE a.`city_id` = c.city_id
and c.country_id = b.country_id
group by b.country_id

SELECT count(a.user_id), b.country_name
FROM `2_users` a
inner join 2_city c  on  a.`city_id` = c.city_id
inner join 2_country b  on c.country_id = b.country_id
group by b.country_id

---------------------------------------------------------
1
(1) достать товары вместе с категориями
SELECT  b.product_name, c.category_name
FROM `1_product` a, 1_product_name b, 1_category_name c
WHERE a.`product_id`= b.product_id
and a.`country_id`= c.category_id
order by 1

SELECT b.product_name, c.category_name
FROM `1_product` a
INNER join 1_product_name b on a.`product_id`= b.product_id
iNNER join 1_category_name c on a.`category_id`= c.category_id
order by 1

(2) достать товары из категории 'Овощи',
SELECT *
FROM `1_product` a,
1_product_name b,
1_category_name c,
1_store d
WHERE a.`product_id`= b.product_id
and a.`country_id`= c.category_id
and b.product_id = d.product_id
and  c.category_name ='овощи'

SELECT *
FROM `1_product` a
INNER join 1_product_name b on a.`product_id`= b.product_id
iNNER join 1_category_name c on a.`category_id`= c.category_id
where  c.category_name ='овощи'

(3) достать товары из категорий 'Овощи', 'Мясо', 'Морепродукты'
SELECT *
FROM `1_product` a,
1_product_name b,
1_category_name c,
1_store d
WHERE a.`product_id`= b.product_id
and a.`category_id`= c.category_id
and b.product_id = d.product_id
and  c.category_name in ('овощи', 'мясо', 'морепродукты')

SELECT *
FROM `1_product` a
INNER join 1_product_name b on a.`product_id`= b.product_id
iNNER join 1_category_name c on a.`category_id`= c.category_id
iNNER join 1_store d on b.product_id = d.product_id
where c.category_name in ('овощи', 'мясо', 'морепродукты')


(4) достать все категории (без товаров, только названия категорий)
SELECT *
FROM `1_category_name`

(5) достать все категории, в которых есть товары (без товаров, только названия категорий, без дублей).

SELECT *
FROM `1_product` a
right join 1_category_name c on a.`category_id`= c.category_id
left join 1_product_name b on a.`product_id`= b.product_id


------------------------