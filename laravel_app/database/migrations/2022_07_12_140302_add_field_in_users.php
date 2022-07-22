<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldInUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('whatsapp')->nullable();
            $table->date('dt_nascimento')->nullable();
            $table->string('nome_pai')->nullable();
            $table->string('nome_mae')->nullable();
            $table->string('responsavel')->nullable();
            $table->string('contato_responsavel')->nullable();
            $table->string('serie')->nullable();
            $table->string('cep')->nullable();
            $table->string('cidade')->nullable();
            $table->string('endereço completo')->nullable();
            $table->string('cpf_financeiro')->nullable();
            $table->string('instagram')->nullable();
            $table->string('foto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
