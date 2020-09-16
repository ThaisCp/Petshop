<?php

namespace App\db\cadastro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PessoaEndereco extends Model{
    use SoftDeletes;

    protected $table = 'cadastro_cliente_endereco'; // nome da tabela

    const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = 'data_atualizacao';
    const DELETED_AT = 'data_exclusao';


    protected $fillable = [
        'pessoa_id','usuario_gravou_id',
    ];
}
