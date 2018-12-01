<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('matricula', 100);
            $table->date('inicioSemestre');//date
            $table->integer('instituicao_id')->unsigned()->nullable();
            $table->foreign('instituicao_id')->references('id')->on('instituicao')->
    onDelete('cascade');
            $table->integer('turma_id')->unsigned()->nullable();
            $table->foreign('turma_id')->references('id')->on('turma')->
    onDelete('cascade');
            $table->integer('statusHorasComplementares')->unsigned();
            $table->rememberToken();
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
        Schema::dropIfExists('alunos');
    }
}
