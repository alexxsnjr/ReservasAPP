<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Profesor extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function reserva()
    {
        return $this->hasMany(Reserva::class);
    }

    public function horario()
    {
        return $this->hasMany(Horario::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($profesor) {

            $profesor->reserva->each->delete();
            $profesor->horario->each->delete();

        });
    }

}
