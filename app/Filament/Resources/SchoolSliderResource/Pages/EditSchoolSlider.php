<?php

namespace App\Filament\Resources\SchoolSliderResource\Pages;

use App\Filament\Resources\SchoolSliderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchoolSlider extends EditRecord
{
    protected static string $resource = SchoolSliderResource::class;

    protected static ?string $title = 'تعديل الشريحة';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}