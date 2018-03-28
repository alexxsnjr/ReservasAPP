<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{

    protected $fillable = ['nombre','edificio_id','planta_id','nombre','tipo','aforo'];

    public function edificios()
    {
        return $this->belongsTo(Edificio::class);
    }

    public function plantas()
    {
        return $this->belongsTo(Planta::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

}
