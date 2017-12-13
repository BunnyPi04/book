<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceCheck;
use App\Http\Requests;
use App\InvoiceDetail;
use App\Invoice;
use App\Store;
use App\Book;
use App\User;
use Auth;
use Validator;

class InvoiceController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function getStore() {
    	$store = new Store;
    	$query = [
    			'store_id' => $this->store_id,
    			'store_name' => $store->where('store_id', $this->store_id)
    									->getName()
    			];
    	return $query;
    }

    public function getCashier() {
    	$cashier = new User;
    	$query = [
    			'fullname' => $cashier->where('position', 'Cashier')
    					->where('name', $this->cashier_username)
    					->getFullname(),
    			'id' => $cashier->where('position', 'Cashier')
    					->where('name', $this->cashier_username)
    					->getId()
    			];
    	return $query;
    }

    public function list() {
        if((Auth::user()->position) == 'Admin') {
            $invoice = new Invoice;
        	$query = $invoice->orderby('create_at DESC')->paginate(20);

        	return view('backend.invoice.invoice-list', compact('query'));
        } else
        {
            $alert = ['error' => 'You dont have permission'];

            return redirect()->back()->with($alert);
        }
    }

    public function create() {
        if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Cashier') {
            $invoice = new Invoice;
            $invoiceDetail = new InvoiceDetail;
            $book = Book::all();
            return view('backend.invoice.invoice-create', compact('book'));
        } else
        {
            $alert = ['error' => 'You dont have permission'];

            return redirect()->back()->with($alert);
        }
    }

    public function save() {
        
    }
}
