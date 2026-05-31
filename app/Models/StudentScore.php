<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentScore extends Model
{
    protected $fillable = [
        'result_id',
        'seat_number',
        'student_name',
        'arabic',
        'english',
        'social_studies',
        'algebra',
        'geometry',
        'math',
        'science',
        'religion',
        'art',
        'computer',
        'total',
        'result',
    ];

    protected $casts = [
        'arabic' => 'decimal:1',
        'english' => 'decimal:1',
        'social_studies' => 'decimal:1',
        'algebra' => 'decimal:1',
        'geometry' => 'decimal:1',
        'math' => 'decimal:1',
        'science' => 'decimal:1',
        'religion' => 'decimal:1',
        'art' => 'decimal:1',
        'computer' => 'decimal:1',
        'total' => 'decimal:1',
    ];

    public function resultRecord()
    {
        return $this->belongsTo(Result::class, 'result_id');
    }

    /**
     * حساب المجموع = عربي + إنجليزي + اجتماعيات + جبر + هندسة + علوم
     * (دين، فنية، حاسب لا تُحسب)
     */
    public function calculateTotal()
    {
        return ($this->arabic ?? 0)
             + ($this->english ?? 0)
             + ($this->social_studies ?? 0)
             + ($this->algebra ?? 0)
             + ($this->geometry ?? 0)
             + ($this->science ?? 0);
    }

    /**
     * رياضيات = جبر + هندسة
     */
    public function getMathAttribute()
    {
        // إذا math محفوظ فعلاً أرجعه، وإلا احسبه
        $math = $this->attributes['math'] ?? null;
        if ($math !== null && $math != 0) {
            return $math;
        }
        return ($this->algebra ?? 0) + ($this->geometry ?? 0);
    }
}