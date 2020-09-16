<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceiroLancamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('financeiro_lancamento', function (Blueprint $table){

            $table->increments('id');
            $table->bigInteger('version')->default(0);
            $table->timestamp('data_atualizacao')->nullable();
            $table->timestamp('data_cadastro')->nullable();
            $table->timestamp('data_exclusao')->nullable();
            $table->date('data_pagamento')->nullable();
            $table->date('data_vencimento');
            $table->integer('forma_cobranca_id')->nullable();
            $table->integer('forma_pagamento_id')->nullable();
            $table->string('nosso_numero');
            $table->integer('nota_id')->nullable();
            $table->integer('parceiro_id')->nullable();
            $table->integer('parcela')->nullable();
            $table->integer('parcela_total')->nullable();
            $table->text('protocolo_pagamento')->nullable();
            $table->string('tipo')->nullable();
            $table->integer('usuario_excluiu_id')->nullable();
            $table->integer('usuario_gravou_id')->nullable();
            $table->double('valor')->nullable();
            $table->double('valor_pago')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financeiro_lancamento');
    }
}
