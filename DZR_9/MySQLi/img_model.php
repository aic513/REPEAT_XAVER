<?php
require_once ('startup.php');
function get_img($startup) {
    $sql = "SELECT * FROM `photo`";
    $result = mysqli_query($startup,$sql);

    if (!$result)
        die(mysqli_error($startup));

    $number = mysqli_num_rows($result);
    $arr = array();


    for ($i = 0; $i < $number; $i++) {
        $row = mysqli_fetch_assoc($result);
        $arr[] = $row;
    }
    return $arr;
}

function send_img($startup,$type) {
    $sql = "INSERT INTO `photo` (mime_type) VALUES('$type')";
    $result = mysqli_query($startup,$sql)
            or die('query bad'.mysqli_error($startup));
}

function get_last_img($startup) {
    $sql = "SELECT * FROM `photo` ORDER BY id_image DESC LIMIT 1";
    $result = mysqli_query($startup,$sql) or die('error'.  mysqli_error($startup));
    return mysqli_fetch_assoc($result);
}

function delete_all($startup) {
    $result = mysqli_query($startup,"TRUNCATE TABLE `photo`");
    if (!$result) {
        echo 'Запрос удаления фотографий не выполнился'.  mysqli_error($startup);
    }else{
        return $result;
    }

}