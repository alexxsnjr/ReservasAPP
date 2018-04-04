<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipamiento extends Model
{
    public function aula()
    {
        return $this->belongsTo(Equipamiento::class);

    }
}
