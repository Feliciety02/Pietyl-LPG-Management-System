<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'role_name',
        'pin_hash',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
