<?php

$date = array();
$date[] = mt_rand(1, time());
$date[] = mt_rand(1, time());
$date[] = mt_rand(1, time());
$date[] = mt_rand(1, time());
$date[] = mt_rand(1, time());

$min = min(
        date('d', $date[0]),
        date('d', $date[1]),
        date('d', $date[2]),
        date('d', $date[3]),
        date('d', $date[4])
);

echo 'Min_day is ' . $min . "<br>";

$max = max(
        date('m', $date[0]),
        date('m', $date[1]),
        date('m', $date[2]),
        date('m', $date[3]),
        date('m', $date[4])
);

echo 'Max_month is ' . $max . "<br>";

sort($date); 
echo "<pre>";
var_dump($date);
echo "</pre> <br>";

$selected = array_pop($date);  
echo 'Last massive element is ' . date("d.m.y. H:i:s", $selected) . "<br>";  

echo 'My timezone now is ' . date_default_timezone_get() . "<br>";  
date_default_timezone_set('America/New_York');  
echo 'My timezone after change is ' . date_default_timezone_get() . "<br>"; 











