<?php

header("Content-Type: text/html; charset=utf-8");
if (!isset($_GET['id'])) {
    header('Location:index.php');
} else {
    require_once ('startup.php');
    require_once ('img_functions.php');
    $id = $_GET['id'];
    mysqli_query($startup,"UPDATE `photo` SET watches=watches+1 WHERE id_image='$id'");
    $sql = mysqli_query($startup,"SELECT * FROM `photo` WHERE id_image='$id'")
            or die('error query'.  mysqli_error($startup));

    if (mysqli_num_rows($sql) == 0) {
        header("location:index.php");
    }
    $row = mysqli_fetch_assoc($sql);
    echo "<img src=img_big/{$row['id_image']}.{$row['mime_type']} alt='picture'>";
    echo "<h3>Количество просмотров: {$row['watches']}</h3>";
}


