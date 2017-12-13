<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceDetailCheck;
use App\Http\Requests;
use App\InvoiceDetail;
use App\Invoice;
use App\Book;
use Auth;
use Validator;

class InvoiceDetailController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function getDetail($invoice_id) {
    	$detail = new InvoiceDetail;
    	$query = $detail->where('invoice_id', $invoice_id)->get();
    	return $query;
    }

    public function addDetail($invoice_id, $sku, $amount) {
    	$detail = new InvoiceDetail;
    	$book = new Book;
    	$query = InvoiceDetail::insertGetId([
    		'invoice_id' = $invoice_id,
    		'sku' = $book->where('sku', $sku)->getSku(),
    		'amount' = $amount,
    		'price' = $book->where('sku', $sku)->getPrice(),
    		'sale_price' = $book->where('sku', $sku)->getSalePrice()
    	]);
    	return $query->getId();
    }

    public function deleteDetail($id) {
    	$detail = new InvoiceDetail;
    	$query = $deltail->where('id', $id)->delete();
    }
}
