<?php

header('Content-type: text/html; charset=utf-8');
require_once ("dbsimple/config.php");
require_once ("dbsimple/DbSimple/Generic.php");
require_once ('connect_mysql.php');
$startup = DbSimple_Generic::connect('mysqli://' . $UserName . ':' . $Password . '@' . $ServerName . '/' . $Database);

$startup->setErrorHandler('databaseErrorHandler');    

$startup->query("SET NAMES utf8");

