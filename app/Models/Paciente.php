<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';

    protected $fillable = [
        'id_psicologo',
        'rut_paciente',
        'nombre_paciente',
        'ap_pat_paciente',
        'ap_mat_paciente',
        'sexo_paciente',
        'profesion',
        'certificado',
        'telefono_paciente',
        'email',
        'suspended_account',
        'fecha_nacimiento_paciente',
        'patologias_previas',
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

    public function encuestas(){
        return $this->hasOne('App\Model\Encuesta');
    }
}
