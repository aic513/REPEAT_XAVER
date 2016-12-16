<?php

$smarty_dir = 'smarty/';
require_once($smarty_dir . 'libs/Smarty.class.php');
$smarty = new Smarty();
$smarty->compile_check = true;
$smarty->debugging = false;
$smarty->template_dir = $smarty_dir . 'templates';
$smarty->compile_dir = $smarty_dir . 'templates_c';
$smarty->cache_dir = $smarty_dir . 'smarty/cache';
$smarty->config_dir = $smarty_dir . 'smarty/configs';

