<?php
header('Content-type: text/html; charset=utf-8');

  $date = array();
    for ($index = 0; $index <= 100; $index++) {
        $date[$index] = mt_rand();
        echo date('d.m.Y', $date[$index]).'<br>';
    }

    function day($value){
        for ($i = 0; $i <= 100; $i++) {
            $value[$i] = date('d', $value[$i]);
        }
        echo '<h6 style="color:green">'.'наименьший день '.(min($value)).'</h6>';
    }

    day($date);

    function month($param){
        for ($a = 0; $a <= 100; $a++) {
            $param[$a] = date('m', $param[$a]);
        }
        echo '<h5 style="color:orange">'.'наибольший месяц '.(max($param)).'</h5>';
    }
    
    month($date);