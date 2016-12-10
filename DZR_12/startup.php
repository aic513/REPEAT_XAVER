<?php

class db {

    private static $instance = null;
    private $db;

    public static function instance() {
        if (self::$instance == null) {
            self::$instance = new db();
        }

        return self::$instance->db;
    }

    public function __construct() {
        require_once ("dbsimple/config.php");
        require_once ("dbsimple/DbSimple/Generic.php");
        require_once ("connect_mysql.php");
        $this->db = DbSimple_Generic::connect('mysqli://' . $UserName . ':' . $Password . '@' . $ServerName . '/' . $Database);
    }

}

$db = db::instance();
$db->setErrorHandler('databaseErrorHandler');
$db->query("SET NAMES utf8");