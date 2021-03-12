<?php

namespace App;

use illuminate\Database\Eloquent\Model;

class Post extends Model{

    protected  $table ="posts";
    protected  $primaryKey = "id";

    public  $timestamps = true;
    //public const CREATED_AT = "creation_date";
    //public const UPDATE_AT = "last_update";

    protected  $fillable = ['nome', 'email', 'telefoneFixo', 'telefoneCelular',
                            'cep','endereco', 'numero', 'complemento', 'cidade',
                            'estado', 'nomepet', 'racapet', 'pesopet', 'idadepet', 'outros'];
    protected $guarded= [];
}
