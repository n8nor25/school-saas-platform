<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\StudentScore;

class StudentResultController extends Controller
{
    public function index(Request $request, $tenant)
    {
        if (function_exists('tenancy')) {
            tenancy()->initialize($tenant);
        }

        $query = trim($request->input('search_query', ''));
        $rawGradeId = $request->input('grade_id', '');

        $searched = !empty($query) && !empty($rawGradeId);
        $error = null;
        $studentResult = null;

        // جلب الصفوف النشطة من قاعدة البيانات ديناميكياً
        try {
            $activeResults = Result::active()->orderBy('grade_name')->orderBy('term')->get();
        } catch (\Exception $e) {
            $activeResults = collect([]);
        }

        // بناء خيارات الصفوف من قاعدة البيانات
        $gradeOptions = [];
        foreach ($activeResults as $result) {
            $optionValue = $result->grade_name . '|' . $result->term;
            $gradeOptions[$optionValue] = $result->grade_name . ' (' . $result->term . ')';
        }

        if (!$searched) {
            return view('student.search', compact('tenant', 'searched', 'error', 'studentResult', 'gradeOptions', 'activeResults'));
        }

        // البحث في قاعدة البيانات
        if (str_contains($rawGradeId, '|')) {
            $parts = explode('|', $rawGradeId);
            $gradeName = trim($parts[0]);
            $termName = trim($parts[1]);

            try {
                $result = Result::active()
                    ->where('grade_name', $gradeName)
                    ->where('term', $termName)
                    ->first();

                if ($result) {
                    // البحث برقم الجلوس أو اسم الطالب
                    $score = StudentScore::where('result_id', $result->id)
                        ->where(function ($q) use ($query) {
                            $q->where('seat_number', $query)
                              ->orWhere('seat_number', 'LIKE', "%{$query}%")
                              ->orWhere('student_name', 'LIKE', "%{$query}%");
                        })
                        ->first();

                    if ($score) {
                        $algebra = $score->algebra ?? 0;
                        $geometry = $score->geometry ?? 0;
                        $math = $score->math ?? ($algebra + $geometry);

                        $studentResult = [
                            'seatNumber'     => $score->seat_number,
                            'studentName'    => $score->student_name,
                            'gradeName'      => $result->grade_name,
                            'term'           => $result->term,
                            'arabic'         => $score->arabic,
                            'english'        => $score->english,
                            'socialStudies'  => $score->social_studies,
                            'algebra'        => $algebra,
                            'geometry'       => $geometry,
                            'math'           => $math,
                            'science'        => $score->science,
                            'religion'       => $score->religion,
                            'art'            => $score->art,
                            'computer'       => $score->computer,
                            'total'          => $score->total,
                        ];
                    }
                }
            } catch (\Exception $e) {
                logger('Search DB error: ' . $e->getMessage());
                $error = 'حدث خطأ أثناء البحث. حاول مرة أخرى.';
            }

            if (!$studentResult && !$error) {
                $error = 'عذراً! لم نجد أي نتائج تطابق رقم الجلوس أو الاسم المدخل لهذا الصف والترم.';
            }

            return view('student.search', compact('tenant', 'searched', 'error', 'studentResult', 'gradeOptions', 'activeResults'));
        }

        $error = 'برجاء اختيار الصف والترم وتدوين رقم الجلوس بشكل صحيح.';
        return view('student.search', compact('tenant', 'searched', 'error', 'studentResult', 'gradeOptions', 'activeResults'));
    }
}