<?php
header('Content-type: text/html; charset=utf-8');

$news='Четыре новосибирские компании вошли в сотню лучших работодателей
Выставка университетов США: открой новые горизонты
Оценку «неудовлетворительно» по качеству получает каждая 5-я квартира в новостройке
Студент-изобретатель раскрыл запутанное преступление
Хоккей: «Сибирь» выстояла против «Ак Барса» в пятом матче плей-офф
Здоровое питание: вегетарианская кулинария
День святого Патрика: угощения, пивной теннис и уличные гуляния с огнем
«Красный факел» пустит публику на ночные экскурсии за кулисы и по закоулкам столетнего здания
Звезды телешоу «Голос» Наргиз Закирова и Гела Гуралиа споют в «Маяковском»';
$news=  explode("\n", $news);

$news = array_combine(array_merge(array_slice(array_keys($news), 1), array(count($news))), array_values($news));

function all_news($news){
    foreach ($news as $key => $value) {
        echo $key .' - ';
        echo $value .'<br>';
    }
}

function one_new($id, $news) {
    if (isset($_POST['id'])) {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if (($id > count($news)) || ($id <= 0) || (is_numeric($id) == FALSE)) {
            echo "New with id = " . $_POST['id'] . " doesn't exist";
            echo '<h1>ERROR 404 Not Found</h1>';
            echo '<br>';
            echo "<a href='DZR_5-POST.php'>Назад</a>";
        } else {
            echo $news[$id];
            echo '<br>';
            echo "<a href='DZR_5-POST.php'>Назад</a>";
        }
    } else {
        all_news($news);
    }
}

one_new($id, $news);

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>POST</title>
    </head>
    <body>
        <form method="POST">
            <p><input type="text" name="id" value="" placeholder="введите номер новости"></p>
            <p><input type="submit"></p>
        </form>
    </body>
</html>