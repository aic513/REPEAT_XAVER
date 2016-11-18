<?php

header('Content-type: text/html; charset=utf-8');
require_once ('connect_mysql.php');


$startup = new mysqli($ServerName, $UserName, $Password, $Database);
if (!$startup) {
    echo "Не удалось подключиться к MySQLi: " . mysqli_error($startup);
}
if (!mysqli_select_db($startup, $Database)) {
    die('Не удалось выбрать базу данных ads_db '.  mysqli_error($startup));
}
mysqli_query($startup, "SET NAMES utf8");




