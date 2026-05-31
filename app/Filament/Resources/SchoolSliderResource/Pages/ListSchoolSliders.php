<?php

namespace App\Filament\Resources\SchoolSliderResource\Pages;

use App\Filament\Resources\SchoolSliderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchoolSliders extends ListRecords
{
    protected static string $resource = SchoolSliderResource::class;

    protected static ?string $title = 'إدارة السلايدر';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('إضافة شريحة جديدة'),
        ];
    }
}