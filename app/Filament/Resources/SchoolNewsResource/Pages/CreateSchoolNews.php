<?php

namespace App\Filament\Resources\SchoolNewsResource\Pages;

use App\Filament\Resources\SchoolNewsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSchoolNews extends CreateRecord
{
    protected static string $resource = SchoolNewsResource::class;

    protected static ?string $title = 'إضافة خبر جديد';
}