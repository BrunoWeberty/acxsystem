<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModeloModalidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelo_modalidade', function (Blueprint $table) {
            $table->increments('id');
                        //Campo e Chave estrangeira para disciplina
            $table->integer('modelo_id')->unsigned()->nullable();
            $table->foreign('modelo_id')->references('id')->on('modelo')->
    onDelete('cascade');
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
        Schema::dropIfExists('modelo_modalidade');
    }
}
