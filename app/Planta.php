<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planta extends Model
{

    protected $fillable = ['edificio_id','piso'];

    public function edificios()
    {
        return $this->belongsTo(Edificio::class);
    }

    public function aulas()
    {
        return $this->hasMany(Aula::class);
    }

}
