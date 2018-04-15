<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planta extends Model
{

    protected $fillable = ['edificio_id','piso'];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class);
    }

    public function aula()
    {
        return $this->hasMany(Aula::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($planta) {

            $planta->aula->each->delete();

        });
    }

}
