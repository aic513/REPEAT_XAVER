<?php
header('Content-type: text/html; charset=utf-8');
error_reporting(E_ERROR|E_PARSE);
require_once ("functions.php");
session_start();

if (isset($_POST['confirm'])) {
    if (is_numeric($_GET['show_id']) && isset($_GET['show_id'])) {
        $_SESSION['ads'][$_GET['show_id']] = $_POST;
    } else {
        $_SESSION['ads'][] = $_POST;
    }
    restart();
} elseif ($_POST['clear_session']) {
    delete_base_ads();
    restart();
} elseif (isset($_POST['clear_form']) || isset($_POST['back'])) {
    restart();
} elseif (isset($_GET['delete_ads'])) {
    delete_ads($_GET['delete_ads']);
    $_SESSION['ads'] = array_values($_SESSION['ads']);
    restart();
} elseif (isset($_GET['show_id'])) {
    $show_id = (int) ($_GET['show_id']);
    $_SESSION['ads'][$show_id]['id'] = $show_id;
    return_form($_SESSION['ads'][$show_id]);
} else {
    return_form();
    show_ads();
}

