<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function InvoiceDetails() {
    	return $this->hasMany(InvoiceDetails::class);
    }
}