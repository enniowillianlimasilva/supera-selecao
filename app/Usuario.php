<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $fillable = ['cpf','nome','unidade_id'];

    public function unidade(){
        return $this->belongsTo(Unidade::class);
    }

    public function atestados(){
        return $this->hasMany(Atestado::class);
    }

}
