<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfGrupoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_grupo', function (Blueprint $table) {

            $table->increments('id');
            $table->bigInteger('version')->default(0);
            $table->boolean('acesso_externo')->nullable();
            $table->timestamp('data_atualizacao')->nullable();
            $table->timestamp('data_cadastro')->nullable();
            $table->timestamp('data_exclusao')->nullable();
            $table->text('descricao')->nullable();
            $table->string('nome');
            $table->text('permissoes')->nullable();
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
        Schema::dropIfExists('conf_grupo');
    }
}
