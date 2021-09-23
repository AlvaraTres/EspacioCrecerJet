<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suspendedaccount extends Model
{
    use HasFactory;

    protected $table = 'suspended_account';

    protected $fillable = [
        'email'
    ];
}
