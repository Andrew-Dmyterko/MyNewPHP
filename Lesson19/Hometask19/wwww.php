<?php

class Book
{
    public $key;
    private $title;
    private $author;
    private $description;
    private $image;

    /**
     * метод принимает текстовое значение,
     * проверяет количество символов
     * и присваивает его в свойство $title
     */
    function __construct($title)
    {
        $this->title = $title;
        $books = self::getList();
        foreach ($books as $key => $book) {
            if ($book['title'] == $title) {
                $this->author = $book['author'];
                $this->description = $book['description'];
                $this->image = $book['image'];
                $this->key = $key;
            }
        }
    }

    /**
     * возращает список книг из файла
     */
    static function getList()
    {
        $books = array(
            [
                'title' => 'Continuous Delivery',
                'author' => 'Jez Humble & David Farley',
                'description' => 'Getting software released to users is often a painful, risky, and time-consuming process. This groundbreaking new book sets out the principles and technical practices that enable rapid, incremental delivery of high quality, valuable new functionality to users. Through automation of the build, deployment, and testing process, and improved collaboration between developers, testers, and operations, delivery teams can get changes released in a matter of hours— sometimes even minutes–no matter what the size of a project or the complexity of its code base.
                Jez Humble and David Farley begin by presenting the foundations of a rapid, reliable, low-risk delivery process. Next, they introduce the «deployment pipeline,» an automated process for managing all changes, from check-in to release. Finally, they discuss the «ecosystem» needed to support continuous delivery, from infrastructure, data and configuration management to governance.
                ',
                'image' => 'image/Continuous_Delivery.png',
            ],
            [
                'title' => 'Rapid Development',
                'author' => 'Steve McConnell',
                'description' => 'Corporate and commercial software-development teams all want solutions for one important problem — how to get their high-pressure development schedules under control. In «Rapid Development», author Steve McConnell addresses that concern head-on with overall strategies, specific best practices, and valuable tips that help shrink and control development schedules and keep projects moving. Inside, you’ll find:
                    A rapid-development strategy that can be applied to any project and the best practices to make that strategy work;
                    Candid discussions of great and not-so-great rapid-development practices — estimation, prototyping, forced overtime, motivation, teamwork, rapid-development languages, risk management, and many others;
                    A list of classic mistakes to avoid for rapid-development projects, including creeping requirements, shortchanged quality, and silver-bullet syndrome;
                    Case studies that vividly illustrate what can go wrong, what can go right, and how to tell which direction your project is going;
                    Rapid Development is the real-world guide to more efficient applications development.',
                'image' => 'image/rapid.jpg',
            ],
            [
                'title' => 'Алгоритмы. Построение и анализ',
                'author' => 'Томас Х. Кормен, Чарльз И. Лейзерсон',
                'description' => 'Книга «Алгоритмы. Построение и анализ» удачно объединяет в себе полноту охвата и строгость изложения материала. Много книг, посвященных алгоритмам, отличаются строгостью изложения материала, но страдают определённой неполнотой; другие книги охватывают огромный объём материала, но недостаточно строго излагают его. В данной книге описаны самые разнообразные алгоритмы, сочетается широкий диапазон тем с глубиной и полнотой изложения; при этом изложение доступно для читателей самого разного уровня подготовки. Каждая глава книги относительно самодостаточна и может использоваться в качестве отдельной темы для изучения. Алгоритмы в книге описаны простым человеческим языком и с применением псевдокода, который понятен любому, кто хоть в небольшой степени знаком с программированием, а пояснения принципов их работы даны без излишней математической строгости и требуют лишь элементарных знаний.
                Каждый может найти в ней именно тот материал, который касается интересующей его темы и представлен именно с тем уровнем сложности и строгости, который требуется читателю.
                Описание алгоритмов на естественном языке дополняется псевдокодом, который позволяет любому имеющему хотя бы начальные знания и опыт программирования, реализовать алгоритм на используемом им языке программирования. Строгий математический анализ и обилие теорем сопровождаются большим количеством иллюстраций, элементарными рассуждениями и простыми приближенными оценками. Широта охвата материала и степень строгости его изложения дают основания считать эту книгу одной из лучших книг, посвященных разработке и анализу алгоритмов.',
                'image' => 'image/algoritmy.png',
            ],
            [
                'title' => 'Чистый код. Создание, анализ и рефакторинг',
                'author' => 'Роберт Мартин',
                'description' => 'Даже плохой программный код может работать. Однако если код не является «чистым», это всегда будет мешать развитию проекта и компании-разработчика, отнимая значительные ресурсы на его поддержку и «укрощение».
                Эта книга посвящена хорошему программированию. Она полна реальных примеров кода. Мы будем рассматривать код с различных направлений: сверху вниз, снизу вверх и даже изнутри. Прочитав книгу, вы узнаете много нового о коде. Более того, вы научитесь отличать хороший код от плохого. Вы узнаете, как писать хороший код и как преобразовать плохой код в хороший.
                Книга состоит из трёх частей. В первой части излагаются принципы, паттерны и приёмы написания чистого кода; приводится большой объём примеров кода. Вторая часть состоит из практических сценариев нарастающей сложности. Каждый сценарий представляет собой упражнение по чистке кода или преобразованию проблемного кода в код с меньшим количеством проблем. Третья часть книги  — концентрированное выражение её сути. Она состоит из одной главы с перечнем эвристических правил и «запахов кода», собранных во время анализа. Эта часть представляет собой базу знаний, описывающую наш путь мышления в процессе чтения, написания и чистки кода.',
                'image' => 'image/cleancode-198x280.jpg'
            ],
            [
                'title' => 'Совершенный код. Мастер-класс',
                'author' => 'Стив Макконнелл',
                'description' => 'Более 10 лет первое издание этой книги считалось одним из лучших практических руководств по программированию. Сейчас эта книга полностью обновлена с учётом современных тенденций и технологий и дополнена сотнями новых примеров, иллюстрирующих искусство и науку программирования. Опираясь на академические исследования, с одной стороны, и практический опыт коммерческих разработок ПО — с другой, автор синтезировал из самых эффективных методик и наиболее эффективных принципов ясное прагматичное руководство. Каков бы ни был ваш профессиональный уровень, с какими бы средствами разработками вы ни работали, какова бы ни была сложность вашего проекта, в этой книге вы найдёте нужную информацию, она заставит вас размышлять и поможет создать совершенный код.',
                'image' => 'image/mcconnel-197x280.jpg'
            ]
        );
        return $books;
    }

    /**
     * присваивает значение всем существующим свойствам,
     * к которым пользоватль обратился напрямую
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function delete()
    {
        $books = self::getList();
        unset($books[$this->key]);
    }
}

$book1 = new Book('Rapid Development');
var_dump($book1);
$book2 = new Book('Алгоритмы. Построение и анализ');
var_dump($book2);
$book1->delete();
echo "<hr>";


class Message {
private $name;
private $surname = 'Ivanov';
private $age;
static public $count;
function __construct($name){
$this->name = $name;
self::$count++;
echo 'Hello, '.$this->name.'<br>';
}
function __get($property){//'name'
switch($property){
case 'fullname':
return $this->surname." ".$this->name;
break;
case 'name':
return 'Hello, '.$this->name;
break;
default:
return "Not access";
break;
}
}
function __set($param, $value){
$this->$param = $value;
}
function getName(){
return $this->name;
}
function __destruct()
{
self::$count--;
echo "Bye".$this->name;
}
}
$message = new Message('Goga');
$message->surname = 'Petrov';
echo $message->fullname;
$message2 = new Message('Yan');
echo $message2->fullname;
$message3 = new Message('Lena');
echo $message3->surname;
unset($message);
echo Message::$count;