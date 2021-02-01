
<?php
require_once "template.php";
require_once 'function_oop1.php';

$views = 'views/';

$content="";

if(!isset($_GET['page'])){
    $content = file_get_contents('views/main.html');
    $tpl->set_value('TITLE', 'My template title'); // {TITLE}
    $tpl->set_value('HEADER', 'My main page');
} else {
    $page = $_GET['page'];
    $file_name = $views.$page.'.html';

    if (file_exists($file_name)) {

        $tpl->set_value('TITLE', strtoupper($page)); // {TITLE}
        $tpl->set_value('HEADER', ucwords($page));

        $content = file_get_contents($file_name);
    } else {
        header("HTTP/1.0 404 Not Found");
        echo "<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">
            <html><head>
            <title>404 Not Found</title>
            </head><body>
            <h1>Not Found</h1>
            <p>The requested URL " . $_SERVER['REQUEST_URI'] . " was not found on this server.</p>
            <hr>
            <address>Apache/2.2.3 (CentOS) Server at " . $_SERVER['SERVER_NAME'] . " Port 80</address>
            </body></html>";
        exit();
    }
}

$tpl->get_tpl('views/template.html');

//Menue
$tpl->set_value('ABOUT', 'О нас');
$tpl->set_value('CONTACT', 'Контакты');
$tpl->set_value('HOME', 'Главная');
$tpl->set_value('BOOK', 'Книжки');

//books
if (isset($page) && $page == 'books') {
    $books = Book::getListBook(); // получаем массив книг books[]
//    var_dump($_GET); die;
    $contentAll = '<div class="row">';
    $tpl->set_value('TITLE', 'Все книги'); // {TITLE}
    $tpl->set_value('HEADER', 'Все книги');
    foreach ($books as $key => $book) {
        $contentAll = $contentAll.str_replace(['{url}', '{image}','{title}','{author}'],[$book['key'],$book['image'],$book['title'],$book['author']], $content);
//        $contentAll .= $content;
    }
    $content=$contentAll.'</div>';
} elseif (isset($page) && $page == 'book' && isset($_GET['key'])) {
    $book = new Book($_GET['key']);
    $book->getItemBook();
    $tpl->set_value('TITLE', $book->title); // {TITLE}
    $tpl->set_value('HEADER', $book->title);
    $content = str_replace(['{image}','{title}','{author}','{description}'],[$book->image,$book->title,$book->author,$book->description], $content);

}

$tpl->set_value('CONTENT', $content);


$tpl->tpl_parse();

print $tpl->html;