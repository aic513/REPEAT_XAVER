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

$new_ads = new ads(0);
$smarty->assign('new_ads', $new_ads);
$ads_store->prepare_for_out()->display();
$pic->show_gallery();
















