<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Book;

class New_book extends Model
{
    //
    public function book() {
    	return $this->hasOne(Book::class, 'sku');
    }
}
