<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roleuser extends Model
{
    protected $table = 'roles_users';

    protected $fillable = [
        'tipo_usuario',
    ];

    //Relacion uno a uno
    public function users(){
        $this->hasOne('App\Model\User');
    }
}
