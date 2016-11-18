<?php

if (isset($_POST['INSTALL'])) {
    if (!$commo = mysql_connect($_POST['ServerName'], $_POST['UserName'], $_POST['Password'])) {
        die('Невозможно установить соединение!');
    }
    if (mysql_select_db($_POST['Database'])) {
        mysql_query('drop database ' . $_POST['Database']);
    }
    mysql_query('CREATE DATABASE ' . $_POST['Database']);
    mysql_select_db($_POST['Database']) or die('не была выбрана база данных');


//Thank you,Stackoverflow))))
    $dump = '';
    $rows = file("db/ads_db.sql");
    foreach ($rows as $row) {
        if (substr($row, 0, 2) == '--' || $row == '') {
            continue;
        }
        $dump .= $row;
        if (substr(trim($row), -1, 1) == ';') {
            mysql_query($dump) or die('Ошибка запроса' . $dump . mysql_error() . '<br>');                                                   //Исполняем файл
            $dump = '';
        }
    }
    mysql_close($commo);

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


