<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolNews extends Model
{
    protected $fillable = ['title', 'content', 'category', 'date', 'is_active'];

    protected $casts = [
        'date' => 'date',
        'is_active' => 'boolean',
    ];
}