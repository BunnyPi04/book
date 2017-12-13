<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('coupon_id')->nullable()->unique();
            $table->string('total', 255)->change();
            $table->string('grand_total', 255);
        });
        Schema::table('books', function (Blueprint $table) {
            $table->string('price', 255)->change();
            $table->string('special_price', 255)->change();
        });
        Schema::table('coupons', function (Blueprint $table) {
            $table->string('amount', 255)->change();
        });
        Schema::table('invoice_details', function (Blueprint $table) {
            $table->string('price', 255)->change();
            $table->string('sale_price', 255)->change();
            $table->string('finalPrice', 255)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}