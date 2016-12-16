<?php

header("Content-Type: text/html; charset=utf-8");
require_once ("startup.php");
if (!isset($_GET['id'])) {
    header('Location:index.php');
} else {
    $id = $_GET['id'];
    $db = db::instance();
    $db->query("UPDATE `photo` SET watches=watches+1 WHERE id_image='$id'");
    $row = $db->selectRow("SELECT * FROM `photo` WHERE id_image =?d", $id);
    echo "<img src=img_big/{$row['id_image']}.{$row['mime_type']} alt='picture'>";
    echo "<h3>Количество просмотров: {$row['watches']}</h3>";
}


