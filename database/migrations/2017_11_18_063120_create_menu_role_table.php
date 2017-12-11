<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_role', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('menu_id')->unsigned();
            $table->foreign('menu_id')
                ->references('id')->on('menus');

            $table->integer('menu_detail_id')->unsigned()->nullable();
            $table->foreign('menu_detail_id')
                ->references('id')->on('menu_details');
            
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')
                ->references('id')->on('roles');

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
        Schema::dropIfExists('menu_role');
    }
}
