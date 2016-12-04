<?php
require_once ('connect_mysql.php');
require_once ('ads_model.php');
header('Content-type: text/html; charset=utf-8');

function return_form($startup,$smarty,$new_ads = 0) {
    if ($new_ads) {
        $new_ads = get_row_ads($startup, $new_ads);
    }
    $ads_table = get_all_ads($startup);
    $smarty->assign('add', $ads_table);
    $smarty->assign('new_ads', $new_ads);
    $smarty->display('index.tpl');
}

function restart() {
    header("Location: $_SERVER[SCRIPT_NAME]");
    exit;
}