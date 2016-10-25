<?php
header('Content-type: text/html; charset=utf-8');
require_once(dirname( __FILE__ ) . '/data.php');
require_once(dirname(__FILE__) . '/functions.php');
session_start();
$ads_cookie = array();

if (isset($_COOKIE['cookie_repository']) && $_COOKIE['cookie_repository']!='NULL'){
    $ads_cookie = unserialize($_COOKIE['cookie_repository']);
}

if (isset($_POST['confirm'])) {
    if (is_numeric($_GET['show_id']) && isset($_GET['show_id'])) {
        $ads_cookie[$_GET['show_id']] = $_POST;
    } else {
        $ads_cookie[] = $_POST;
    }
    save_ads_in_cookie($ads_cookie);
    restart();
}

elseif (isset($_POST['clear_form']) || isset($_POST['back'])) {
    restart();
}

elseif ($_POST['clear_base']) {
    delete_base_ads($ads_cookie);
    restart();
}

elseif (isset($_GET['delete_ads'])) {
    delete_ads($_GET['delete_ads']);
    $ads_cookie = array_values($ads_cookie);
    save_ads_in_cookie($ads_cookie);
    restart();
}

elseif (isset($_GET['show_id'])) {
    $show_id = (int)($_GET['show_id']);
    $ads_cookie[$show_id]['id'] = $show_id;
    return_form($ads_cookie[$show_id]);
}

else {
    return_form();
    show_ads($ads_cookie);
}

