<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_receipt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('receipt_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->float('price_PR')->default(0.0);
            $table->integer('count_PR')->default(0);
            $table->float('Total_price_PR')->default(0.0);
            $table->timestamps();
            $table->foreign('receipt_id')->references('id')->on('receipts');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_receipt');
    }
}
