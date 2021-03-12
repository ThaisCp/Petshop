<?php

namespace App\db\cadastro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClienteUsuario extends Model{
    use SoftDeletes;

    protected $table = 'cliente_usuario'; // nome da tabela

    const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = 'data_atualizacao';
    const DELETED_AT = 'data_exclusao';


    protected $fillable = [
        'usuario_gravou_id','nome',
    ];
}
