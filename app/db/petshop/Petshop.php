<?php

namespace App\db\locadora;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrato extends Model{
    use SoftDeletes;

    protected $table = 'petshop_contrato'; // nome da tabela

    const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = 'data_atualizacao';
    const DELETED_AT = 'data_exclusao';


    protected $fillable = [
        'veiculo_id','usuario_gravou_id',
    ];
}
