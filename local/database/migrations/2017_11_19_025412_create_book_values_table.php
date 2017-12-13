<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_values', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku', 10);
            // $table->foreign('sku')->references('sku')->on('books');
            $table->integer('number')->default(0);
            $table->integer('store_id')->unsigned();
            // $table->foreign('store_id')->references('store_id')->on('stores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_values');
    }
}
