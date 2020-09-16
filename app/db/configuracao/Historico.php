<?php

namespace App\db\configuracao;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Historico extends Model{
    use SoftDeletes;

    protected $table = 'conf_historico'; // nome da tabela

    const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = 'data_atualizacao';
    const DELETED_AT = 'data_exclusao';


    protected $fillable = [
        'detalhes','usuario_gravou_id',
    ];
}
