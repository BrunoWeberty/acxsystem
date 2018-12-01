<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificado', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomeC', 100);
            $table->integer('instituicao')->unsigned();
            $table->string('entidadePromotora', 100);
            $table->date('dataConclusao');//date
            $table->float('cargaHoraria', 8, 2);
            $table->float('horaAceita', 8, 2);
            $table->string("arquivo", 100)->nullable();
            $table->string('relatorio', 500);
            $table->integer('categoria_id')->unsigned()->nullable();
            $table->foreign('categoria_id')->references('id')->on('categoria')->
    onDelete('cascade');
            $table->integer('semestre_id')->unsigned()->nullable();
            $table->foreign('semestre_id')->references('id')->on('semestre')->
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
        Schema::dropIfExists('certificado');
    }
}
