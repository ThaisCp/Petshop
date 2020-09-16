<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceiroNotaStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financeiro_nota_status', function (Blueprint $table) {

            $table->increments('id');
            $table->bigInteger('version')->default(0);
            $table->timestamp('data_atualizacao')->nullable();
            $table->timestamp('data_cadastro')->nullable();
            $table->timestamp('data_exclusao')->nullable();
            $table->string('nome')->nullable();
            $table->integer('ordem')->nullable();
            $table->boolean('permite_alteracao')->nullable();
            $table->integer('usuario_excluiu_id')->nullable();
            $table->integer('usuario_gravou_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financeiro_nota_status');
    }
}
