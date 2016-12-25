<?php

class ads_private extends ads{
    public function __construct($new_ads) {
        parent::__construct($new_ads);
        $this->private = 0;
    }
}
