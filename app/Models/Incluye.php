<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incluye extends Model
{
    protected $table = 'incluyen';

    protected $fillable = [
        'id_tag_trastorno',
        'id_ficha_paciente',
    ];

    public function tag_trastorno_mental(){
        return $this->belongsTo('App\Model\Tagtrastornomental');
    }

    public function paciente(){
        return $this->belongsTo('App\Model\Paciente');
    }
}
