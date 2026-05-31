<?php

namespace App\Filament\Resources\SchoolTeacherResource\Pages;

use App\Filament\Resources\SchoolTeacherResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchoolTeacher extends EditRecord
{
    protected static string $resource = SchoolTeacherResource::class;

    protected static ?string $title = 'تعديل بيانات المعلم';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}