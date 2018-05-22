<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{

    protected $fillable = ['profesor_id','aula_id','dia_semana','hora','turno'];

    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }

    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }

}
