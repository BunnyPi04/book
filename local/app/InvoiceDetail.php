<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    public function getId() {
    	return $this->id;
    }

    public function getSku() {
    	return $this->sku;
    }

    public function getInvoiceId() {
    	return $this->invoice_id;
    }

    public function getAmount() {
    	return $this->amount;
    }

    public function getPrice() {
    	return $this->price;
    }

    public function getSalePrice() {
    	return $this->salePrice;
    }

    public function getFinalPrice() {
    	if ($this->getSalePrice != null) {
    		return $this->price;
    	} else {
    		return $this->salePrice;
    	}
    }
    public function Invoice() {
    	return $this->belongsTo(Invoice::class);
    }
}