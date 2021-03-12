<?php

namespace App\db\configuracao;

use Illuminate\Database\Eloquent\Model;

class Permissoes extends Model{


    protected $table = 'conf_permissoes'; // nome da tabela

    const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = null;



    protected $fillable = [
        //  'detalhes','usuario_gravou_id',
    ];
}
