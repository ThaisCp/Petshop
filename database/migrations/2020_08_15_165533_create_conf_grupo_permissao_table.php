<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfGrupoPermissaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_grupo_permissao', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('data_cadastro')->nullable();
            $table->timestamp('data_exclusao')->nullable();
            $table->integer('grupo_id')->nullable();
            $table->integer('permissao_id')->nullable();

            $table->foreign('grupo_id')
                ->references('id')->on('conf_grupo');

            $table->foreign('permissao_id')
                ->references('id')->on('conf_permissoes');

            $table->index('grupo_id');
            $table->index('permissao_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conf_grupo_permissao');
    }
}
