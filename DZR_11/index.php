<?php

header('Content-type: text/html; charset=utf-8');
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);
require_once ('startup.php');
require_once('smarty_connect.php');


spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
});

$base = new db();
$show = new show_ads();
$pic = new photo();
$smarty->assign('cities', $base->get_city($startup));
$smarty->assign('categories', $base->get_category($startup));





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
        $base->edit_ads($startup, $post, $_GET['show_id']);
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
        $base->insert_ads($startup, $post);
    }
    $show->restart();
} elseif (isset($_POST['clear_form'])) {
    $show->restart();
} elseif (isset($_POST['clear_base'])) {
    $base->clear_base($startup);
    $show->restart();
} elseif (isset($_GET['delete_ads'])) {
    $base->delete_ads($startup, $_GET['delete_ads']);
    $show->restart();
} elseif (isset($_GET['show_id'])) {
    if ($base->get_row_ads($startup, $_GET['show_id'])) {
        $show->return_form($startup, $smarty, $base, $_GET['show_id']);
    }
} elseif (isset($_POST['clear_photos'])) {
    $base->delete_all_img($startup);
    $pic->clear_dirs(array("img_big/", "img_small/"));
    $show->restart();
} elseif (isset($_POST['download_file'])) {
    if (isset($_FILES['fupload'])) {
        $pic->upload_image($startup, $_FILES['fupload'], $base);
        $show->restart();
    }
} else {
    $show->return_form($startup, $smarty, $base);
    $pic->show_gallery($startup, $base);
}







