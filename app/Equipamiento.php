<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipamiento extends Model
{

    protected $fillable = ['nombre','cantidad'];

    public function aula()
    {
        return $this->belongsTo(Equipamiento::class);

    }
}
