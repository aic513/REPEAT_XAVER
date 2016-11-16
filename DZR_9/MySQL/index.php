<?php

header('Content-type: text/html; charset=utf-8');
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);
require_once ('startup.php');
require_once ('ads_model.php');
require_once ('img_model.php');
require_once('ads_functions.php');
require_once('img_functions.php');
require_once('smarty_connect.php');

if (isset($_POST['confirm'])) {
    if (isset($_GET['show_id']) && is_numeric($_GET['show_id'])) {
        edit_ads($_POST);
    } else {
        insert_ads($_POST);
    }restart();
} elseif (isset($_POST['clear_form'])) {
    restart();
} elseif (isset($_POST['clear_base'])) {
    clear_base();
    restart();
} elseif (isset($_GET['delete_ads'])) {
    delete_ads((int) ($_GET['delete_ads']));
    restart();
} elseif (isset($_GET['show_id'])) {
    $show_id = (int) ($_GET['show_id']);
    if (mysql_fetch_array(mysql_query("SELECT `id` FROM `advertisement` WHERE id='$show_id'"))) {
        return_form($smarty, $show_id);
    }
} elseif (isset($_POST['clear_photos'])) {
    delete_all();
    clear_dirs(array("img_big/", "img_small/"));
     restart();
} elseif (isset($_POST['download_file'])) {
    if (isset($_FILES['fupload'])) {
        upload_image($_FILES['fupload']);
        restart();
    }
} else {
    return_form($smarty);
    show_ads($ads_table);
    show_gallery();
}















