<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100);
            $table->string('descricao', 300);
            $table->float('limiteChs', 8, 2);//limite carga horaria por semestre
            $table->integer('limiteCertificados');//limite de certificados por semestre
            $table->string('observacoes', 400);
            $table->integer('modalidade_id')->unsigned()->nullable();
            $table->foreign('modalidade_id')->references('id')->on('modalidades')->
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
        Schema::dropIfExists('categoria');
    }
}
