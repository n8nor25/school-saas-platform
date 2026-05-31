<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolNewsResource\Pages;
use App\Models\SchoolNews;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\BadgeColumn;

class SchoolNewsResource extends Resource
{
    protected static ?string $model = SchoolNews::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'الأخبار والتنبيهات';

    protected static ?string $modelLabel = 'خبر';

    protected static ?string $pluralModelLabel = 'الأخبار والتنبيهات';

    protected static ?string $navigationGroup = 'محتوى المدرسة';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('عنوان الخبر')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Textarea::make('content')
                    ->label('محتوى الخبر')
                    ->rows(4)
                    ->columnSpanFull(),

                Select::make('category')
                    ->label('التصنيف')
                    ->options([
                        'أخبار' => 'أخبار',
                        'تنبيه' => 'تنبيه',
                        'فعاليات' => 'فعاليات',
                    ])
                    ->required()
                    ->default('أخبار'),

                DatePicker::make('date')
                    ->label('التاريخ')
                    ->required()
                    ->default(now())
                    ->native(false),

                Toggle::make('is_active')
                    ->label('منشور (مرئي للمستخدمين)')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable()
                    ->limit(40),
                TextColumn::make('category')
                    ->label('التصنيف')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'تنبيه' => 'danger',
                        'فعاليات' => 'warning',
                        default => 'info',
                    }),
                TextColumn::make('date')
                    ->label('التاريخ')
                    ->date('Y-m-d')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('منشور'),
            ])
            ->defaultSort('date', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('حالة النشر'),
                Tables\Filters\SelectFilter::make('category')
                    ->label('التصنيف')
                    ->options([
                        'أخبار' => 'أخبار',
                        'تنبيه' => 'تنبيه',
                        'فعاليات' => 'فعاليات',
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
            'index' => Pages\ListSchoolNews::route('/'),
            'create' => Pages\CreateSchoolNews::route('/create'),
            'edit' => Pages\EditSchoolNews::route('/{record}/edit'),
        ];
    }
}