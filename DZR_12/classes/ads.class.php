<?php

class ads {

    private $id;
    private $private;
    private $name;
    private $allow_mails;
    private $email;
    private $phone;
    private $location;
    private $category;
    private $title;
    private $description;
    private $price;

    public function __construct($new_ads) {
        if (isset($new_ads['id'])) {
            $this->id = $new_ads['id'];
        }

        $this->private = $new_ads['private'];
        $this->name = $new_ads['name'];
        if (isset($new_ads['allow_mails'])) {
            $this->allow_mails = $new_ads['allow_mails'];
        } else {
            $this->allow_mails = 0;
        }
        $this->phone = $new_ads['phone'];
        $this->location = $new_ads['location'];
        $this->category = $new_ads['category'];
        $this->title = $new_ads['title'];
        $this->description = $new_ads['description'];
        $this->price = $new_ads['price'];
        $this->email = $new_ads['email'];
    }

    public function get_id() {return $this->id;}
    public function get_private() {return $this->private;}
    public function get_name() {return $this->name;}
    public function get_allow_mails() {return $this->allow_mails;}
    public function get_email(){return $this->email;}
    public function get_phone() {return $this->phone;}
    public function get_location() {return $this->location;}
    public function get_category() {return $this->category;}
    public function get_title() {return $this->title;}
    public function get_description() {return $this->description;}
    public function get_price(){return $this->price;}
    public function get_vars(){return get_object_vars($this);}


public function save() {
        $db = db::instance();
        $vars = get_object_vars($this);
        $db->query('REPLACE INTO `advertisement` (?#) VALUES (?a)', array_keys($vars), array_values($vars));
    }

    public function delete() {
        $db = db::instance();
        $db->query('DELETE from `advertisement` WHERE id = ?', $this->id);
    }

}
