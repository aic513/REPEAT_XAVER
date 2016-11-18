<?php

header('Content-type: text/html; charset=utf-8');
require_once ('connect_mysql.php');

function startup($hostname, $username, $password, $dbName) {
    $db_connect = mysql_connect($hostname, $username, $password) or die('No connect with data base' . mysql_error());

    $db_select = mysql_select_db($dbName) or die('No data base' . mysql_error());

    mysql_query("SET NAMES UTF8");
}

startup($ServerName, $UserName, $Password, $Database);


