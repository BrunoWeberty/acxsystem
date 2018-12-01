<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunoCertificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluno_certificado', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aluno_id')->unsigned()->nullable();
            $table->foreign('aluno_id')->references('id')->on('alunos')->
    onDelete('cascade');
            $table->integer('certificado_id')->unsigned()->nullable();
            $table->foreign('certificado_id')->references('id')->on('certificado')->
    onDelete('cascade');
            $table->integer('status')->unsigned();
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
        Schema::dropIfExists('aluno_certificado');
    }
}
