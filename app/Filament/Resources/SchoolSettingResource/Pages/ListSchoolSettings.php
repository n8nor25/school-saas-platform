<?php

namespace App\Filament\Resources\SchoolSettingResource\Pages;

use App\Filament\Resources\SchoolSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchoolSettings extends ListRecords
{
    protected static string $resource = SchoolSettingResource::class;

    protected static ?string $title = 'إعدادات المدرسة';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('إضافة إعداد جديد'),
        ];
    }
}