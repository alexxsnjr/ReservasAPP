<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExcepcionHorario extends Model
{

    protected $fillable = ['aula_id','dia_semana','hora','turno'];

    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }

}
