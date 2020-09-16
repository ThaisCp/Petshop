<?php

namespace App\db\financeiro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LancamentoFinanceiroCaixa extends Model{
  use SoftDeletes;

  protected $table = 'lancamento_financeiro_caixa'; // nome da tabela

  const CREATED_AT = 'data_cadastro';
  const UPDATED_AT = 'data_atualizacao';
  const DELETED_AT = 'data_exclusao';


  protected $fillable = [
      'usuario_gravou_id'
  ];
}
