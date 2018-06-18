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

    public function horario()
    {
        return $this->hasMany(Horario::class);
    }

    public function excepcionHorario()
    {
        return $this->hasMany(ExcepcionHorario::class);
    }

    public function equipamiento()
    {
        return $this->hasMany(Equipamiento::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($aula) {

            $aula->equipamiento->each->delete();
            $aula->reserva->each->delete();
            $aula->horario->each->delete();
            $aula->excepcionHorario->each->delete();

        });
    }

}
