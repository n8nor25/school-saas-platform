<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['grade_name', 'term', 'archived'];

    // علاقة الربط: كل نتيجة صف تحتوي على عدة درجات للطلاب
    public function studentScores()
    {
        return $this->hasMany(StudentScore::class);
    }
}