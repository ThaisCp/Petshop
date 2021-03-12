<?php

namespace App\db\cadastro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model{
    use SoftDeletes;

    protected $table = 'cadastro_cliente'; // nome da tabela

    const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = 'data_atualizacao';
    const DELETED_AT = 'data_exclusao';


    protected $fillable = [
        'cnh','usuario_gravou_id','nome',
    ];
}
