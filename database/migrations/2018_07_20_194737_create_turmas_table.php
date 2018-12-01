<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turma', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nameT', 100);
            $table->string('curso', 100);
            $table->string('codigo', 100);
            $table->float('totalHora', 8, 2);//Toral de horas do curso
            $table->integer('supervisor_id')->unsigned()->nullable();
            $table->foreign('supervisor_id')->references('id')->on('supervisores')->
    onDelete('cascade');
            $table->integer('instituicao_id')->unsigned()->nullable();
            $table->foreign('instituicao_id')->references('id')->on('instituicao')->
    onDelete('cascade');
            $table->integer('modelo_id')->unsigned()->nullable();
            $table->foreign('modelo_id')->references('id')->on('modelo')->
    onDelete('cascade');
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
        Schema::dropIfExists('turma');
    }
}
