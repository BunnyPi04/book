<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\New_book;

class Book extends Model
{
    //
    public $fillable = [
    	'book_id',
        'sku',
        'publisher_id',
        'author',
        'category_id',
        'images',
        'price',
        'special_price',
        'from_date',
        'to_date',
        'description'
    ];
    
    public function book_value() {
        return $this->hasMany('Book_value::class');
    }
    protected $table = 'books';
    protected $primaryKey = 'book_id';
    
}
