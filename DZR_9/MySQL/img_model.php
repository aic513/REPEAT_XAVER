<?php
require_once ('startup.php');
function get_img() {
    $sql = "SELECT * FROM `photo`";
    $result = mysql_query($sql);

    if (!$result)
        die(mysql_error());

    $number = mysql_num_rows($result);
    $arr = array();


    for ($i = 0; $i < $number; $i++) {
        $row = mysql_fetch_assoc($result);
        $arr[] = $row;
    }
    return $arr;
}

function send_img($type) {
    $sql = "INSERT INTO `photo` (mime_type) VALUES('$type')";
    $result = mysql_query($sql)
            or die('query bad<br>');
}

function get_last_img() {
    $sql = "SELECT * FROM `photo` ORDER BY id_image DESC LIMIT 1";
    $result = mysql_query($sql) or die('error'.  mysql_error());
    return mysql_fetch_assoc($result);
}

function delete_all() {
    $result = mysql_query("TRUNCATE TABLE `photo`");
    if (!$result) {
        echo 'Запрос удаления фотографий не выполнился'.  mysql_error();
    }else{
        return $result;
    }

}