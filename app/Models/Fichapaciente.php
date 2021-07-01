<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fichapaciente extends Model
{
    protected $table = 'fichas_pacientes';

    protected $fillable = [
        'id_usuario',
        'id_paciente',
        'fecha_atencion_ficha',
        'resumen_atencion',
    ];

    public function usuarios(){
        return $this->belongsTo('App\Model\User');
    }

    public function pacientes(){
        return $this->belongsTo('App\Model\Paciente');
    }

    public function incluyen(){
        return $this->hasMany('App\Model\Incluye');
    }
}
