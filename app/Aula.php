<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{

    protected $fillable = ['nombre','edificio_id','planta_id','nombre','tipo','aforo'];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class);
    }

    public function planta()
    {
        return $this->belongsTo(Planta::class);
    }

    public function reserva()
    {
        return $this->hasMany(Reserva::class);
    }

}
