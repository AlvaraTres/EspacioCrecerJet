<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagtrastornomental extends Model
{
    protected $table = 'tag_trastorno_mental';

    protected $fillable = [
        'nombre_tag',
        'descripcion',
    ];

    public function incluyen(){
        return $this->hasMany('App\Model\Incluye');
    }
}
