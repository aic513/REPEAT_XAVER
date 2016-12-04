<?php

class db {

    public function get_all_ads($startup) {
        $ads = $startup->select("SELECT * FROM `advertisement`");
         $ads_array = array();
        foreach ($ads as $value){
            $ads_array[] = new promo($value);
        }
        return $ads_array;
    }

    public function get_city($startup) {
        $cities_query = $startup->select('SELECT id AS ARRAY_KEY,city FROM `cities`');
        foreach ($cities_query as $key => $value) {
            $cities[$key] = $value['city'];
        }
        return $cities;
    }

    public function get_category($startup) {
        $categories_query = $startup->select('SELECT id AS ARRAY_KEY,category,parent_id AS PARENT_KEY FROM `categories`');
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

    public function insert_ads($startup, $new_ads) {
        $startup->query('INSERT INTO advertisement(?#) VALUES(?a)', array_keys($new_ads), array_values($new_ads));
    }

    public function edit_ads($startup, $new_ads, $id) {
        $startup->query("UPDATE advertisement SET ?a WHERE `id` = ?n", $new_ads, $id);
    }

    public function get_row_ads($startup, $id) {
        return $startup->selectRow("SELECT * FROM `advertisement` WHERE id =?d", $id);
    }

    public function delete_ads($startup, $id) {
        if ($startup->selectRow("SELECT `id` FROM `advertisement` WHERE id=?d", $id)) {
            $startup->query("DELETE FROM advertisement WHERE id=?d", $id);
        }
        return true;
    }

    public function clear_base($startup) {
        return $startup->query('DELETE FROM `advertisement` WHERE id>0');
    }

    public function get_img($startup) {
        return $startup->select("SELECT * FROM `photo`");
    }

    public function send_img($startup, $type) {
        $startup->query("INSERT INTO `photo` (mime_type) VALUES('$type')");
    }

    public function get_last_img($startup) {
        return $startup->query("SELECT * FROM `photo` ORDER BY id_image DESC LIMIT 1");
    }

    public function delete_all_img($startup) {
        return $startup->query("DELETE FROM `photo` WHERE id_image>0");
    }

}
