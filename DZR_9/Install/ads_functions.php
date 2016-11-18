<?php

header('Content-type: text/html; charset=utf-8');

function return_form($smarty,$new_ads = 0) {
    $query = mysql_query("SELECT * FROM `advertisement`  WHERE id = $new_ads");
    $row = mysql_fetch_assoc($query);
    $smarty->assign('new_ads', $row);
    $smarty->display('index.tpl');
}


function show_ads($ads_table) {
    $ads_table = get_all_ads();
    if (!empty($ads_table)) {
        foreach ($ads_table as $key => $value) {
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

function restart() {
    header("Location: $_SERVER[SCRIPT_NAME]");
    exit;
}
