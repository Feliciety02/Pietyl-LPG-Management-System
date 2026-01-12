<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'role_name',
        'is_active',
        'pin_hash',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
