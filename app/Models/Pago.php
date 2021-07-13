<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';

    protected $fillable = [
        'id_reserva',
        'id_paciente',
        'fecha_pago',
        'monto_pago',
    ];

    public function pacientes(){
        return $this->belongsTo('App\Model\Paciente');
    }

    public function reservas(){
        return $this->belongsTo('App\Model\Reserva');
    }

}
