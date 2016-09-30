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

function all_news($news){
    foreach ($news as $key => $value) {
        echo $key .' - ';
        echo $value .'<br>';
    }
}


if(isset($_POST['id'])){
     $id = (int)$_POST['id'];
     echo $news[$id];
}
else{
    all_news($news);
}

if ($_POST['id']>count($news)) {
    header('HTTP/1.0 404 NOT FOUND');
    echo '<h1>ERROR 404 Not Found</h1><br/>';
}

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Тег FORM</title>
    </head>
    <body>
        <form method="POST">
            <p><input type="text" name="id" value="" placeholder="введите номер новости"></p>
            <p><input type="submit"></p>
        </form>
    </body>
</html>



