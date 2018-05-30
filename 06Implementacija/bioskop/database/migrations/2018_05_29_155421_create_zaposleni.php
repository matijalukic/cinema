<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZaposleni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zaposleni', function(Blueprint $table){
            $table -> increments('id');
            $table -> unsignedInteger('bioskop_id') -> nullable();
            $table -> string('username', 30) -> unique();
            $table -> string('password');
            $table -> string('ime');
            $table -> string('prezime');
            $table -> string('jmbg', 13);

            $table->rememberToken();
            $table->timestamps();

            // foreign keys
            $table -> foreign('bioskop_id') -> references('id') -> on('bioskop') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zaposleni');
    }
}
