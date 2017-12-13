<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public $timestamps = false;

    public function getId() {
    	return $this->store_id;
    }

    public function getName() {
    	return $this->store_name;
    }

    public function getAddress() {
    	return $this->address;
    }

    public function getPhoneNumber() {
    	return $this->phone_number;
    }
}
