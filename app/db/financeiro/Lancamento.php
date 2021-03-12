<?php

namespace App\db\financeiro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lancamento extends Model{
  use SoftDeletes;

  protected $table = 'financeiro_lancamento'; // nome da tabela

  const CREATED_AT = 'data_cadastro';
  const UPDATED_AT = 'data_atualizacao';
  const DELETED_AT = 'data_exclusao';


  protected $fillable = [
      'usuario_gravou_id'
  ];
}
