<?php

namespace App\db\configuracao;

use Illuminate\Database\Eloquent\Model;


class GrupoPermissao extends Model{


    protected $table = 'conf_grupo_permissao'; // nome da tabela

    const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = null;




}
