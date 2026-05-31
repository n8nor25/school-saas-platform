<?php

namespace App\Filament\Resources\SchoolNewsResource\Pages;

use App\Filament\Resources\SchoolNewsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchoolNews extends EditRecord
{
    protected static string $resource = SchoolNewsResource::class;

    protected static ?string $title = 'تعديل الخبر';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}