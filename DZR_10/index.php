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
$smarty->assign('cities', get_city($startup));
$smarty->assign('categories', get_category($startup));


if (isset($_POST['confirm'])) {
    if (isset($_GET['show_id']) && is_numeric($_GET['show_id'])) {
         isset($_POST['allow_mails']) ? $_POST['allow_mails'] = 1 : $_POST['allow_mails'] = 0;
        $post = array(
            'private' => (int) $_POST['private'],
            'name' => (string) $_POST['name'],
            'email' => (string) $_POST['email'],
            'allow_mails' => (int) $_POST['allow_mails'],
            'phone' => (string) $_POST['phone'],
            'location' => (int) $_POST['location'],
            'category' => (int) $_POST['category'],
            'title' => (string) $_POST['title'],
            'description' => (string) $_POST['description'],
            'price' => (int) $_POST['price']
        );
        edit_ads($startup, $post,$_GET['show_id']);
    } else {
        isset($_POST['allow_mails']) ? $_POST['allow_mails'] = 1 : $_POST['allow_mails'] = 0;
        $post = array(
            'private' => (int) $_POST['private'],
            'name' => (string) $_POST['name'],
            'email' => (string) $_POST['email'],
            'allow_mails' => (int) $_POST['allow_mails'],
            'phone' => (string) $_POST['phone'],
            'location' => (int) $_POST['location'],
            'category' => (int) $_POST['category'],
            'title' => (string) $_POST['title'],
            'description' => (string) $_POST['description'],
            'price' => (int) $_POST['price']
        );
        insert_ads($startup, $post);
    }
    restart();
} elseif (isset($_POST['clear_form'])) {
    restart();
} elseif (isset($_POST['clear_base'])) {
    clear_base($startup);
    restart();
} elseif (isset($_GET['delete_ads'])) {
    delete_ads($startup, $_GET['delete_ads']);
    restart();
} elseif (isset($_GET['show_id'])) {
    if (check_ads($startup, $_GET['show_id'])) {
        return_form($startup, $smarty, $_GET['show_id']);
    }
} elseif (isset($_POST['clear_photos'])) {
    delete_all($startup);
    clear_dirs(array("img_big/", "img_small/"));
    restart();
} elseif (isset($_POST['download_file'])) {
    if (isset($_FILES['fupload'])) {
        upload_image($startup, $_FILES['fupload']);
        restart();
    }
} else {
    return_form($startup, $smarty);
    show_ads($startup, $ads_table);
    show_gallery($startup);
}







