<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{

    protected $fillable = ['nombre'];

    public function plantas()
    {
        return $this->hasMany(Planta::class);
    }

    public function aulas()
    {
        return $this->hasMany(Aula::class);
    }

}
