<?php
header('Content-type: text/html; charset=utf-8');
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);

echo 'Task_1 <p>';
$name = "Denis";
$age = 26;
echo "Меня зовут " .$name. " мне " .$age. " лет <p>";
echo 'Сейчас будут ошибки, что переменные не определены';
unset($name,$age);
echo $name;
echo $age;
echo '<p>';


echo 'Task_2 <p>';
define("CITY","Kaluga");

if(CITY){
    echo CITY .'<p>';
}
echo "Меняю значение объявленной константы - будет ошибка";
define("CITY", "TVER");
echo '<p>';


echo 'Task_3 <p>';
$book = array(
    "title"=>"'Отцы и дети'",
    "author"=>"Тургеневым",
    "pages"=>"524",
);
echo "Недавно я прочитал книгу " .$book['title']. ", написанную автором - " .$book['author'].
" ,я осилил все " .$book['pages']. " страницы, мне она очень понравилась";


echo '<p>';
echo 'Task_4 <p>';

$books = array(
    $book1 = array(
        'title1' => "'Война и мир'",
        'author1' => "Толстым",
        'pages1' => "5842552",
    ),
    $book2 = array(
        "title2" => "'Собчаье сердце'",
        "author2" => "Грибоедовым",
        "pages2" => "4751",
    )
);

$all_pages = $books[0]['pages1'] + $books[1]['pages2'];

echo "Недавно я прочитал книги " .$books[0]['title1']. " и " .$books[1]['title2'].
", написанные соответственно " .$books[0]['author1']. " и " .$books[1]['author2'].
", я осилил все " .$all_pages. " страниц, не ожидал от себя подобного.";

?>