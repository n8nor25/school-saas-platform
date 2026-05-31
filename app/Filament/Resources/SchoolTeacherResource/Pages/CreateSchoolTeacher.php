<?php

namespace App\Filament\Resources\SchoolTeacherResource\Pages;

use App\Filament\Resources\SchoolTeacherResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSchoolTeacher extends CreateRecord
{
    protected static string $resource = SchoolTeacherResource::class;

    protected static ?string $title = 'إضافة معلم جديد';
}