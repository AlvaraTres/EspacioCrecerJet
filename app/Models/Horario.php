<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horarios';

    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'hora_inicio',
        'hora_fin',
        'fecha_hora_inicio',
        'fecha_hora_fin',
    ];

    public function reservas(){
        return $this->hasOne('App\Model\Reserva');
    }
}
