<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfPermissoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_permissoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('acao')->nullable();
            $table->string('controller')->nullable();
            $table->timestamp('data_cadastro')->nullable();
            $table->text('descricao')->nullable();
            $table->string('pai')->nullable();
            $table->string('parametros')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conf_permissoes');
    }
}
