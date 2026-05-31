<?php

namespace App\Filament\Resources\SchoolSliderResource\Pages;

use App\Filament\Resources\SchoolSliderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSchoolSlider extends CreateRecord
{
    protected static string $resource = SchoolSliderResource::class;

    protected static ?string $title = 'إضافة شريحة جديدة';
}