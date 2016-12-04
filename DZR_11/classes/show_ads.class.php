<?php

class show_ads {

    public function return_form($startup, $smarty, $base, $new_ads = '') {
        if ($new_ads) {
            $new_ads = new promo($base->get_row_ads($startup, $new_ads));
            $smarty->assign('new_ads', $new_ads);
        } else {
            $new_ads = new promo();
            $smarty->assign('new_ads', $new_ads);
        }
            $ads_table = $base->get_all_ads($startup);
            $smarty->assign('add',$ads_table);
            $smarty->display('index.tpl');
    }

    public function restart() {
        header("Location: $_SERVER[SCRIPT_NAME]");
        exit;
    }

}

