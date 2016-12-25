<?php

header('Content-type: text/html; charset=utf-8');
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);
require_once ('startup.php');
require_once('smarty_connect.php');


spl_autoload_register(function ($class) {
    $class_path = 'classes/' . $class . '.class.php';
    if (file_exists($class_path)) {
        require_once $class_path;
    }
});

$ads_store = ads_store::instance();
$ads_store->get_all_ads_from_db();
$pic = new photo();
$errors = new errors(array('name','phone','title','description','price'));
$smarty->assign('cities', $ads_store->get_location());
$smarty->assign('categories', $ads_store->get_category());


if (isset($_POST['name'])) {
    if (isset($_POST['private'])) {
        $new_ads = new ads_company($_POST);
    } else {
        $new_ads = new ads_private($_POST);
    }
}


if (isset($_GET['show_id'])) {
    $ads_store = ads_store::instance();
    $new_ads = $ads_store->get_ads_from_db($_GET['show_id']);
    $smarty->assign('new_ads', $new_ads);
} else {
    $new_ads = new ads(0);
    $smarty->assign('new_ads', $new_ads);
}


if (isset($_POST['confirm'])) {
    $new_ads = new ads($_POST);
    if ($errors->show_error($new_ads, $smarty)) {
        $smarty->assign('new_ads', $new_ads);
    } else {
        $ads_store->save_post($_POST)->restart();
    }
}

if (isset($_GET['delete_ads'])) {
    $ads_store->del_ads((int) $_GET['delete_ads'])->restart();
}

if (isset($_POST['clear_form'])) {
    $ads_store->restart();
}

if (isset($_POST['clear_base'])) {
    $ads_store->clear_base()->restart();
}

if (isset($_POST['download_file'])) {
    if (isset($_FILES['fupload'])) {
        $pic->upload_image($_FILES['fupload']);
        //$ads_store->restart();
    }
} elseif (isset($_POST['clear_photos'])) {
    $pic->delete_all_img();
    $pic->clear_dirs(array("img_big/", "img_small/"));
    $ads_store->restart();
}

$ads_store->prepare_for_out()->display();
$pic->show_gallery();
















