<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMvArmarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mv_armarios', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('armario_id');
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('dt_inicio');
            $table->dateTime('dt_fim')->nullable();
            $table->string('situacao')->default('F'); //A - Armario Livre | F - Ocupado | I - Indisponivel | R - Reservado
            $table->text('obs')->nullable();

            $table->foreign('armario_id')->references('id')->on('armarios');
            $table->foreign('paciente_id')->references('id')->on('pacientes');
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
        Schema::dropIfExists('mv_armarios');
    }
}
