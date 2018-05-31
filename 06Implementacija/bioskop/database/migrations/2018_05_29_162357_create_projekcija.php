<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjekcija extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projekcija', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('film_id');
            $table->unsignedInteger('zaposleni_id');
            $table -> unsignedInteger('bioskop_id');
            $table->integer('broj_sale');
            $table ->integer('cena');
            $table->dateTime('vreme');
            $table->integer('broj_mesta');
            $table->timestamps();

            // foreign keys
            $table->foreign('film_id')->references('id')->on('film')->onDelete('cascade');
            $table->foreign('zaposleni_id')->references('id')->on('zaposleni');
            $table->foreign('bioskop_id')->references('id')->on('bioskop');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projekcija');

    }
}
