<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use App\Models\Result;
use App\Filament\Resources\ResultResource\Pages;
use App\Filament\Resources\ResultResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class ResultResource extends Resource
{
    protected static ?string $model = Result::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
    return $form
        ->schema([
            // الخانات الأساسية للصف الدراسي
            TextInput::make('grade_name')->label('اسم الصف (مثل: الأول الثانوي)')->required(),
            TextInput::make('term')->label('الفصل الدراسي (الترم)')->required(),
            Toggle::make('archived')->label('أرشفة النتيجة (إخفاء)'),

            // الميزة السحرية: إدخال درجات الطلاب في نفس الشاشة برمجياً
            Repeater::make('studentScores')
                ->relationship() // هذه الكلمة تربط الدرجات بالصف تلقائياً
                ->label('إدخال درجات الطلاب')
                ->schema([
                    TextInput::make('student_name')->label('اسم الطالب')->required(),
                    TextInput::make('subject_name')->label('المادة')->required(),
                    TextInput::make('score')->label('الدرجة')->numeric()->required(),
                ])
                ->columns(3) // عرض الخانات بجوار بعضها
                ->columnSpanFull(), // جعل القسم يأخذ عرض الشاشة بالكامل
        ]);
}

    public static function table(Table $table): Table
    {
   return $table
        ->columns([
            TextColumn::make('grade_name')->label('اسم الصف')->searchable(),
            TextColumn::make('term')->label('الترم'),
            TextColumn::make('student_scores_count')->counts('studentScores')->label('عدد الطلاب'),
            IconColumn::make('archived')->boolean()->label('مؤرشف'),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        // === إضافة الزر السحري لقراءة ملف الـ JSON هنا ===
        ->headerActions([
            Tables\Actions\Action::make('importJson')
                ->label('استيراد من ملف JSON 🚀')
                ->form([
                    TextInput::make('grade_name')->label('اسم الصف الدراسي (مثل: الثاني الثانوي)')->required(),
                    TextInput::make('term')->label('الفصل الدراسي (مثل: الترم الأول)')->required(),
                    FileUpload::make('json_file')
                        ->label('اختر ملف الـ JSON')
                        ->required()
                        ->disk('local') // حفظ مؤقت على السيرفر لقراءته
                ])
                ->action(function (array $data) {
                    // 1. قراءة محتوى ملف الـ JSON الخفيف
                    $jsonContent = Storage::disk('local')->get($data['json_file']);
                    $scoresArray = json_decode($jsonContent, true);

                    if (is_array($scoresArray)) {
                        // 2. إنشاء سجل الصف الرئيسي
                        $result = Result::create([
                            'grade_name' => $data['grade_name'],
                            'term' => $data['term'],
                            'archived' => false
                        ]);

                        // 3. إدخال مئات الطلاب والدرجات في ثوانٍ معدودة بدون OOM
                        foreach ($scoresArray as $row) {
                            $result->studentScores()->create([
                                'student_name' => $row['student_name'],
                                'subject_name' => $row['subject_name'],
                                'score' => $row['score'],
                            ]);
                        }
                    }

                    // 4. حذف الملف المؤقت للحفاظ على مساحة الجهاز
                    Storage::disk('local')->delete($data['json_file']);
                })
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
