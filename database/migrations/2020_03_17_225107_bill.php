<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bills',function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('Number');
            $table->integer('Total_count_B');
            $table->float('Total_price_B');
            $table->string('customer');
            $table->string('salesman');
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
        //
        Schema::dropIfExists('bills');
    }
}
