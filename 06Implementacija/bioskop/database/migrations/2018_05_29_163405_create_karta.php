<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKarta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karta', function (Blueprint $table) {
            $table->increments('id');
            $table -> integer('cena');
            $table -> unsignedInteger('projekcija_id');
            $table -> unsignedInteger('zaposleni_id');
            $table -> unsignedInteger('korisnik_id');
            $table->timestamps();

            // foreign keys
            $table->foreign('projekcija_id')->references('id')->on('projekcija')->onDelete('cascade');
            $table->foreign('zaposleni_id')->references('id')->on('salterski_sluzbenik');
            $table->foreign('korisnik_id')->references('id')->on('korisnik');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karta');

    }
}
