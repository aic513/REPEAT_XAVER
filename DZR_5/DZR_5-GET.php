<?php
header('Content-type: text/html; charset=utf-8');


function all_news($news){
    foreach ($news as $key => $value) {
        echo $key .' - ';
        echo $value .'<br>';
    }
}




if(isset($_GET['id'])){
     $id = (int)$_GET['id'];
     echo $news[$id];
}
else{
    all_news($news);
}


if ($_GET['id']>count($news)) {
    header('HTTP/1.0 404 NOT FOUND');
    echo '<h1>ERROR 404 Not Found</h1><br/>';
}


