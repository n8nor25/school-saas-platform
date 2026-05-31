<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolTeacher extends Model
{
    protected $fillable = ['name', 'subject', 'email', 'avatar', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}