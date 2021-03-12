<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateCadastroClienteEnderecoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadastro_cliente_endereco', function (Blueprint $table) {

            $table->increments('id');
            $table->bigInteger('version')->default(0);
            $table->timestamp('data_atualizacao')->nullable();
            $table->timestamp('data_cadastro')->nullable();
            $table->timestamp('data_exclusao')->nullable();
            $table->string('endereco_bairro');
            $table->string('endereco_cep');
            $table->string('endereco_complemento');
            $table->string('endereco_endereco');
            $table->string('endereco_estado');
            $table->string('endereco_numero');
            $table->string('endereco_cidade');
            $table->integer('pessoa_id')->nullable();
            $table->integer('tipo_relacionamento_id')->nullable();
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
        Schema::dropIfExists('cadastro_cliente_endereco');
    }
}
