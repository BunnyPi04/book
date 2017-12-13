<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\ShoppingcartServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Book;
use Cart;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $content = Cart::content();

        return view('welcome', compact('content'));
    }

    public function addItem($id) 
    {
        $book = Book::find($id);
        // Cart::destroy();
        $now = Carbon::now();
        if (isset($book['special_price']) && ($book['to_date'] >= $now)) {
            $subtotal = $book['special_price'];
        } else {
            $subtotal = $book['price'];
        }
        $query = Cart::add([
            'id' => $book['book_id'], 
            'name' => $book['book_name'], 
            'qty' => 1, 
            'price' => $subtotal,
            'options' => [
                'special_price' => $book['special_price'],
                'from_date' => $book['from_date'],
                'to_date' => $book['to_date'],
                'img' => $book['image'],
            ]
        ]);
        $content = Cart::count();

        return response()
                ->json(['content' => $content]);
    }

    public function resetCart() {
        Cart::destroy();

        return redirect('/home');
    }
}