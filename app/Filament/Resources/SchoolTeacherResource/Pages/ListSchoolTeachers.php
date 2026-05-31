<?php

namespace App\Filament\Resources\SchoolTeacherResource\Pages;

use App\Filament\Resources\SchoolTeacherResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchoolTeachers extends ListRecords
{
    protected static string $resource = SchoolTeacherResource::class;

    protected static ?string $title = 'إدارة المعلمين';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('إضافة معلم جديد'),
        ];
    }
}