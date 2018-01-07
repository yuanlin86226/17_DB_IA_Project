<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_purchases', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('status'); // 0->退貨, 1->換貨

            $table->integer('total'); // 可為零，折扣金自行計算
            $table->string('remark')->nullable(); // 若以折扣價退貨，自行標註

            $table->integer('supplier_id')->unsigned();
            $table->foreign('supplier_id')
                ->references('id')->on('suppliers');

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
        Schema::dropIfExists('return_purchases');
    }
}
