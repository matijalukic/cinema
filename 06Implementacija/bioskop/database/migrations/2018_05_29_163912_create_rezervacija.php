<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRezervacija extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rezervacija', function (Blueprint $table) {
            $table->increments('id');
            $table -> integer('broj_karata');
            $table -> unsignedInteger('projekcija_id');
            $table -> unsignedInteger('karta_id') -> nullable();
            $table -> unsignedInteger('korisnik_id');
            $table->timestamps();

            // foreign keys
            $table->foreign('projekcija_id')->references('id')->on('projekcija')->onDelete('cascade');
            $table->foreign('korisnik_id')->references('id')->on('korisnik')->onDelete('cascade');
            $table -> foreign('karta_id') -> references('id') -> on('karta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rezervacija');

    }
}
