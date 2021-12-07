<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();

            $table->string('nome',50);
            $table->string('sobrenome',100)->nullable();
            $table->string('unidade',10);
            $table->string('enfermaria',10);
            $table->string('leito',10);
            $table->bigInteger('acompanhante')->nullable();
            $table->dateTime('dt_nascimento');
            $table->dateTime('dt_alta')->nullable();
            $table->longText('observacao')->nullable();
            $table->string('cep',8)->nullable();
            $table->string('endereco', 100)->nullable();
            $table->string('numero',10)->nullable();
            $table->string('compl', 50)->nullable();
            $table->string('cidade', 100)->nullable();
            $table->string('bairro',50)->nullable();
            $table->string('uf', 100)->nullable();
            $table->string('email',200)->nullable();
            $table->string('contato', 20)->nullable();
            $table->string('fone', 10)->nullable();            
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
        Schema::dropIfExists('pacientes');
    }
}
