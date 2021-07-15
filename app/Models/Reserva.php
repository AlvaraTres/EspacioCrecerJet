<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';

    protected $fillable = [
        'id_usuario',
        'id_paciente',
        'fecha_reserva',
        'hora_reserva',
        'fecha_hora_reserva',
        'motivo_reserva',
        'cert_alumno_regular',
        'fecha_hora_reserva_fin',
    ];

    public function reservas(){
        return $this->hasOne('App\Model\Pago');
    }

    public function users(){
        return $this->belongsTo('App\Model\User');
    }

    public function pacientes(){
        return $this->belongsTo('App\Model\Paciente');
    }

    public function horarios(){
        return $this->belongsTo('App\Model\Horario');
    }
}