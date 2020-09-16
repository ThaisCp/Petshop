<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceiroNotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financeiro_nota', function (Blueprint $table) {

        $table->increments('id');
        $table->bigInteger('version')->default(0);
        $table->date('data_apuracao_fim');
        $table->date('data_apuracao_inicio');
        $table->timestamp('data_atualizacao')->nullable();
        $table->timestamp('data_cadastro')->nullable();
        $table->date('data_emissao')->nullable();
        $table->timestamp('data_exclusao')->nullable();
        $table->text('descricao');
        $table->boolean('fiscal')->nullable();
        $table->string('modalidade');
        $table->string('momovimentacao');
        $table->string('numero');
        $table->integer('parceiro_id')->nullable();
        $table->string('pessoa_relacionamento')->nullable();
        $table->boolean('previsao')->nullable();
        $table->string('serie')->nullable();
        $table->string('serie_sub')->nullable();
        $table->integer('status_id')->nullable();
        $table->integer('usuario_excluiu_id')->nullable();
        $table->integer('usuario_gravou_id')->nullable();
        $table->double('valor')->nullable();
        $table->double('valor_imposto')->nullable();
        $table->double('valor_liquido')->nullable();

//        $table->foreign('status_id')
//            ->references('id')->on('financeiro_nota_status');

//        $table->foreign('parceiro_id')
//            ->references('id')->on('cadastro_pessoa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financeiro_nota');
    }
}
