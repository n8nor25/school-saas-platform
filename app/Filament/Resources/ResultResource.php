<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResultResource\Pages;
use App\Models\Result;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class ResultResource extends Resource
{
    protected static ?string $model = Result::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    protected static ?string $navigationLabel = 'كشوف النتائج';

    protected static ?string $modelLabel = 'كشف نتائج';

    protected static ?string $pluralModelLabel = 'كشوف النتائج';

    protected static ?string $navigationGroup = 'الكشوف والنتائج';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('grade_name')
                    ->label('الصف الدراسي')
                    ->options([
                        'الصف الأول الإعدادي' => 'الصف الأول الإعدادي',
                        'الصف الثاني الإعدادي' => 'الصف الثاني الإعدادي',
                        'الصف الثالث الإعدادي' => 'الصف الثالث الإعدادي',
                    ])
                    ->required(),

                Select::make('term')
                    ->label('الفصل الدراسي')
                    ->options([
                        'الفصل الأول' => 'الفصل الأول',
                        'الفصل الثاني' => 'الفصل الثاني',
                    ])
                    ->required(),

                Toggle::make('archived')
                    ->label('أرشفة (إخفاء من الاستعلام)'),

                Repeater::make('studentScores')
                    ->relationship()
                    ->label('درجات الطلاب')
                    ->schema([
                        TextInput::make('seat_number')
                            ->label('رقم الجلوس')
                            ->required()
                            ->maxLength(20),
                        TextInput::make('student_name')
                            ->label('اسم الطالب')
                            ->required(),
                        TextInput::make('arabic')
                            ->label('العربية')
                            ->numeric()
                            ->default(0),
                        TextInput::make('english')
                            ->label('الإنجليزية')
                            ->numeric()
                            ->default(0),
                        TextInput::make('social_studies')
                            ->label('الدراسات')
                            ->numeric()
                            ->default(0),
                        TextInput::make('math')
                            ->label('الرياضيات')
                            ->numeric()
                            ->default(0),
                        TextInput::make('science')
                            ->label('العلوم')
                            ->numeric()
                            ->default(0),
                        TextInput::make('religion')
                            ->label('الدين')
                            ->numeric()
                            ->default(0),
                        TextInput::make('art')
                            ->label('الفنية')
                            ->numeric()
                            ->default(0),
                        TextInput::make('computer')
                            ->label('الحاسب')
                            ->numeric()
                            ->default(0),
                        TextInput::make('total')
                            ->label('المجموع')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(5)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('grade_name')
                    ->label('الصف الدراسي')
                    ->searchable()
                    ->badge()
                    ->color('primary'),
                TextColumn::make('term')
                    ->label('الترم')
                    ->searchable(),
                TextColumn::make('student_scores_count')
                    ->counts('studentScores')
                    ->label('عدد الطلاب')
                    ->badge()
                    ->color('success'),
                IconColumn::make('archived')
                    ->boolean()
                    ->label('مؤرشف'),
                TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->date('Y-m-d')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('archived')
                    ->label('حالة الأرشفة'),
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
            'index' => Pages\ListResults::route('/'),
            'create' => Pages\CreateResult::route('/create'),
            'edit' => Pages\EditResult::route('/{record}/edit'),
        ];
    }
}