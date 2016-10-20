<?php
header('Content-type: text/html; charset=utf-8');
function return_form($new_ads = 0) {
    if (isset($new_ads['id'])) {
        $save_ads = 'Сохранить';
    } else {
        $save_ads = 'Добавить';
        $back = 'hidden=""';
    }
    require_once ("form.php");
}
function restart() {
    header("Location: $_SERVER[SCRIPT_NAME]");
    exit;
}
function show_ads($ads) {
    if (!empty($ads)) {
        foreach ($ads as $key => $value) {
            echo '<h4 align="left">Объявление №' . ($key + 1) . ', введенное пользователем - ' . $value['name'] . '</h4></n>';
            echo "<div align='left'>"
            . "<a href='$_SERVER[SCRIPT_NAME]?show_id=$key'>" . ($key + 1) . ") {$value['title']}</a> "
            . "| Цена: {$value['price']} руб. "
            . "| Продавец: {$value['name']} "
            . "| Email: {$value['email']} "
            . "| Телефон: {$value['phone']} "
            . "| <a href='$_SERVER[SCRIPT_NAME]?delete_ads=$key'>Удалить</a></div><br>";
        }
    } else {
        echo '<h3 style="color:green;">Объявлений не добавлено</h5>';
    }
}
function save_ads_in_cookie($ads){
    setcookie('cookie_repository', serialize($ads), time()+3600*24*7);
}
function delete_ads($id) {
    global $ads_cookie;
    unset($ads_cookie[$id]);
}
function delete_base_ads($ads) {
    setcookie('cookie_repository', serialize($ads), time()-3600*24*7);
    unset($_SESSION);
}
