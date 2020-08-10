<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';


    protected $fillable = [
        'cnpj',
        'razao_social',
        'nome_fantasia',
        'email',
        'logomarca'
    ];

    public function unidades(){
        return $this->hasMany(Unidade::class);
    }
}
