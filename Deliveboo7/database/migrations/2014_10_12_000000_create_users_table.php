<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('cognome');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table -> string('nome_attivita', 64) -> nullable(false);
            $table -> string('via', 64) -> nullable(false);
            $table -> string('n_civico', 8) -> nullable(false);
            $table -> string('citta', 64) -> nullable(false);
            $table -> string('cap', 16) -> nullable(false);
            $table -> string('p_iva', 16) -> nullable(false);
            $table -> string('file_path') -> nullable(false);
            $table->rememberToken();

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
        Schema::dropIfExists('users');
    }
}
