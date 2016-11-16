<?php

header('Content-type: text/html; charset=utf-8');

function startup() {
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'ads_db';

    $db_connect = mysql_connect($hostname, $username, $password) or die('No connect with data base');

//   if($db_connect){
//       echo 'connect is ok<br>';
//   }
    $db_select = mysql_select_db($dbName) or die('No data base');
//    if ($db_select){
//        echo "$dbName is choosed<br>";
//    }
    mysql_query("SET NAMES UTF8");
}

startup();
