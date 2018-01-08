<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status');
            $table->integer('payment_method')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('total');
            $table->string('remark')->nullable();

            $table->integer('back_order_id')->unsigned()->nullable();
            $table->foreign('back_order_id')
                ->references('id')->on('orders');

            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')
                ->references('id')->on('customers');

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
        Schema::dropIfExists('orders');
    }
}
