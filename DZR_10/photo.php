<?php

header("Content-Type: text/html; charset=utf-8");
require_once ("startup.php");
if (!isset($_GET['id'])) {
    header('Location:index.php');
} else {
    require_once ('startup.php');
    require_once ('img_functions.php');
    $id = $_GET['id'];
    $startup->query("UPDATE `photo` SET watches=watches+1 WHERE id_image='$id'");
    $row = $startup->selectRow("SELECT * FROM `photo` WHERE id_image =?d", $id);
    echo "<img src=img_big/{$row['id_image']}.{$row['mime_type']} alt='picture'>";
    echo "<h3>Количество просмотров: {$row['watches']}</h3>";
}


