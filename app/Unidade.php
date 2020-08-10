<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $table = 'unidades';


    protected $fillable = [
        'cnpj',
        'razao_social',
        'nome_fantasia',
        'email',
        'logomarca'
    ];

    public function empresa(){
        return $this->belongsTo(Empresa::class);
    }

    public function cidade(){
        return $this->belongsTo(Cidade::class);
    }

    public function usuarios(){
        return $this->hasMany(Usuario::class);
    }
}
