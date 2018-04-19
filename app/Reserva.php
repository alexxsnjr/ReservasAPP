<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{

    protected $fillable = ['profesor_id','aula_id','fecha','hora'];

    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }

    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }

}
