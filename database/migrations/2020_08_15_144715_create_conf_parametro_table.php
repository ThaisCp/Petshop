<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfParametroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_parametro', function (Blueprint $table) {

            $table->increments('id');
            $table->bigInteger('version')->default(0);
            $table->string('empresa')->nullable();
            $table->string('imagem_fundo')->nullable();
            $table->string('imagem_icone')->nullable();
            $table->string('imagem_logo')->nullable();
            $table->integer('relacionamento_cliente_id')->nullable();
            $table->integer('status_nota_baixada_id')->nullable();
            $table->integer('status_nota_inicial_id')->nullable();
            $table->integer('status_nota_pagamento_agendado_id')->nullable();
            $table->integer('forma_cobranca_padrao_id')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conf_parametro');
    }
}
