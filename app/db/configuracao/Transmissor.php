<?php

namespace App\db\configuracao;

use Illuminate\Database\Eloquent\Model;

class Transmissor extends Model{


    protected $table = 'conf_transmissor'; // nome da tabela
    public $timestamps = false;

    //const CREATED_AT = 'data_cadastro';
//  const UPDATED_AT = 'data_atualizacao';
//  const DELETED_AT = 'data_exclusao';


    // protected $fillable = [
    //     'detalhes','usuario_gravou_id',
    // ];
}
