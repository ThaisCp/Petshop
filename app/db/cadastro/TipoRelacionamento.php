<?php

namespace App\db\cadastro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoRelacionamento extends Model{
    use SoftDeletes;

    protected $table = 'cadastro_tipo_relacionamento'; // nome da tabela

    const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = 'data_atualizacao';
    const DELETED_AT = 'data_exclusao';


    protected $fillable = [
        'nome','usuario_gravou_id',
    ];
}
