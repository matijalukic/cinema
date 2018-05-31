<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('korisnik', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 20) -> unique();
            $table->string('email') -> unique();
            $table->string('password');
            $table -> string('ime');
            $table -> string('prezime');
            $table -> string('jmbg', 13);
            $table -> string('adresa', 30);
            $table -> string('broj', 10);

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
        Schema::dropIfExists('korisnik');
    }
}
