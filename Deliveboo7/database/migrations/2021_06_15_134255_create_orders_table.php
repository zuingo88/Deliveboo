<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('orders', function (Blueprint $table) {
        $table->id();

        $table -> string('nome_cliente', 32) -> nullable(false);
        $table -> string('cognome_cliente', 32) -> nullable(false);
        $table -> string('email_cliente', 32) -> nullable(false);
        $table -> string('via', 64) -> nullable(false);
        $table -> string('n_civico', 8) -> nullable(false);
        $table -> string('citta', 64) -> nullable(false);
        $table -> string('cap', 16) -> nullable(false);
        $table -> string('telefono', 32) -> nullable(false);
        $table -> string('note', 255) -> nullable();
        $table -> string('status', 16) ->default('in sospeso');
        $table -> float('totalPrice') -> nullable(false);

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
