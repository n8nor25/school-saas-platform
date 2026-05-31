<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'grade_name',
        'term',
        'sheet_name',
        'archived',
    ];

    protected $casts = [
        'archived' => 'boolean',
    ];

    public function studentScores()
    {
        return $this->hasMany(StudentScore::class, 'result_id');
    }

    /**
     * النتائج النشطة فقط (غير المؤرشفة)
     */
    public function scopeActive($query)
    {
        return $query->where('archived', false);
    }

    /**
     * النتائج المؤرشفة
     */
    public function scopeArchived($query)
    {
        return $query->where('archived', true);
    }
}