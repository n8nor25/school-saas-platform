<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentScore;

class StudentResultController extends Controller
{
    /**
     * معالجة واستقبال طلبات البحث عن نتائج الطلاب من الواجهة الخارجية
     * متوافقة بالكامل مع نظام التوجيه القياسي وتمنع أخطاء تضارب أنواع الـ SQL
     */
    public function index(Request $request, $tenant)
    {
        // 1. استقبال وتطهير حقول نموذج البحث المدخلة من قِبل الطالب
        $query = trim($request->input('search_query'));
        $rawGradeId = $request->input('grade_id'); 
        
        $searched = !empty($query);
        $error = null;
        $studentResult = null;

        // التحقق الأولي: في حال الدخول المبكر لصفحة الاستعلام دون الضغط على زر البحث
        if (!$searched) {
            return view('student.search', compact('tenant', 'searched', 'error', 'studentResult'));
        }

        // 2. [المسار الحركي المؤمن] - في حال كانت القيمة نصية مدمجة "الصف|الترم" لمنع انهيار الـ BigInt 7 ERROR
        if (str_contains($rawGradeId, '|')) {
            $parts = explode('|', $rawGradeId);
            $gradeName = trim($parts[0]); // مثل: "الثالث الإعدادي"
            $termName = trim($parts[1]);  // مثل: "الترم الأول"

            // أ. الفحص الفوري داخل مصفوفة الكشوف المجمعة الحية بالـ Session لمزامنة ملف الإكسيل المرفوع
            if ($request->session()->has('searchable_students_db')) {
                $allStudents = $request->session()->get('searchable_students_db', []);
                
                foreach ($allStudents as $seat => $data) {
                    // مطابقة مرنة وذكية تدعم رقم الجلوس المباشر أو البحث بالاسم الكلي
                    if (($seat == $query || str_contains($data['studentName'], $query)) && $data['gradeName'] == $gradeName && $data['term'] == $termName) {
                        $studentResult = $data;
                        break;
                    }
                }
            }

            // ب. خطة حماية الكنترول: في حال القراءة والربط النصي المباشر مع PostgreSQL دون حقن النصوص في الحقول الرقمية
            if (!$studentResult) {
                try {
                    // نبحث بالاسم أو برقم الجلوس نصياً أولاً لتفادي استعلام الـ result_id المسبب للـ Crash
                    $scores = StudentScore::where(function($q) use ($query) {
                            $q->where('student_name', 'LIKE', "%{$query}%")
                              ->orWhere('seat_number', 'LIKE', "%{$query}%");
                        })->get();

                    // فحص وتصفية السجلات بداخل طاقة الـ PHP لضمان جلب الصف الدراسي المحدد بالملي
                    $filteredScore = $scores->filter(function($item) use ($gradeName) {
                        $itemGrade = $item->grade_name ?? '';
                        return (str_contains($itemGrade, $gradeName) || $itemGrade == $gradeName);
                    })->first();

                    if ($filteredScore) {
                        $studentResult = [
                            'seatNumber'    => $filteredScore->seat_number ?? $query,
                            'studentName'   => $filteredScore->student_name,
                            'gradeName'     => $gradeName,
                            'term'          => $termName,
                            'arabic'        => $filteredScore->arabic ?? 0,
                            'english'       => $filteredScore->english ?? 0,
                            'algebra'       => $filteredScore->algebra ?? 0,
                            'geometry'      => $filteredScore->geometry ?? 0,
                            'science'       => $filteredScore->science ?? 0,
                            'socialStudies' => $filteredScore->social_studies ?? 0,
                            'totalScore'    => $filteredScore->total ?? $filteredScore->total_score ?? 0,
                            'religion'      => $filteredScore->religion ?? 0,
                            'art'           => $filteredScore->art ?? 0,
                            'computer'      => $filteredScore->computer ?? 0,
                        ];
                    }
                } catch (\Exception $e) {
                    logger('PostgreSQL dynamic boundary alert: ' . $e->getMessage());
                }
            }

            // ج. توليد رسالة تنبيه واضحة للظهور في قالب الـ Blade في حال عدم وجود رقم الجلوس
            if (!$studentResult) {
                $error = 'عذراً! لم نجد أي نتائج تطابق رقم الجلوس أو الاسم المدخل بداخل الكشوف المعتمدة لهذا الصف والترم.';
            }

            return view('student.search', compact('tenant', 'searched', 'error', 'studentResult'));
        }

        // 3. [المسار الكلاسيكي المعزول] - في حال تم تمرير المُعرف كـ ID رقمي صِرف بقاعدة البيانات المادية
        if (is_numeric($rawGradeId)) {
            try {
                $scores = StudentScore::where('result_id', intval($rawGradeId))
                    ->where(function($q) use ($query) {
                        $q->where('student_name', 'LIKE', "%{$query}%")
                          ->orWhere('seat_number', $query);
                    })->first();

                if ($scores) {
                    $studentResult = [
                        'seatNumber'    => $scores->seat_number,
                        'studentName'   => $scores->student_name,
                        'gradeName'     => $scores->grade_relation->name ?? 'الصف الدراسي المعتمد',
                        'term'          => $scores->term ?? 'الفصل الدراسي الأول',
                        'arabic'        => $scores->arabic ?? 0,
                        'english'       => $scores->english ?? 0,
                        'algebra'       => $scores->algebra ?? 0,
                        'geometry'      => $scores->geometry ?? 0,
                        'science'       => $scores->science ?? 0,
                        'socialStudies' => $scores->social_studies ?? 0,
                        'totalScore'    => $scores->total ?? 0,
                        'religion'      => $scores->religion ?? 0,
                        'art'           => $scores->art ?? 0,
                        'computer'      => $scores->computer ?? 0,
                    ];
                } else {
                    $error = 'رقم الجلوس أو اسم الطالب غير مقيد بسجلات هذا الصف الرقمي حالياً.';
                }
            } catch (\Exception $e) {
                $error = 'حدث عطل فني غير متوقع أثناء معالجة الاستعلام بداخل قاعدة البيانات المادية.';
            }

            return view('student.search', compact('tenant', 'searched', 'error', 'studentResult'));
        }

        // حماية افتراضية في حال محاولة إرسال قيم فارغة أو متلاعب بها
        $error = 'برجاء التحقق من اختيار الصف والترم من القائمة المنسدلة وتدوين رقم الجلوس بشكل صحيح.';
        return view('student.search', compact('tenant', 'searched', 'error', 'studentResult'));
    }
}