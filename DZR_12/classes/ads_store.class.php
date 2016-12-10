<?php

class ads_store {

    private static $instance = null;
    private $ads = array();

    public function instance() {
        if (self::$instance == null) {
            self::$instance = new ads_store();
        }
        return self::$instance;
    }

    public function get_ads_from_db($id) {
        return $this->ads[$id];
    }

    public function add_ads(ads $new_ads) {
        if (!($this instanceof ads_store)) {
            die("Нельзя использовать этот метод в конструкторе классов");
        }
        $this->ads[$new_ads->get_id()] = $new_ads;
    }

    public function get_all_ads_from_db() {
        $db = db::instance();
        $all_ads = $db->select('SELECT * FROM `advertisement`');
        foreach ($all_ads as $one_ads) {
            if ($one_ads['private'] == 1) {
                $some_ads = new ads_company($one_ads);
            } else {
                $some_ads = new ads_private($one_ads);
            }
            static::add_ads($some_ads);
        }
    }

    public function save_post($post) {
        $post['private'] ? $new_ads = new ads_company($post) : $new_ads = new ads_private($post);
        $new_ads->save();
        static::add_ads($new_ads);
        return self::$instance;
    }

    public function del_ads($id) {
        $this->ads[$id]->delete();
        unset($this->ads[$id]);
    }

    public function prepare_for_out() {
        global $smarty;
        $row = '';
        foreach ($this->ads as $value) {
            $smarty->assign('ads', $value);
            $row.=$smarty->fetch('table_row.tpl');
        }
        $smarty->assign('ads_rows', $row);
        return self::$instance;
    }

    public function display() {
        global $smarty;
        $smarty->display('index.tpl');
    }

    public function get_location() {
        $db = db::instance();
        $cities_query = $db->select('SELECT id AS ARRAY_KEY,city FROM `cities`');
        foreach ($cities_query as $key => $value) {
            $cities[$key] = $value['city'];
        }
        return $cities;
    }

    public function get_category() {
        $db = db::instance();
        $categories_query = $db->select('SELECT id AS ARRAY_KEY,category,parent_id AS PARENT_KEY FROM `categories`');
        foreach ($categories_query as $key => $value) {
            if (!$key) {
                $categories[$key] = $value['category'];
            }
            foreach ($value['childNodes'] as $number => $title) {
                $categories[$value['category']][$number] = $title['category'];
            }
        }
        return $categories;
    }

    public function clear_base() {
        $db = db::instance();
        $db->query('DELETE FROM `advertisement` WHERE id>0');
        $this->ads = array();
        return self::$instance;
    }

    public function restart() {
        header("Location: $_SERVER[SCRIPT_NAME]");
        exit;
    }

}
