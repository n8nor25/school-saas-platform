<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolSliderResource\Pages;
use App\Models\SchoolSlider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class SchoolSliderResource extends Resource
{
    protected static ?string $model = SchoolSlider::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'السلايدر';

    protected static ?string $modelLabel = 'شريحة';

    protected static ?string $pluralModelLabel = 'السلايدر';

    protected static ?string $navigationGroup = 'محتوى المدرسة';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('محتوى الشريحة')
                    ->schema([
                        TextInput::make('title')
                            ->label('العنوان')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('subtitle')
                            ->label('العنوان الفرعي')
                            ->rows(2)
                            ->maxLength(500),
                    ]),

                Section::make('الصورة')
                    ->schema([
                        FileUpload::make('image')
                            ->label('صورة الشريحة')
                            ->image()
                            ->required()
                            ->maxSize(5120)
                            ->directory('sliders')
                            ->imageEditor()
                            ->helperText('يُنصح بأبعاد 1200×500 بكسل'),
                    ]),

                Section::make('الإعدادات')
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('ترتيب العرض')
                            ->numeric()
                            ->default(0)
                            ->helperText('الأرقام الأصغر تظهر أولاً'),

                        Toggle::make('is_active')
                            ->label('نشط (مرئي في البوابة)')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('الصورة')
                    ->circular()
                    ->size(50),
                TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable()
                    ->limit(30),
                TextColumn::make('subtitle')
                    ->label('العنوان الفرعي')
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('sort_order')
                    ->label('الترتيب')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('نشط'),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order')
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
            'index' => Pages\ListSchoolSliders::route('/'),
            'create' => Pages\CreateSchoolSlider::route('/create'),
            'edit' => Pages\EditSchoolSlider::route('/{record}/edit'),
        ];
    }
}