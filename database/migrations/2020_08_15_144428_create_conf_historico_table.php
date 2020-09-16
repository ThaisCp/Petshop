<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfHistoricoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_historico', function (Blueprint $table) {

            $table->increments('id');
            $table->bigInteger('version')->default(0);
            $table->string('acao')->nullable();
            $table->text('classejson')->nullable();
            $table->timestamp('data_atualizacao')->nullable();
            $table->timestamp('data_cadastro')->nullable();
            $table->timestamp('data_exclusao')->nullable();
            $table->text('detalhes')->nullable();
            $table->integer('entidade_id')->nullable();
            $table->string('tipo_entidade')->nullable();
            $table->integer('usuario_id')->nullable();


//            $table->foreign('usuario_id')
//                ->references('id')->on('conf_usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conf_historico');
    }
}
