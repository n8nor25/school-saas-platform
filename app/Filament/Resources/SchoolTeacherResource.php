<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolTeacherResource\Pages;
use App\Models\SchoolTeacher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class SchoolTeacherResource extends Resource
{
    protected static ?string $model = SchoolTeacher::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'المعلمين';

    protected static ?string $modelLabel = 'معلم';

    protected static ?string $pluralModelLabel = 'المعلمين';

    protected static ?string $navigationGroup = 'محتوى المدرسة';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('اسم المعلم')
                    ->required()
                    ->maxLength(255),

                TextInput::make('subject')
                    ->label('المادة')
                    ->required()
                    ->maxLength(100),

                TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->email()
                    ->maxLength(255),

                FileUpload::make('avatar')
                    ->label('الصورة الشخصية')
                    ->image()
                    ->maxSize(2048)
                    ->directory('teachers')
                    ->imageEditor(),

                Toggle::make('is_active')
                    ->label('نشط (مرئي في البوابة)')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('الصورة')
                    ->circular()
                    ->defaultImageUrl(fn () => 'https://ui-avatars.com/api/?background=610000&color=fff&name=U'),
                TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subject')
                    ->label('المادة')
                    ->badge()
                    ->color('primary'),
                TextColumn::make('email')
                    ->label('البريد')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('نشط'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('الحالة'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchoolTeachers::route('/'),
            'create' => Pages\CreateSchoolTeacher::route('/create'),
            'edit' => Pages\EditSchoolTeacher::route('/{record}/edit'),
        ];
    }
}