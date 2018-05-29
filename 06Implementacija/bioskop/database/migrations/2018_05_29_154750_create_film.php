<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film', function(Blueprint $table){
            $table -> increments('id');
            $table -> string('naziv', 20);
            $table -> text('zanr');
            $table -> integer('trajanje');
            $table -> text('opis');
            $table -> year('godina');
            $table -> string('reziser');
            $table -> string('glavna_uloga');
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
        Schema::dropIfExists('film');
    }
}
