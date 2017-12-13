<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book_value extends Model
{
    public $fillable = [
    	'id',
        'sku',
        'number',
        'store_id',
    ];

    public function getSku() {
    	return $this->sku;
    }
    public function getStoreId() {
    	return $this->store_id;
    }

    public function getNumber() {
    	return $this->number;
    }

    public function Book() {
    	return $this->belongsTo('Book::class');
    }
}
