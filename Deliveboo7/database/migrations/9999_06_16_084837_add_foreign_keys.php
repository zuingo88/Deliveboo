<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //One to Many    Restaurant to Dishes
      Schema::table('dishes', function (Blueprint $table) {
        $table -> foreign('user_id', 'dishuser')
        -> references('id')
        -> on('users');
      });


      //Many to Many  Restaurants to Types
      Schema::table('type_user', function (Blueprint $table) {

        $table -> foreign('user_id', 'usertype')
        -> references('id')
        -> on('users');

        $table -> foreign('type_id', 'typeuser')
        -> references('id')
        -> on('types');
      });


      //Many to Many   Dishes to Orders
      Schema::table('dish_order', function (Blueprint $table) {

        $table -> foreign('dish_id', 'dishorder')
        -> references('id')
        -> on('dishes');

        $table -> foreign('order_id', 'orderdish')
        -> references('id')
        -> on('orders');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      //One to Many    Restaurant to Dishes
      Schema::table('dishes', function (Blueprint $table) {
        $table -> dropForeign('dishuser');
      });


      //Many to Many   Restaurants to Types
      Schema::table('type_user', function (Blueprint $table) {
        $table -> dropForeign('usertype');
        $table -> dropForeign('typeuser');
      });


      //Many to Many  Dishes to Order
      Schema::table('dish_order', function (Blueprint $table) {
        $table -> dropForeign('dishorder');
        $table -> dropForeign('orderdish');
      });

    }
}
