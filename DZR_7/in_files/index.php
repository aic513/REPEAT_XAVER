<?php

header('Content-type: text/html; charset=utf-8');
error_reporting(E_ERROR | E_PARSE);
require_once('data.php');
require_once('functions.php');

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
} elseif (isset($_POST['clear_form']) || isset($_POST['back'])) {
    restart();
} elseif ($_POST['clear_base']) {
    delete_base_ads('');
    restart();
} elseif (isset($_GET['delete_ads'])) {
    delete_ads((int) ($_GET['delete_ads']));
    $ads_files = array_values($ads_files);
    save_ads_in_files($ads_files);
    restart();
} elseif (isset($_GET['show_id'])) {
    $show_id = (int) ($_GET['show_id']);
    $ads_files[$show_id]['id'] = $show_id;
    return_form($ads_files[$show_id]);
} else {
    return_form();
    show_ads($ads_files);
}

if (isset($_POST['download_file'])) {
    if ($_FILES) {
        $blacklist = array(".php", ".phtml", ".php3", ".php4", ".html", ".htm", "txt");
        foreach ($blacklist as $item) {
            if (preg_match("/$item\$/i", $_FILES['filename']['name']))
                exit;
        }
        $name = "images/" . $_FILES['filename']['name'];
        move_uploaded_file($_FILES['filename']['tmp_name'], $name);
        echo '<a target="_blank" href =' . "$name" . '>Загружаемое изображение - ' . $name . '</a><br>';
    }
}











