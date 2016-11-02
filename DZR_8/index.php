<?php

header('Content-type: text/html; charset=utf-8');
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);
require_once('data.php');
require_once('functions.php');
require_once('functions_download.php');

$smarty_dir = 'smarty/';
require_once($smarty_dir . 'libs/Smarty.class.php');
$smarty = new Smarty();
$smarty->compile_check = true;
$smarty->debugging = false;
$smarty->template_dir = $smarty_dir . 'templates';
$smarty->compile_dir = $smarty_dir . 'templates_c';
$smarty->cache_dir = $smarty_dir . 'smarty/cache';
$smarty->config_dir = $smarty_dir . 'smarty/configs';

$smarty->assign('cities',$cities);
$smarty->assign('categories',$categories);

if (file_exists('file.txt')) {
    $ads_files = unserialize(file_get_contents('file.txt'));
}

if (!is_array($ads_files)) {
    $ads_files = array();
}

if (isset($_POST['confirm'])) {
    if (is_numeric($_GET['show_id']) && isset($_GET['show_id'])) {
        $ads_files[$_GET['show_id']] = $_POST;
    } else {
        $ads_files[] = $_POST;
    }
    save_ads_in_files($ads_files);
    restart();
} elseif (isset($_POST['clear_form'])) {
    restart();
}if (isset($_POST['clear_base'])) {
    delete_base_ads();
    restart();
} elseif (isset($_GET['delete_ads'])) {
    delete_ads((int) ($_GET['delete_ads']));
    $ads_files = array_values($ads_files);
    save_ads_in_files($ads_files);
    restart();
} elseif (isset($_GET['show_id'])) {
    $show_id = (int) ($_GET['show_id']);
    $ads_files[$show_id]['id'] = $show_id;
    return_form($smarty,$ads_files,$ads_files[$show_id]);
} elseif (isset($_POST['clear_photos'])) {
    clear_dirs(array("img_big/", "img_small/"));
    restart();
} elseif (isset($_POST['download_file'])) {
    if (isset($_FILES['fupload'])) {
        upload_image($_FILES['fupload']);
        restart();
    }
} else {
    return_form($smarty,$ads_files);
    show_ads($ads_files);
    show_gallery();
}














