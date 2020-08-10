<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atestado extends Model
{
    protected $table = 'atestados';

    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }
}
