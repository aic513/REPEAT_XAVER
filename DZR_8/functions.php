<?php

header('Content-type: text/html; charset=utf-8');

function return_form($smarty,$ads_files,$new_ads = 0) {
    $smarty->assign('new_ads',$new_ads);
    $smarty->assign('ads_files',$ads_files);
    $smarty->display('form.tpl');
}

function delete_ads($id) {
    global $ads_files;
    unset($ads_files[$id]);
}

function show_ads($ads_files) {
    if (!empty($ads_files)) {
        foreach ($ads_files as $key => $value) {
            echo '<h4 align="center">Объявление №' . ($key + 1) . ', введенное пользователем - ' . $value['name'] . '</h4></n>';
            echo "<div align='center'>"
            . "<a href='$_SERVER[SCRIPT_NAME]?show_id=$key'>" . ($key + 1) . ") {$value['title']}</a> "
            . "| Цена: {$value['price']} руб. "
            . "| Продавец: {$value['name']} "
            . "| Email: {$value['email']} "
            . "| Телефон: {$value['phone']} "
            . "| <a href='$_SERVER[SCRIPT_NAME]?delete_ads=$key'>Удалить</a></div><br>";
        }
    } else {
        echo <<<END
<div class="col-md-12 text-center">
<h3 style="color:green; class="help-block">Объявлений не добавлено</h3>
END;
    }
}

function save_ads_in_files($ads_files) {
    file_put_contents('file.txt', serialize($ads_files));
}

function delete_base_ads() {
    $file = fopen('file.txt', 'w');
    fclose($file);
}

function restart() {
    header("Location: $_SERVER[SCRIPT_NAME]");
    exit;
}
