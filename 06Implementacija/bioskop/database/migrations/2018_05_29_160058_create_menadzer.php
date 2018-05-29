<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenadzer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menadzer', function(Blueprint $table){
            $table -> unsignedInteger('id');
            $table->timestamps();

            // foreign keys
            $table -> foreign('id') -> references('id') -> on('zaposleni') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menadzer');
    }
}
