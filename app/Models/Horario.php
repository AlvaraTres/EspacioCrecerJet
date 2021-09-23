<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';

    protected $fillable = [
        'id_user',
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

    public function users(){
        return $this->belongsTo('App\Model\User');
    }
}
