<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';

    protected $fillable = [
        'rut_paciente',
        'nombre_paciente',
        'ap_pat_paciente',
        'ap_mat_paciente',
        'sexo',
        'profesion',
        'telefono_paciente',
        'email',
        'fecha_nacimiento_paciente',
        'alergia',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function fichas_pacientes(){
        return $this->hasMany('App\Model\Fichapaciente');
    }

    public function pagos(){
        return $this->hasMany('App\Model\Pago');
    }

    public function reservas(){
        return $this->hasMany('App\Model\Reserva');
    }
}
