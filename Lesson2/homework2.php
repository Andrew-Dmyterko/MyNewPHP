<pre>
<?php

// ДЗ к второй лекции "Массивы"

/**
 * Задача1 вариант через for
 *
 * Створіть масив $newArray;
 * Заповніть його числами від 1 до 100;
 * Виведіть всі значення масиву.
 *
 */

// через for

echo "* Задача1 вариант через for\n\n";

$newArray = array();

for ($i=1; $i<=100; $i++) {
    $newArray[]=$i;
}

var_dump($newArray);

echo count($newArray)."\n";

echo '$newArray= '.implode($newArray,",");

echo "\n<hr>\n";


/**
 * Задача1 вариант через foreach
 *
 * Створіть масив $a;
 * Заповніть його числами від 1 до 100;
 * Виведіть всі значення масиву.
 *
 */

// через foreach

echo "* Задача1 вариант через foreach\n\n";

$a = array();

$a = [1,2]; // должен быть как минимум один єлемент в массиве иначе не войдем в foreach или вернее сразу выйдем :)
foreach($a as &$v) {
//    echo "$v\n";
//    $a[count($a)]=count($a)+1;
    $a[]=count($a)+1;
    if (count($a)==100) break;
}

var_dump($a);

echo count($a)."\n";

echo '$a= '.implode($a,",");

echo "\n<hr>\n";

/**
 * Задача2
 *
 * Створити масів з студентами (имя, вік, група)
 * Додати колонку «№ студента»;
 * № студента отримати з індексного масиву у відповідності до індексу в першій колонці таблиці.
 *
 */

$students = [];
$students = [
    [
        'tab_no' => 1,
        'fam'    => "Petrov",
        'name'   => "Roma",
        'age'    => 15
    ],
    [
        'tab_no' => 2,
        'fam'    => "Kulko",
        'name'   => "Ivan",
        'age'    => 17
    ],
    [
        'tab_no' => 7,
        'fam'    => "Sidoruk",
        'name'   => "Anna",
        'age'    => 18
    ],
    [
        'tab_no' => 9,
        'fam'    => "Alekseev",
        'name'   => "Petro",
        'age'    => 20
    ],
    [
        'tab_no' => 10,
        'fam'    => "Kushnir",
        'name'   => "Liliya",
        'age'    => 15
    ],
    [
        'tab_no' => 11,
        'fam'    => "Medik",
        'name'   => "Gleb",
        'age'    => 18
    ],
    [
        'tab_no' => 13,
        'fam'    => "Havaro",
        'name'   => "Kirill",
        'age'    => 20
    ],
    [
        'tab_no' => 14,
        'fam'    => "Urban",
        'name'   => "Timur",
        'age'    => 15
    ]
];

echo "<b>* Задача2</b> \n\n";

echo "<b>* Список студентов</b>";
echo '<table border="1">';
echo '<tr><th>№</th><th>Таб№</th><th>Фамилия,Имя</th><th>Возраст</th></tr>';

foreach ($students as $key => $student) {
    echo "<tr><td>$key</td><td>".$student['tab_no']."</td><td>".$student['fam']." ".$student['name']."</td><td>".$student['age']."</td></tr>";

}

echo '</table>';

echo "\n<hr>\n";


/**
 * Задача 3
 *
 * Створіть асоціативний масив з назвами та адресами
 * ваших улюблених фільмів на каналі YouTube.
 * Виведіть масив.
 *
 */

$myFilms = [];

$myFilms = [
    [
        'name' => "Интерстеллар",
        'url'  => "http://ex-fs.net/films/22664-interstellar.html"
    ],
    [
        'name' => "Апокалипсис сегодня",
        'url'  => "http://ex-fs.net/films/5759-apokalipsis-segodnya.html"
    ],
    [
        'name' => "Цельнометаллическая оболочка - Гоблин",
        'url'  => "http://ex-fs.net/films/70387-celnometallicheskaya-obolochka-goblin.html"
    ],
    [
        'name' => "13 часов: Тайные солдаты Бенгази",
        'url'  => "http://ex-fs.net/films/62920-13-chasov-taynye-soldaty-bengazi.html"
    ],
    [
        'name' => "2001 год: Космическая одиссея",
        'url'  => "http://ex-fs.net/films/7934-2001-god-kosmicheskaya-odisseya.html"
    ],
    [
        'name' => "Космическая одиссея 2010",
        'url'  => "http://ex-fs.net/films/70004-kosmicheskaya-odisseya-2010.html"
    ],

];

echo "<b>* Задача3 </b>\n\n";
echo "<b>* Список фильмов</b>";
echo '<table border="1">';
echo '<tr><th>№</th><th>Название</th><th>Ссылка</th></tr>';

foreach ($myFilms as $key => $film) {
    echo "<tr><td>".($key+1)."</td><td>".$film['name']."</td><td><a href=\"".$film['url']."\">".$film['url']."</a></td></tr>";

}

echo '</table>';

echo "\n<hr>\n";

/**
 * Задача4
 *
 * Составить график дежурств студентов вида,
 * график зависит от номера группы
 *
 */

$students1 = [
    [
        'tab_no' => 1,
        'fam'    => "Petrov",
        'name'   => "Roma",
        'age'    => 15,
        'group'  => 1
    ],
    [
        'tab_no' => 2,
        'fam'    => "Kulko",
        'name'   => "Ivan",
        'age'    => 17,
        'group'  => 1
    ],
    [
        'tab_no' => 7,
        'fam'    => "Sidoruk",
        'name'   => "Anna",
        'age'    => 18,
        'group'  => 2
    ],
    [
        'tab_no' => 9,
        'fam'    => "Alekseev",
        'name'   => "Petro",
        'age'    => 20,
        'group'  => 2
    ],
    [
        'tab_no' => 10,
        'fam'    => "Kushnir",
        'name'   => "Liliya",
        'age'    => 15,
        'group'  => 1
    ],
    [
        'tab_no' => 11,
        'fam'    => "Medik",
        'name'   => "Gleb",
        'age'    => 18,
        'group'  => 2
    ],
    [
        'tab_no' => 13,
        'fam'    => "Havaro",
        'name'   => "Kirill",
        'age'    => 20,
        'group'  => 11
    ],
    [
        'tab_no' => 14,
        'fam'    => "Urban",
        'name'   => "Timur",
        'age'    => 15,
        'group'  => 1
    ]
];
$c = count($students1);

$group1 = [1,2,3,4,5,6,7,8]; // график группы 1
$group2 = [8,7,6,5,4,3,2,1]; // график группы 2

echo "<b>* Задача4 </b>\n\n";
echo "<b>* График дежурств</b>";
echo '<table border="1">';
echo '<tr><th>№</th><th>Таб№</th><th>Фамилия,Имя</th><th>Группа</th><th>Граффик</th></tr>';

foreach ($students1 as $key => $student1) {
    $grafik = "";
    if ($student1['group'] == 1) {
        $grafik = implode($group1," ");
    } elseif ($student1['group'] == 2) {
        $grafik = implode($group2," ");
    } else {
        $grafik = "none";
    }

    echo "<tr><td>".($key+1)."</td><td>".$student1['tab_no']."</td><td>".$student1['fam']." ".$student1['name']."</td><td>".$student1['group']."</td><td>".$grafik."</td></tr>";

}

echo '</table>';

echo "\n<hr>\n";







/**
 * Задача4  Вариант 2 через count
 *
 * Составить график дежурств студентов вида,
 * график зависит от номера группы
 *
 */



$students1 = [
    [
        'tab_no' => 1,
        'fam'    => "Petrov",
        'name'   => "Roma",
        'age'    => 15,
        'group'  => 1
    ],
    [
        'tab_no' => 2,
        'fam'    => "Kulko",
        'name'   => "Ivan",
        'age'    => 17,
        'group'  => 1
    ],
    [
        'tab_no' => 7,
        'fam'    => "Sidoruk",
        'name'   => "Anna",
        'age'    => 18,
        'group'  => 2
    ],
    [
        'tab_no' => 9,
        'fam'    => "Alekseev",
        'name'   => "Petro",
        'age'    => 20,
        'group'  => 2
    ],
    [
        'tab_no' => 10,
        'fam'    => "Kushnir",
        'name'   => "Liliya",
        'age'    => 15,
        'group'  => 1
    ],
    [
        'tab_no' => 11,
        'fam'    => "Medik",
        'name'   => "Gleb",
        'age'    => 18,
        'group'  => 2
    ],
    [
        'tab_no' => 13,
        'fam'    => "Havaro",
        'name'   => "Kirill",
        'age'    => 20,
        'group'  => 11
    ],
    [
        'tab_no' => 14,
        'fam'    => "Urban",
        'name'   => "Timur",
        'age'    => 15,
        'group'  => 1
    ],
    [
        'tab_no' => 144,
        'fam'    => "ban",
        'name'   => "mur",
        'age'    => 40,
        'group'  => 2
    ],
    [
        'tab_no' => 44,
        'fam'    => "Aan",
        'name'   => "Mur",
        'age'    => 44,
        'group'  => 1
    ],
    [
        'tab_no' => 33,
        'fam'    => "Andr",
        'name'   => "Dm",
        'age'    => 45,
        'group'  => 1
    ]
];
$c = count($students1);

//$group1 = [1,2,3,4,5,6,7,8]; // график группы 1
//$group2 = [8,7,6,5,4,3,2,1]; // график группы 2
$group1 = [];
$group2 = [];

for ($i=1, $j=$c; $i<=$c && $j>=0; $i++, $j-- ) {
    $group1[$i] = $i;
    $group2[$i] = $j;
}
//var_dump($group1);
//var_dump($group2);

echo "<b>* Задача4  Вариант 2 через count</b>\n\n";
echo "<b>* График дежурств</b>";
echo '<table border="1">';
echo '<tr><th>№</th><th>Таб№</th><th>Фамилия,Имя</th><th>Группа</th><th>Граффик</th></tr>';

foreach ($students1 as $key => $student1) {
    $grafik = "";
    if ($student1['group'] == 1) {
        $grafik = implode($group1," ");
    } elseif ($student1['group'] == 2) {
        $grafik = implode($group2," ");
    } else {
        $grafik = "none";
    }

    echo "<tr><td>".($key+1)."</td><td>".$student1['tab_no']."</td><td>".$student1['fam']." ".$student1['name']."</td><td>".$student1['group']."</td><td>".$grafik."</td></tr>";

}

echo '</table>';

echo "\n<hr>\n";









?>







</pre>