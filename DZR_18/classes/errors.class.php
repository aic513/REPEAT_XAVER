<?php

class errors {

    private $errors = array();

    public function __construct($errors) {
        $this->errors = $errors;
    }

    public function show_error(ads $new_ads, $smarty) {
        $vars = $new_ads->get_vars();
        $errorsNumber = 0;
        $err = array();
        foreach ($this->errors as $value) {
            if (empty($vars[$value])) {
                $err['fields'][] = $value;
                $errorsNumber++;
            }
        }
        if ($errorsNumber) {
            $err['status'] = true;
        } else {
            $err['status'] = false;
        }
        $err['all_fields'] = $this->errors;
        return $err;
    }

}
