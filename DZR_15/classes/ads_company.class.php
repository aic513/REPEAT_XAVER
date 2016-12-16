<?php

class ads_company extends ads{
    public function __construct($new_ads) {
        parent::__construct($new_ads);
        $this->private = 1;
    }
}
