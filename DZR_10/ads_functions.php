<?php
require_once ('connect_mysql.php');
require_once ('ads_model.php');
header('Content-type: text/html; charset=utf-8');

function return_form($startup,$smarty,$new_ads = 0) {
    if ($new_ads) {
        $new_ads = get_row_ads($startup, $new_ads);
    }
    $smarty->assign('new_ads', $new_ads);
    $smarty->display('index.tpl');
}

function show_ads($startup,$ads_table) {
    $ads_table = get_all_ads($startup);
    if (!empty($ads_table)) {
        foreach ($ads_table as $key => $value) {
            echo '<h4 align="center">Объявление №' . ($value['id'] + 1) . ', введенное пользователем - ' . $value['name'] . '</h4></n>';
            echo "<div align='center'>"
            . "<a href='$_SERVER[SCRIPT_NAME]?show_id={$value['id']}'>" . ($value['id'] + 1) . ") {$value['title']}</a> "
            . "| Цена: {$value['price']} руб. "
            . "| Продавец: {$value['name']} "
            . "| Email: {$value['email']} "
            . "| Телефон: {$value['phone']} "
            . "| <a href='$_SERVER[SCRIPT_NAME]?delete_ads={$value['id']}'>Удалить</a>"
                . "</div><br>";
        }
    } else {
        echo <<<END
<div class="col-md-12 text-center">
    <h3 style="color:green; class="help-block">Объявлений не добавлено</h3>
</div>
END;
    }
}

function restart() {
    header("Location: $_SERVER[SCRIPT_NAME]");
    exit;
}