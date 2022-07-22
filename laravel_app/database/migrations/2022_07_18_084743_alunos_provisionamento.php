<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlunosProvisionamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos_provisionamento', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('provisionamento_id');
            $table->integer('aluno_id');
            $table->foreign('provisionamento_id')->references('id')->on('provisionamentos');
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
