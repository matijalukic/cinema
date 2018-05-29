<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepetoar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repertoar', function(Blueprint $table){
            $table -> increments('id');
            $table -> unsignedInteger('zaposleni_id');
            $table->timestamps();

            // foreign keys
            $table -> foreign('zaposleni_id') -> references('id') -> on('zaposleni') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repertoar');

    }
}
