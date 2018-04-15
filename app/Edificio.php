<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{

    protected $fillable = ['nombre'];

    public function planta()
    {
        return $this->hasMany(Planta::class);
    }

    public function aula()
    {
        return $this->hasMany(Aula::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($edificio) {

            $edificio->planta->each->delete();
            $edificio->aula->each->delete();

        });
    }

}
