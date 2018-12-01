<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupervisoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisores', function (Blueprint $table) {//professor supervisor
            $table->increments('id');
            $table->string('name', 100);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('matricula', 100);
            $table->integer('instituicao_id')->unsigned()->nullable();
            $table->foreign('instituicao_id')->references('id')->on('instituicao')->
    onDelete('cascade');
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
        Schema::dropIfExists('supervisores');
    }
}
