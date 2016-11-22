<?php
require_once ('startup.php');
function get_img($startup) {
    return $startup -> select("SELECT * FROM `photo`");
}

function send_img($startup,$type) {
    $startup->query("INSERT INTO `photo` (mime_type) VALUES('$type')");
}

function get_last_img($startup) {
    return $startup->query("SELECT * FROM `photo` ORDER BY id_image DESC LIMIT 1");
}

function delete_all($startup) {
    return  $startup->query("DELETE FROM `photo` WHERE id_image>0");
}