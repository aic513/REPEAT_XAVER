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

function show_city_block($city_selected = '') {
    $cities = array(
        '641780' => 'Новосибирск',
        '641490' => 'Барабинск',
        '641510' => 'Бердск',
        '641600' => 'Искитим',
        '641630' => 'Колывань',
        '641680' => 'Колывань',
        '641710' => 'Куйбышев',
        '641760' => 'Мошково',
        '641790' => 'Обь'
    );

    foreach ($cities as $value => $city) {
        $selected = ($value == $city_selected) ? 'selected=""' : '';
        echo '<option data-coords=",," ' . $selected . ' value="' . $value . '">' . $city . '</option>';
    }
}

function show_category_block($category_selected = '') {
    $categories = '
[Транспорт]
9 = Автомобили с пробегом;
109 = Новые автомобили;
14 = Мотоциклы и мототехника;
81 = Грузовики и спецтехника;
11 = Водный транспорт;
10 = Запчасти и аксессуары;
[Недвижимость]
24 = Квартиры;
23 = Комнаты;
25 = Дома, дачи, коттеджи;
26 = Земельные участки;
85 = Гаражи и машиноместа;
42 = Коммерческая недвижимость;
86 = Недвижимость за рубежом;
[Работа]
111 = Вакансии;
112 = Резюме;
[Услуги]
114 = Предложения услуг;
115 = Запросы на услуги;
[Личные вещи]
27 = Одежда, обувь, аксессуары;
29 = Детская одежда и обувь;
30 = Товары для детей и игрушки;
28 = Часы и украшения;
88 = Красота и здоровье;
[Для дома и дачи]
21 = Бытовая техника;
20 = Мебель и интерьер;
87 = Посуда и товары для кухни;
82 = Продукты питания;
19 = Ремонт и строительство;
106 = Растения;
[Бытовая электроника]
32 = Аудио и видео;
97 = Игры, приставки и программы;
31 = Настольные компьютеры;
98 = Ноутбуки;
99 = Оргтехника и расходники;
96 = Планшеты и электронные книги;
84 = Телефоны;
101 = Товары для компьютера;
105 = Фототехника;
[Хобби и отдых]
33 = Билеты и путешествия;
34 = Велосипеды;
83 = Книги и журналы;
36 = Коллекционирование;
38 = Музыкальные инструменты;
102 = Охота и рыбалка;
39 = Спорт и отдых;
103 = Знакомства;
[Животные]
89 = Собаки;
90 = Кошки;
91 = Птицы;
92 = Аквариум;
93 = Другие животные;
94 = Товары для животных;
[Для бизнеса]
116 = Готовый бизнес;
40 = Оборудование для бизнеса;';

    $categories = parse_ini_string($categories, true);

    foreach ($categories as $sphere => $subcategories) {
        echo '<optgroup label="' . $sphere . '">';
        foreach ($subcategories as $value => $category) {
            $selected = ($value == $category_selected) ? 'selected=""' : '';
            echo '<option data-coords=",," ' . $selected . ' value="' . $value . '">' . $category . '</option>';
        }
    }
}

function restart() {
    header("Location: $_SERVER[SCRIPT_NAME]");
    exit;
}

function show_ads() {
    if (!empty($_SESSION['ads'])) {
        foreach ($_SESSION['ads'] as $key => $value) {
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

function delete_ads($ads) {
    unset($_SESSION['ads'][$ads]);
}

function delete_base_ads() {
    unset($_SESSION['ads']);
}
