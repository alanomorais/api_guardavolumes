<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableArmarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('armarios', function (Blueprint $table) {
            $table->id();

            $table->string('unidade')->nullable();
            $table->string('codigo')->nullable()->unique();
            $table->string('situacao',1)->nullable()->default('A'); 
            // //A - Armario Livre | F - Ocupado | I - Indisponivel | R - Reservado
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
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
        Schema::dropIfExists('armarios');
    }
}
