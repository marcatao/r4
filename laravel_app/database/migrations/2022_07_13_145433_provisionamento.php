<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Provisionamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provisionamentos', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->date('data');
        $table->integer('aula_id');
        $table->integer('aluno_id');
        $table->integer('professor_id');
        $table->integer('user_id');
        $table->decimal('qt_aula');
        $table->decimal('vl_aula');
        $table->string('status');
        $table->foreign('aula_id')->references('id')->on('aulas');
        $table->foreign('user_id')->references('id')->on('users');
        $table->foreign('professor_id')->references('id')->on('users');
        $table->foreign('aluno_id')->references('id')->on('users');
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
        //
    }
}
