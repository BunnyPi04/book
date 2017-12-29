<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\ShoppingcartServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use Carbon\Carbon;
use App\Order_detail;
use App\Coupon;
use App\Order;
use App\Book;
use App\User;
use Cart;
use Auth;
use Mail;

class CartController extends Controller
{
    public function add()
    {
        $cart = Cart::content();

        return view('cart', compact('cart'));
    }

    public function addItem($id) 
    {
        $book = Book::find($id);
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
                'image' => $book['image'],
            ]
        ]);
        $rows = Cart::search(function($key, $value) use($id) {
            return $key->id == $id;
        });
        $item = $rows->first();
        $qty = $item->qty;
        $total = $item->total;
        $content = Cart::count();

        return response()
            ->json(['content' => $content,
                    'qty' => $qty,
                    'total' => $total
                ]);
    }

    public function removeItem($id) 
    {
        $rows = Cart::search(function($key, $value) use($id) {
            return $key->id == $id;
        });
        $item = $rows->first();
        Cart::update($item->rowId, $item->qty - 1);
        $qty = $item->qty;
        $total = $item->total;
        $content = Cart::count();

        return response()
            ->json(['content' => $content,
                    'qty' => $qty,
                    'total' => $total
                ]);
    }

    public function removeBook($id)
    {
        $rowId = Cart::search(function($key, $value) use ($id){
            return $key->id === $id;
        });
        Cart::remove($rowId[0]);
    }

    public function showCart() {
        $cart = Cart::content();
        $total = Cart::total();

        return view('cart', compact('cart', 'total'));
    }

    public function resetCart() {
        Cart::destroy();

        return redirect('/home');
    }

    public function checkInfo(Request $request) {
        $cart = Cart::content();
        $coupon = Coupon::where('code', $request->coupon_code)->first();
        $info['total'] = Cart::total();
        $info['total'] = floatval($info['total']) * 1000;
        if ($coupon == null) {
            if ($request->coupon_code != '' ) {
                $error = 'Mã coupon không đúng';
            }
            $info['grandTotal'] = $info['total'];
        } else {
            $query['coupon_code'] = $request->coupon_code;
            if ($coupon->type == 'Percent') {
                $amount = floatval($coupon->amount) * 1000;
                $info['grandTotal'] = $info['total'] - ($info['total'] / 100) * $coupon->amount;
                $info['sale_coupon_amount'] = $info['total'] - $info['grandTotal'];
            } else {
                $info['grandTotal'] = $info['total'] - $coupon->amount;
                $info['sale_coupon_amount'] = $coupon->amount;
            }
        }
        $query['cart'] = Cart::content();
        $query['name'] = $request->name;
        $query['email'] = $request->email;
        $query['city'] = $request->city;
        $query['add'] = $request->add;
        $query['phone'] = $request->phone;

        return view('checkout', compact('cart', 'query', 'info', 'error'));
    }

    public function checkout(CheckoutRequest $request) {
        $query['cart'] = Cart::content();
        $cart = Cart::content();
        $coupon = Coupon::where('code', $request->coupon_code)->first();
        $info['total'] = Cart::total();
        $info['total'] = floatval($info['total']) * 1000;
        if ($coupon == null) {
            $error = 'Mã coupon không đúng';
            $alert = ['error' => 'Mã coupon không đúng!'];
            $info['grandTotal'] = $info['total'];
        } else {
            $query['coupon_code'] = $request->coupon_code;
            if ($coupon->type == 'Percent') {
                $amount = floatval($coupon->amount) * 1000;
                $info['grandTotal'] = $info['total'] - ($info['total'] / 100) * $coupon->amount;
                $info['sale_coupon_amount'] = $info['total'] - $info['grandTotal'];
            } else {
                $info['grandTotal'] = $info['total'] - $coupon->amount;
                $info['sale_coupon_amount'] = $coupon->amount;
            }
        }
        $data['info'] = $request->all();
        $query['cart'] = Cart::content();
        $query['name'] = $request->name;
        $query['email'] = $request->email;
        $query['city'] = $request->city;
        $query['add'] = $request->add;
        $query['phone'] = $request->phone;
        $email = $request->email;

        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->email = $request->email;
        $order->address = $request->add;
        $order->city = $request->city;
        $order->phone = $request->phone;
        if (isset($info['sale_coupon_amount'])) {
            $order->sale_coupon_amount = $info['sale_coupon_amount'];
        }
        $order->total = $info['grandTotal'];
        if (isset($request->note)) {
            $order->note = $request->note;
        }
        $order->save();
        $order_id = $order->id;
        foreach ($cart as $item) {
            $detail = new Order_detail;
            $detail->order_id = $order_id;
            $detail->book_id = $item->id;
            $detail->qty = $item->qty;
            $detail->subtotal = $item->total;
            $detail->save();
        }
        Coupon::where('code', $request->coupon_code)->delete();

        Cart::destroy();
        $alert = ['success' => 'Đơn hàng đã được gửi!'];

        // $order_detail = new Order_detail;
        // Mail::send('email', $data, function($message) use ($email) {
        //     $message->from('hangpt.mail@gmail.com', 'Minh Minh Bookstore');
        //     $message->to($email, $email);
        //     $message->cc('hangpt248@gmail.com', 'Phạm Thu Hằng');
        //     $message->subject('Xác nhận hóa đơn mua hàng Tiệm sách Minh Minh');
        //     // $message->priority(3);
        //     // $message->attach('pathToFile');
        // });
        return redirect('/home/')->with($alert);
    }

}