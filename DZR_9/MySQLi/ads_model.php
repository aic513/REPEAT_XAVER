<?php

require_once ("startup.php");

function get_all_ads($startup) {
    $query = "SELECT * FROM `advertisement` ORDER BY `id` DESC";
    $result = mysqli_query($startup,$query);
    if (!$result) {
        die(mysqli_error($startup));
    }
    $ads_exit = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $ads_exit[$row['id']] = $row;
    }
    return $ads_exit;
}

function get_city($startup) {
    $cities_query = mysqli_query($startup,'SELECT * FROM `cities`');
    while ($row = mysqli_fetch_assoc($cities_query)) {
        $cities[$row['id']] = $row['city'];
    }
    return $cities;
}

function get_category($startup) {
    $categories_query = mysqli_query($startup,'SELECT * FROM `categories`');
    while ($row = mysqli_fetch_assoc($categories_query)) {
        if (!$row['parent_id']) {
            $general_category[$row['id']] = $row['category'];
        } else {
            $sub_category[$row['parent_id']][$row['id']] = $row['category'];
        }
    }
    foreach ($general_category as $key => $value) {
        $categories[$value] = $sub_category[$key];
    }
    return $categories;
}

function insert_ads($startup,$new_ads) {
    if (!isset($new_ads['allow_mails'])) {
        $new_ads['allow_mails'] = 0;
    }
    $insert = mysqli_query($startup,"INSERT INTO
        `advertisement`
        (`description`,`email`,`allow_mails`,
        `name`,`phone`,`price`,`private`,
        `title`,`location`,`category`)
        VALUES
        ('{$new_ads['description']}',"
        . " '{$new_ads['email']}', "
        . "'{$new_ads['allow_mails']}',"
        . "'{$new_ads['name']}',"
        . " '{$new_ads['phone']}',"
        . "'{$new_ads['price']}',"
        . "'{$new_ads['private']}',"
        . "'{$new_ads['title']}',"
        . " '{$new_ads['location']}',"
        . " '{$new_ads['category']}')"
        );
        if (!$insert){
            echo 'Запрос на добавление в БД не выполнился';
        }
}

function edit_ads($startup,$edit){
    if (!isset($edit['allow_mails'])) {
        $edit['allow_mails'] = 0;
    }

    $edit_ads = mysqli_query($startup,"UPDATE `advertisement` SET"
            . "`description`='{$edit['description']}',"
            . "`phone`='{$edit['phone']}',"
            . "`email`='{$edit['email']}',"
            . "`name`='{$edit['name']}',"
            . "`allow_mails`='{$edit['allow_mails']}',"
            . "`private`='{$edit['private']}',"
            . "`price`='{$edit['price']}',"
            . "`title`='{$edit['title']}',"
            . "`location`='{$edit['location']}',"
            . "`category`='{$edit['category']}'"
            );
    if(!$edit_ads){
        echo 'Запрос на редактирование в БД не выполнился';
    }
}

function delete_ads($startup,$id) {
    if (!mysqli_fetch_array(mysqli_query($startup,"SELECT `id` FROM `advertisement` WHERE id='$id'"))) {
        echo 'Не выбрано объявление для удаления';
    }
    $t = "DELETE FROM `advertisement` WHERE id='%d'";
    $query = sprintf($t, mysqli_real_escape_string($startup,$id));
    $result = mysqli_query($startup,$query);
    if (!$result) {
        die(mysqli_error($startup));
    }
    return true;
}

function clear_base($startup) {
    $query = mysqli_query($startup,"TRUNCATE TABLE `advertisement`");
    if (!$query) {
        echo 'Запрос очистки базы не выполнился';
    } else {
        return true;
    }
}

function check_ads($startup,$show_id){
    mysqli_fetch_array(mysqli_query($startup,"SELECT `id` FROM `advertisement` WHERE id='$show_id'"));
    return true;
}