<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('book_id');
            $table->string('sku')->unique();
            $table->string('book_name', 50)->nullable(false);
            $table->boolean('is_new')->default(0);
            $table->boolean('is_hightlight')->default(0);
            $table->integer('publisher_id');
            // $table->foreign('publisher_id')->references('publisher_id')->on('publishers');
            $table->string('author', 50)->nullable(false);
            // $table->foreign('category_id')->references('category_id')->on('categories');
            $table->string('image')->nullable();
            $table->float('price')->nullable(false);
            $table->float('special_price')->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->text('description');
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
        Schema::dropIfExists('books');
    }
}
