<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentScore extends Model
{
    protected $fillable = ['result_id', 'student_name', 'score', 'subject_name'];

    // علاقة الربط: هذه الدرجة تنتمي لنتيجة صف دراسي معين
    public function result()
    {
        return $this->belongsTo(Result::class);
    }
}