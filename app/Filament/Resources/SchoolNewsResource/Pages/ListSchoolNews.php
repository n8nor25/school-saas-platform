<?php

namespace App\Filament\Resources\SchoolNewsResource\Pages;

use App\Filament\Resources\SchoolNewsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchoolNews extends ListRecords
{
    protected static string $resource = SchoolNewsResource::class;

    protected static ?string $title = 'إدارة الأخبار والتنبيهات';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('إضافة خبر جديد'),
        ];
    }
}