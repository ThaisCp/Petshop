<?php

namespace App\db\configuracao;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Authenticatable{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'conf_usuario'; // nome da tabela

    const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = 'data_atualizacao';
    const DELETED_AT = 'data_exclusao';


    protected $fillable = [
        'nome','email', 'password','usuario_gravou_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
