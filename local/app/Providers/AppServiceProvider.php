<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use Carbon\Carbon;
use App\Book_value;
use App\Store;
use App\Book;
use Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.left-menu', function($view)
        {
            $view->with('category', Category::all());
        });
        view()->composer('layouts.footer', function($view)
        {
            $view->with('store', Store::all());
        });
        view()->composer('welcome', function($view)
        {
            $now = Carbon::now();
            $book = new Book;
            $book_values = new Book_value;
            $new_book = $book->where('is_new', 1)->limit(8)->get();
            $hightlight_book = $book->where('is_hightlight', 1)->limit(8)->get();
            $sale_book = $book->where('special_price', '<>', null)
                ->where('from_date', '<=', $now)
                ->limit(8)
                ->get();
            $sku = [];
            foreach (Book::all() as $key) {
                $sku[] = $key->sku;
            }
            $number = $book_values
                ->select('book_values.sku', 'book_values.number')
                ->whereIn('book_values.sku', $sku)
                ->get();
            $view->with('new_book', $new_book)
                ->with('hightlight_book', $hightlight_book)
                ->with('sale_book', $sale_book)
                ->with('number', $number);
        });
        view()->composer('master', function($view)
        {
            $count = Cart::count();
            $view->with('count', $count);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
