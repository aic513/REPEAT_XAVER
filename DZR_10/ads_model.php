<?php

require_once ("startup.php");

function get_all_ads($startup) {
    return $startup -> select("SELECT * FROM `advertisement`");
}

function get_city($startup) {
    $cities_query = $startup->select('SELECT id AS ARRAY_KEY,city FROM `cities`');
    foreach ($cities_query as $key => $value) {
            $cities[$key] = $value['city'];
        }
    return $cities;
}

function get_category($startup) {
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

function insert_ads($startup,$new_ads) {
        $startup->query('INSERT INTO advertisement(?#) VALUES(?a)', array_keys($new_ads), array_values($new_ads));
}

function edit_ads($startup,$new_ads,$id){
    $startup->query("UPDATE advertisement SET ?a WHERE `id` = ?n", $new_ads, $id);
}

function get_row_ads($startup,$id){
         return $startup->selectRow("SELECT * FROM `advertisement` WHERE id =?d", $id);
}

function delete_ads($startup, $id) {
    if ($startup->selectRow("SELECT `id` FROM `advertisement` WHERE id=?d", $id)) {
        $startup->query("DELETE FROM advertisement WHERE id=?d", $id);
    }
    return true;
}

function check_ads($startup,$show_id){
    $startup->selectRow("SELECT `id` FROM `advertisement` WHERE id=?d",$show_id);
    return true;
}

function clear_base($startup) {
    return  $startup->query('DELETE FROM `advertisement` WHERE id>0');
}

