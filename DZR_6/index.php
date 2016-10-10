<?php
header('Content-type: text/html; charset=utf-8');
require_once ("functions.php");

session_start();

if (isset($_POST['confirm'])) {
    if (is_numeric($_POST['id_ads'])) {
        $_SESSION['ads'][$_POST['id_ads']] = $_POST;
    } else {
        $_SESSION['ads'][] = $_POST;
    restart();
    }
}

elseif (isset($_GET['delete_ads'])) {
    delete_ads($_GET['delete_ads']);
    $_SESSION['ads'] = array_values($_SESSION['ads']);
    restart();
}

elseif (isset($_GET['show_id'])) {
    $show_id = (int) ($_GET['show_id']);
    $_SESSION['ads'][$show_id]['id'] = $show_id;
    return_form($_SESSION['ads'][$show_id]);
}

elseif (isset($_POST['clear_form'])||isset($_POST['back'])){
    restart();
}

elseif ($_POST['clear_session']) {
    delete_session();
    restart();
}

else {
    return_form();
    show_ads();
}

//echo '<pre>';
//print_r($_SESSION);
//echo '</pre>';
