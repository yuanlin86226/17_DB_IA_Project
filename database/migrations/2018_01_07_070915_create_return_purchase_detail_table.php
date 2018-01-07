<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnPurchaseDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_purchase_details', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('return_purchase_id')->unsigned();
            $table->foreign('return_purchase_id')
                ->references('id')->on('return_purchases');
            
            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign('product_id')
                ->references('id')->on('products');

            $table->string('name');
            $table->integer('price');
            $table->integer('num');
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
        Schema::dropIfExists('return_purchase_details');
    }
}
