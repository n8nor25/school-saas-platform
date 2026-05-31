<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolSettingResource\Pages;
use App\Models\SchoolSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class SchoolSettingResource extends Resource
{
    protected static ?string $model = SchoolSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'إعدادات المدرسة';

    protected static ?string $modelLabel = 'إعداد';

    protected static ?string $pluralModelLabel = 'إعدادات المدرسة';

    protected static ?string $navigationGroup = 'الإعدادات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('مفتاح الإعداد')
                    ->description('اسم التعريف الفريد للإعداد')
                    ->schema([
                        TextInput::make('key')
                            ->label('المفتاح')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('مثال: school_name, hero_title, vision')
                            ->disabled(fn (string $operation): bool => $operation === 'edit'),
                    ]),

                Section::make('القيمة')
                    ->schema([
                        Textarea::make('value')
                            ->label('القيمة')
                            ->rows(4)
                            ->columnSpanFull()
                            ->helperText('إذا كان النوع JSON، أدخل البيانات بتنسيق JSON صحيح'),
                    ]),

                Section::make('نوع البيانات')
                    ->schema([
                        Select::make('type')
                            ->label('النوع')
                            ->options([
                                'text' => 'نص',
                                'json' => 'JSON (بيانات مركبة)',
                                'number' => 'رقم',
                            ])
                            ->required()
                            ->default('text')
                            ->live()
                            ->helperText(fn ($state) => $state === 'json' 
                                ? 'أدخل القيمة بتنسيق JSON مثل: {"students": 450, "teachers": 35}' 
                                : 'أدخل القيمة كنص عادي أو رقم'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->label('المفتاح')
                    ->searchable()
                    ->copyable()
                    ->weight('bold'),
                TextColumn::make('value')
                    ->label('القيمة')
                    ->limit(50)
                    ->wrap(),
                TextColumn::make('type')
                    ->label('النوع')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'json' => 'warning',
                        'number' => 'success',
                        default => 'info',
                    }),
                TextColumn::make('updated_at')
                    ->label('آخر تعديل')
                    ->date('Y-m-d H:i')
                    ->sortable(),
            ])
            ->defaultSort('key', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('النوع')
                    ->options([
                        'text' => 'نص',
                        'json' => 'JSON',
                        'number' => 'رقم',
                    ]),
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
            'index' => Pages\ListSchoolSettings::route('/'),
            'create' => Pages\CreateSchoolSetting::route('/create'),
            'edit' => Pages\EditSchoolSetting::route('/{record}/edit'),
        ];
    }
}