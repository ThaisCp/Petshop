<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCadastroProdutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadastro_produto', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('version')->default(0);
            $table->timestamp('data_atualizacao')->nullable();
            $table->timestamp('data_cadastro')->nullable();
            $table->timestamp('data_exclusao')->nullable();
            $table->string('nome');
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
        Schema::dropIfExists('cadastro_produto');
    }
}
