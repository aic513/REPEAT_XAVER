<?php
header('Content-type: text/html; charset=utf-8');
require_once 'model.php';

$summa = array();
$notice = array();
$discount_price = array();
function parse_func($product, $param){
    static $discount_price;
    global $summa;
    global $notice;
    $price_plus = $param['цена'] * $param['количество заказано'];

    switch ($param['diskont']) {
        case 'diskont0':
            $param['diskont'] = '0%';
            $discount_price+=$price_plus * 1;
            $notice[] = 'На товар:'.$product. ' скидка не предоставляется';
            break;

        case 'diskont1':
            $param['diskont'] = '10%';
            $discount_price+=$price_plus * 0.9;
            $notice[] = 'На товар:'.$product. ' предоставляется скидка '.$param['diskont'];
            break;

        case 'diskont2':
            $param['diskont'] = '20%';
            $discount_price+=$price_plus * 0.8;
            $notice[] = 'На товар:'.$product. ' предоставляется скидка '.$param['diskont'];
            break;

        default:
            break;
    }

    if($param['осталось на складе'] >= $param['количество заказано']){
        $price_plus = $param['цена'] * $param['количество заказано'];
    }
    else{
        $price_plus = $param['цена'] * $param['осталось на складе'];
        $notice[] = 'Товар: ' .$product. ' нехватка на складе = ' .($param['количество заказано'] - $param['осталось на складе']). 'шт';
    }

    if($product=='игрушка детская велосипед' && $param['количество заказано'] >=3 && $param['осталось на складе'] >=3 ){
            $param['diskont'] = '30%';
            $discount_price+=$price_plus * 0.7;
            $notice[] = 'На товар:'.$product. ' предоставляется скидка '.$param['diskont'];
    }



    echo '<tr><td>' .$product. '</td>';
    echo '<td>' .$param['цена']. '</td>';
    echo '<td>' .$param['количество заказано']. '</td>';
    echo '<td>' .$param['осталось на складе']. '</td>';
    echo '<td>' . $price_plus . '</td>';
    echo '<td>' . $param['diskont'] . '</td>';
    echo '<td>' . $discount_price . '</td></tr>';

    $summa['цена']+= $param['цена'];
    $summa['количество заказано']+=$param['количество заказано'];
    $summa['осталось на складе']+=$param['осталось на складе'];
    $summa['цена с наличием']+=$price_plus;
    $summa['цена со скидкой']+=$discount_price;
}
?>

<table>
    <tr>
        <td>Наименование</td>
        <td>Цена</td>
        <td>Количество заказано</td>
        <td>Осталось на складе</td>
        <td>Цена с наличием</td>
        <td>Скидка</td>
        <td>Цена со скидкой</td>
    </tr>
<?php
foreach ($bd as $key => $value) {
    parse_func($key,$value);
}
?>
    <tr>
        <td>Итого:<?=count($bd)?></td>
        <td><?=$summa['цена']?></td>
        <td><?=$summa['количество заказано']?></td>
        <td><?=$summa['осталось на складе']?></td>
        <td><?=$summa['цена с наличием']?></td>
        <td></td>
        <td><?=$summa['цена со скидкой']?></td>
    </tr>
</table>

<h2><?=  join($notice,'<br>')?></h2>


