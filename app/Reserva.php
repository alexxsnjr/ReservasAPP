<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{

    protected $fillable = ['profesor_id','aula_id','fecha','hora'];

    public function profesors()
    {
        return $this->belongsTo(Profesor::class);
    }

    public function aulas()
    {
        return $this->belongsTo(Aula::class);
    }

}
