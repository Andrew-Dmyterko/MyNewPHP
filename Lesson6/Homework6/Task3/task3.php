<pre>
<?php
$file = "books.us";
$fileDesc = file_get_contents($file);
$books = unserialize($fileDesc);

//var_dump($books);

$newFile = 'newBooks.us';

$arr1 = [
    'title' => 'Continuous Delivery',
    'author' => 'Jez Humble & David Farley',
    'description' => 'Getting software released to users is often a painful, risky, and time-consuming process. This groundbreaking new book sets out the principles and technical practices that enable rapid, incremental delivery of high quality, valuable new functionality to users. Through automation of the build, deployment, and testing process, and improved collaboration between developers, testers, and operations, delivery teams can get changes released in a matter of hours— sometimes even minutes–no matter what the size of a project or the complexity of its code base.
        Jez Humble and David Farley begin by presenting the foundations of a rapid, reliable, low-risk delivery process. Next, they introduce the «deployment pipeline,» an automated process for managing all changes, from check-in to release. Finally, they discuss the «ecosystem» needed to support continuous delivery, from infrastructure, data and configuration management to governance.
        ',
    'image' => 'book/image/Continuous_Delivery.png',
    ];
$arr2 = [
        'title' => 'Rapid Development',
        'author' => 'Steve McConnell',
        'description' => 'Corporate and commercial software-development teams all want solutions for one important problem — how to get their high-pressure development schedules under control. In «Rapid Development», author Steve McConnell addresses that concern head-on with overall strategies, specific best practices, and valuable tips that help shrink and control development schedules and keep projects moving. Inside, you’ll find:
            A rapid-development strategy that can be applied to any project and the best practices to make that strategy work;
            Candid discussions of great and not-so-great rapid-development practices — estimation, prototyping, forced overtime, motivation, teamwork, rapid-development languages, risk management, and many others;
            A list of classic mistakes to avoid for rapid-development projects, including creeping requirements, shortchanged quality, and silver-bullet syndrome;
            Case studies that vividly illustrate what can go wrong, what can go right, and how to tell which direction your project is going;
            Rapid Development is the real-world guide to more efficient applications development.',
        'image' => 'book/image/rapid.jpg',
    ];

$f = fopen($newFile,"a+");

fwrite($f, serialize($arr1));
fwrite($f, serialize($arr2));

$fileCsv = "newBooks.csv";
$f1 = fopen($fileCsv,"a+");

$arr = fgetcsv($f1);

var_dump($arr);

$arr = fgetcsv($f1);

var_dump($arr);

//fputcsv($f1, $arr1);
//fputcsv($f1, $arr2);

//$file = "newBooks.us";
//
//$fileDesc = file_get_contents($file);
//
//echo $fileDesc;
//
//$b = unserialize($fileDesc);
//
//echo "<br>";
//
//var_dump($b);
$arr3 = [
    'title' => 'Совершенный код. Мастер-класс',
    'author' => 'Стив Макконнелл',
    'description' => 'Более 10 лет первое издание этой книги считалось одним из лучших практических руководств по программированию. Сейчас эта книга полностью обновлена с учётом современных тенденций и технологий и дополнена сотнями новых примеров, иллюстрирующих искусство и науку программирования. Опираясь на академические исследования, с одной стороны, и практический опыт коммерческих разработок ПО — с другой, автор синтезировал из самых эффективных методик и наиболее эффективных принципов ясное прагматичное руководство. Каков бы ни был ваш профессиональный уровень, с какими бы средствами разработками вы ни работали, какова бы ни была сложность вашего проекта, в этой книге вы найдёте нужную информацию, она заставит вас размышлять и поможет создать совершенный код.',
    'image' => 'book/image/mcconnel-197x280.jpg'
];



//fclose($f);
//fclose($f1);
$fileCsv = "newBooks.csv";

$f2 = fopen($fileCsv,"a+");

fputcsv($f2, $arr3);
fclose($f2);

$file = "books.us";
$f3 = fopen($file,"a+");

$string = fgets($f3);

echo "\n$string";

fclose($f3);

//
//$fileDesc = file_get_contents($file);
//
//echo $fileDesc;
//
//$b = unserialize($fileDesc);
//
//echo "<br>";
//
//var_dump($b);