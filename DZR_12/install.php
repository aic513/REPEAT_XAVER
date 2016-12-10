<?php
header('Content-type: text/html; charset=utf-8');
if (isset($_POST['INSTALL'])) {
    if (!$commo = mysqli_connect($_POST['ServerName'], $_POST['UserName'], $_POST['Password'])) {
        die('Невозможно установить соединение!');
    }
    if (mysqli_select_db($commo,$_POST['Database'])) {
        mysqli_query($commo,'drop database ' . $_POST['Database']);
    }
    mysqli_query($commo,'CREATE DATABASE ' . $_POST['Database']);
    mysqli_select_db($commo,$_POST['Database']) or die('не была выбрана база данных');


    $dump = '';
    $rows = file("db/ads_db.sql");
    foreach ($rows as $row) {
        if (substr($row, 0, 2) == '--' || $row == '') {
            continue;
        }
        $dump .= $row;
        if (substr(trim($row), -1, 1) == ';') {
            mysqli_query($commo,$dump) or die('Ошибка запроса' . $dump . mysqli_error($commo) . '<br>');                                                   //Исполняем файл
            $dump = '';
        }
    }
    mysqli_close($commo);

    $f = fopen('connect_mysql.php', 'w');
    fwrite($f, "<?php\n");
    foreach ($_POST as $key => $value) {
        if ($key == 'INSTALL') {
            continue;
        }
        fwrite($f, '$' . $key . " = '" . $value . "';\n");
    }
    fclose($f);
    header('Location: index.php');
}

require_once ('smarty_connect.php');
$smarty->display('install.tpl');


