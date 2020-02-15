<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTypeRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('Cid')->unsigned();
            $table->bigInteger('Tid')->unsigned();
            $table->timestamps();
            $table->foreign('Cid')->references('id')->on('company');
            $table->foreign('Tid')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_type_relations');
    }
}
