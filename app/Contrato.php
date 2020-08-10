<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $table = 'contratos';

    public function empresa(){
        return $this->belongsTo(Empresa::class);
    }

    
}
