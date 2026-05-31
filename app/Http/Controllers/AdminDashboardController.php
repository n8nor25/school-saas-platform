<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\StudentScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AdminDashboardController extends Controller
{
    private array $totalSubjects = ['arabic', 'english', 'social_studies', 'algebra', 'geometry', 'science'];

    private array $arabicToEnglish = [
        'رقم الجلوس'     => 'seatNumber',
        'جلوس'           => 'seatNumber',
        'seat number'     => 'seatNumber',
        'seat'            => 'seatNumber',
        'E'               => 'seatNumber',

        'اسم الطالب'     => 'studentName',
        'اسم الطال'      => 'studentName',
        'الطالب'         => 'studentName',
        'الاسم'          => 'studentName',
        'اسم'            => 'studentName',
        'student name'   => 'studentName',
        'اسم الطالب '    => 'studentName',

        'اللغة العربية'  => 'arabic',
        'لغة عربية'      => 'arabic',
        'عربي'           => 'arabic',
        'العربية'        => 'arabic',
        'اللغه العربية'  => 'arabic',
        'لغه عربية'      => 'arabic',
        'لغة العربية'    => 'arabic',
        'لغه العربيه'    => 'arabic',
        'اللغة العربيه'  => 'arabic',
        'arabic'         => 'arabic',

        'اللغة الانجليزية'    => 'english',
        'اللغة الإنجليزية'    => 'english',
        'لغة انجليزية'        => 'english',
        'لغة إنجليزية'        => 'english',
        'انجليزي'             => 'english',
        'إنجليزي'             => 'english',
        'اللغه الانجليزيه'    => 'english',
        'اللغه الإنجليزيه'    => 'english',
        'لغه انجليزيه'        => 'english',
        'english'              => 'english',
        'اللغة الإنجليزية'     => 'english',
        'اللغه الانجليزية'     => 'english',

        'الدراسات الاجتماعية'   => 'social_studies',
        'دراسات اجتماعية'       => 'social_studies',
        'اجتماعيات'             => 'social_studies',
        'الدراسات'              => 'social_studies',
        'دراسات'                => 'social_studies',
        'الدراسات الاجتماعيه'   => 'social_studies',
        'social studies'        => 'social_studies',

        'الجبر'           => 'algebra',
        'جبر'             => 'algebra',
        'الجبر والاحصاء'  => 'algebra',
        'algebra'         => 'algebra',

        'الهندسة'         => 'geometry',
        'هندسة'           => 'geometry',
        'الهندسه'         => 'geometry',
        'geometry'        => 'geometry',

        'الرياضيات'       => 'math',
        'رياضيات'         => 'math',
        'الرياضه'         => 'math',
        'الرياضة'         => 'math',
        'math'            => 'math',

        'العلوم'          => 'science',
        'علوم'            => 'science',
        'العوم'           => 'science',
        'science'         => 'science',

        'التربية الدينية'           => 'religion',
        'تربية دينية'               => 'religion',
        'دين'                       => 'religion',
        'الدين'                     => 'religion',
        'التربيه الدينيه'           => 'religion',
        'التربية الدينية الإسلامية' => 'religion',
        'religion'                  => 'religion',

        'التربية الفنية'       => 'art',
        'تربية فنية'           => 'art',
        'فنية'                 => 'art',
        'الفنية'               => 'art',
        'التربيه الفنيه'       => 'art',
        'art'                  => 'art',
        'فنون'                 => 'art',

        'الحاسب الآلي'         => 'computer',
        'حاسب آلي'             => 'computer',
        'حاسب'                 => 'computer',
        'الحاسب'               => 'computer',
        'computer'             => 'computer',
        'كمبيوتر'              => 'computer',
        'تكنولوجيا المعلومات'  => 'computer',
    ];

    private function mapColumnName(string $rawName): ?string
    {
        $clean = trim($rawName);
        if ($clean === '') return null;

        if (isset($this->arabicToEnglish[$clean])) return $this->arabicToEnglish[$clean];

        $lower = mb_strtolower($clean, 'UTF-8');
        foreach ($this->arabicToEnglish as $arabic => $english) {
            if (mb_strtolower($arabic, 'UTF-8') === $lower) return $english;
        }

        $withoutAl = $clean;
        if (mb_substr($clean, 0, 2, 'UTF-8') === 'ال') {
            $withoutAl = mb_substr($clean, 2, null, 'UTF-8');
        }
        if ($withoutAl !== $clean && isset($this->arabicToEnglish[$withoutAl])) return $this->arabicToEnglish[$withoutAl];

        $normalized = str_replace(['ى', 'ة'], ['ي', 'ه'], $clean);
        if (isset($this->arabicToEnglish[$normalized])) return $this->arabicToEnglish[$normalized];

        $normalizedWithoutAl = $normalized;
        if (mb_substr($normalized, 0, 2, 'UTF-8') === 'ال') {
            $normalizedWithoutAl = mb_substr($normalized, 2, null, 'UTF-8');
        }
        if ($normalizedWithoutAl !== $normalized && isset($this->arabicToEnglish[$normalizedWithoutAl])) return $this->arabicToEnglish[$normalizedWithoutAl];

        $normalizedLower = mb_strtolower($normalized, 'UTF-8');
        foreach ($this->arabicToEnglish as $arabic => $english) {
            $dictNormalized = str_replace(['ى', 'ة'], ['ي', 'ه'], $arabic);
            if (mb_strtolower($dictNormalized, 'UTF-8') === $normalizedLower) return $english;
        }

        Log::warning("mapColumnName: لا يوجد تطابق للعمود: '{$rawName}'");
        return null;
    }

    private function trimArrayKeys(array $array): array
    {
        $result = [];
        foreach ($array as $key => $value) {
            $trimmedKey = trim((string)$key);
            $result[$trimmedKey] = is_array($value) ? $this->trimArrayKeys($value) : $value;
        }
        return $result;
    }

    private function trimArrayKeysBatch(array $data): array
    {
        return array_map(fn($row) => $this->trimArrayKeys($row), $data);
    }

    /**
     * تحويل قيمة إلى رقم عشري آمن
     */
    private function toDecimal($value, float $default = 0): float
    {
        if ($value === null || $value === '') return $default;
        if (!is_numeric($value)) return $default;
        return round((float)$value, 1);
    }

    private function normalizeStudents(array $students, ?string $sheetName = null): array
    {
        $normalized = [];
        foreach ($students as $student) {
            $row = [];

            foreach ($student as $key => $value) {
                $trimmedKey = trim((string)$key);
                $englishKey = $this->mapColumnName($trimmedKey);
                if ($englishKey !== null && !isset($row[$englishKey])) {
                    $row[$englishKey] = $value;
                }
            }

            // رياضيات = جبر + هندسة
            if (!isset($row['math']) || $row['math'] === '' || $row['math'] === null) {
                $algebra = $this->toDecimal($row['algebra'] ?? 0);
                $geometry = $this->toDecimal($row['geometry'] ?? 0);
                $row['math'] = $algebra + $geometry;
            } else {
                if (!isset($row['algebra']) && !isset($row['geometry'])) {
                    $row['algebra'] = 0;
                    $row['geometry'] = $this->toDecimal($row['math']);
                }
            }

            $row['seatNumber'] = trim((string)($row['seatNumber'] ?? ''));
            $row['studentName'] = trim((string)($row['studentName'] ?? ''));

            // حساب المجموع
            $total = 0;
            foreach ($this->totalSubjects as $subject) {
                $total += $this->toDecimal($row[$subject] ?? 0);
            }
            $row['total'] = $total;

            if ($sheetName && empty($row['sheet_name'])) {
                $row['sheet_name'] = trim($sheetName);
            }

            $normalized[] = $row;
        }
        return $normalized;
    }

    private function parseJsonData($file): array
    {
        $content = file_get_contents($file->getRealPath());
        $content = trim($content);

        if (!str_starts_with($content, '[') && !str_starts_with($content, '{')) $content = '[' . $content;
        if (!str_ends_with($content, ']') && !str_ends_with($content, '}')) $content = $content . ']';
        if (str_starts_with($content, '{') && str_ends_with($content, '}')) $content = '[' . $content . ']';

        $data = json_decode($content, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $content = preg_replace('/,\s*([}\]])/', '$1', $content);
            $data = json_decode($content, true);
        }
        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('خطأ تحليل JSON: ' . json_last_error_msg());
            return [];
        }

        $students = [];
        foreach ($data as $item) {
            if (isset($item['نتيجة الطالب']) && is_array($item['نتيجة الطالب'])) {
                foreach ($item['نتيجة الطالب'] as $student) $students[] = $student;
            } elseif (isset($item['students']) && is_array($item['students'])) {
                foreach ($item['students'] as $student) $students[] = $student;
            } elseif (isset($item['data']) && is_array($item['data'])) {
                foreach ($item['data'] as $student) $students[] = $student;
            } else {
                $students[] = $item;
            }
        }

        return $this->trimArrayKeysBatch($students);
    }

    private function parseExcelFile($file): array
    {
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $sheetName = $sheet->getTitle();
        $rows = $sheet->toArray(null, true, true, true);
        if (count($rows) < 2) return [];

        $row1 = array_values($rows[1] ?? []);
        $row2 = array_values($rows[2] ?? []);

        $row2IsHeader = false;
        $numericCount = 0;
        foreach ($row2 as $cell) { if (is_numeric($cell)) $numericCount++; }
        if ($numericCount <= 1 && count($row2) > 3) $row2IsHeader = true;

        $headers = [];
        $dataStartRow = 2;

        if ($row2IsHeader) {
            for ($i = 0; $i < count($row1); $i++) {
                $h1 = trim((string)($row1[$i] ?? ''));
                $h2 = trim((string)($row2[$i] ?? ''));
                $combined = $h1 . ($h1 && $h2 ? ' ' : '') . $h2;
                $headers[] = $this->mapHeaderToField($h1, $h2, $combined);
            }
            $dataStartRow = 3;
        } else {
            for ($i = 0; $i < count($row1); $i++) {
                $h = trim((string)($row1[$i] ?? ''));
                $headers[] = $this->mapHeaderToField($h, '', $h);
            }
            $dataStartRow = 2;
        }

        $students = [];
        for ($r = $dataStartRow; $r <= count($rows); $r++) {
            $row = array_values($rows[$r] ?? []);
            if (empty($row) || count(array_filter($row)) === 0) continue;

            $student = [];
            $hasData = false;
            for ($c = 0; $c < count($headers); $c++) {
                $field = $headers[$c];
                $value = $row[$c] ?? null;
                if ($value !== null && $value !== '') {
                    $student[$field] = $value;
                    $hasData = true;
                }
            }
            if ($hasData) $students[] = $student;
        }

        return $this->normalizeStudents($students, $sheetName);
    }

    private function mapHeaderToField(string $header1, string $header2, string $combined): string
    {
        foreach ([$header1, $header2, $combined] as $h) {
            if (preg_match('/جلوس|seat/i', $h)) return 'seatNumber';
            if (preg_match('/اسم|طالب|name/i', $h)) return 'studentName';
        }
        foreach ([$combined, $header1, $header2] as $h) {
            if (empty(trim($h))) continue;
            $mapped = $this->mapColumnName($h);
            if ($mapped !== null) return $mapped;
        }
        return preg_replace('/[^a-zA-Z0-9_]/', '_', trim($combined)) ?: 'col_' . crc32($combined);
    }

    private function calculateTotal(array $data): float
    {
        $total = 0;
        foreach ($this->totalSubjects as $subject) {
            $total += $this->toDecimal($data[$subject] ?? 0);
        }
        return $total;
    }

    // ============================================================
    // الدوال الرئيسية
    // ============================================================

    public function index(Request $request)
    {
        $tenant = $request->route('tenant');
        $view = $request->query('view', 'dashboard');

        $adminUser = null;
        if (Auth::check()) {
            $adminUser = Auth::user();
        } elseif ($request->session()->has('admin_user')) {
            $adminUser = $request->session()->get('admin_user');
        }

        $stats = [
            'totalResults' => Result::count(),
            'totalStudents' => StudentScore::count(),
            'activeResults' => Result::where('archived', false)->count(),
            'archivedResults' => Result::where('archived', true)->count(),
            'newsCount' => 0,
            'galleryCount' => 0,
            'teachersCount' => 0,
            'resultsCount' => Result::where('archived', false)->count(),
        ];

        $resultGroups = Result::orderBy('grade_name')->orderBy('term')->get();

        return view('admin.layout', compact('tenant', 'view', 'adminUser', 'stats', 'resultGroups'));
    }

    public function uploadResults(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv,json,txt|max:10240',
            'grade_name' => 'required|string',
            'term' => 'required|string',
        ]);

        try {
            $file = $request->file('file');
            $gradeName = $request->input('grade_name');
            $term = $request->input('term');
            $extension = strtolower($file->getClientOriginalExtension());

            if ($extension === 'json' || $extension === 'txt') {
                $rawStudents = $this->parseJsonData($file);
            } else {
                $rawStudents = $this->parseExcelFile($file);
            }

            if (empty($rawStudents)) {
                return back()->with('error', 'لم يتم العثور على بيانات في الملف');
            }

            $students = $this->normalizeStudents($rawStudents);

            session([
                'preview_students' => $students,
                'preview_grade_name' => $gradeName,
                'preview_term' => $term,
            ]);

            return back()->with('success', 'تم تحميل الملف بنجاح (' . count($students) . ' طالب). راجع البيانات ثم اضغط حفظ الكل.');

        } catch (\Exception $e) {
            Log::error('خطأ رفع النتائج: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return back()->with('error', 'حدث خطأ أثناء معالجة الملف: ' . $e->getMessage());
        }
    }

    public function getPreviewStudents()
    {
        return response()->json([
            'students' => session('preview_students', []),
            'grade_name' => session('preview_grade_name'),
            'term' => session('preview_term'),
        ]);
    }

    /**
     * حفظ النتائج - مع تنظيف صارم للبيانات
     */
    public function saveResults(Request $request)
    {
        $students = session('preview_students', []);
        $gradeName = session('preview_grade_name');
        $term = session('preview_term');

        if (empty($students)) {
            return response()->json(['error' => 'لا توجد بيانات للحفظ'], 400);
        }

        try {
            $resultGroup = Result::updateOrCreate(
                ['grade_name' => $gradeName, 'term' => $term],
                ['sheet_name' => $students[0]['sheet_name'] ?? null]
            );

            $saved = 0;
            foreach ($students as $student) {
                // تنظيف صارم لكل حقل
                $seatNumber = trim((string)($student['seatNumber'] ?? ''));
                $studentName = trim((string)($student['studentName'] ?? ''));
                $algebra = $this->toDecimal($student['algebra'] ?? 0);
                $geometry = $this->toDecimal($student['geometry'] ?? 0);
                $math = $this->toDecimal($student['math'] ?? 0);
                if ($math == 0 && ($algebra > 0 || $geometry > 0)) {
                    $math = $algebra + $geometry;
                }

                StudentScore::updateOrCreate(
                    [
                        'result_id' => $resultGroup->id,
                        'seat_number' => $seatNumber,
                    ],
                    [
                        'student_name'   => $studentName,
                        'arabic'         => $this->toDecimal($student['arabic'] ?? 0),
                        'english'        => $this->toDecimal($student['english'] ?? 0),
                        'social_studies' => $this->toDecimal($student['social_studies'] ?? 0),
                        'algebra'        => $algebra,
                        'geometry'       => $geometry,
                        'math'           => $math,
                        'science'        => $this->toDecimal($student['science'] ?? 0),
                        'religion'       => $this->toDecimal($student['religion'] ?? 0),
                        'art'            => $this->toDecimal($student['art'] ?? 0),
                        'computer'       => $this->toDecimal($student['computer'] ?? 0),
                        'total'          => $this->calculateTotal($student),
                    ]
                );
                $saved++;
            }

            session()->forget(['preview_students', 'preview_grade_name', 'preview_term']);

            return response()->json([
                'success' => true,
                'message' => "تم حفظ نتائج {$saved} طالب بنجاح",
            ]);

        } catch (\Exception $e) {
            Log::error('خطأ حفظ النتائج: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->json(['error' => 'حدث خطأ أثناء الحفظ: ' . $e->getMessage()], 500);
        }
    }

    public function updatePreviewStudent(Request $request)
    {
        $students = session('preview_students', []);
        $index = $request->input('index');

        if (!isset($students[$index])) {
            return response()->json(['error' => 'طالب غير موجود'], 404);
        }

        $algebra = $this->toDecimal($request->input('algebra', 0));
        $geometry = $this->toDecimal($request->input('geometry', 0));
        $math = $algebra + $geometry;

        $students[$index] = [
            'seatNumber'     => trim((string)$request->input('seatNumber', '')),
            'studentName'    => trim((string)$request->input('studentName', '')),
            'arabic'         => $this->toDecimal($request->input('arabic', 0)),
            'english'        => $this->toDecimal($request->input('english', 0)),
            'social_studies' => $this->toDecimal($request->input('social_studies', 0)),
            'algebra'        => $algebra,
            'geometry'       => $geometry,
            'math'           => $math,
            'science'        => $this->toDecimal($request->input('science', 0)),
            'religion'       => $this->toDecimal($request->input('religion', 0)),
            'art'            => $this->toDecimal($request->input('art', 0)),
            'computer'       => $this->toDecimal($request->input('computer', 0)),
        ];
        $students[$index]['total'] = $this->calculateTotal($students[$index]);

        session(['preview_students' => $students]);

        return response()->json(['success' => true, 'student' => $students[$index]]);
    }

    public function updateSavedStudent(Request $request, $id)
    {
        $score = StudentScore::findOrFail($id);

        $algebra = $this->toDecimal($request->input('algebra', $score->algebra));
        $geometry = $this->toDecimal($request->input('geometry', $score->geometry));
        $math = $algebra + $geometry;

        $score->update([
            'seat_number'     => trim((string)$request->input('seatNumber', $score->seat_number)),
            'student_name'    => trim((string)$request->input('studentName', $score->student_name)),
            'arabic'          => $this->toDecimal($request->input('arabic', $score->arabic)),
            'english'         => $this->toDecimal($request->input('english', $score->english)),
            'social_studies'  => $this->toDecimal($request->input('social_studies', $score->social_studies)),
            'algebra'         => $algebra,
            'geometry'        => $geometry,
            'math'            => $math,
            'science'         => $this->toDecimal($request->input('science', $score->science)),
            'religion'        => $this->toDecimal($request->input('religion', $score->religion)),
            'art'             => $this->toDecimal($request->input('art', $score->art)),
            'computer'        => $this->toDecimal($request->input('computer', $score->computer)),
        ]);

        $score->total = $score->calculateTotal();
        $score->save();

        return response()->json(['success' => true, 'student' => $score]);
    }

    public function deleteResult($id)
    {
        $score = StudentScore::findOrFail($id);
        $score->delete();
        return response()->json(['success' => true]);
    }

    public function getResults(Request $request)
    {
        $resultId = $request->input('result_id');
        $scores = StudentScore::where('result_id', $resultId)->orderBy('seat_number')->get();
        return response()->json(['results' => $scores]);
    }

    // ============================================================
    // الأرشفة والاستعادة والحذف الجماعي
    // ============================================================

    /**
     * أرشفة مجموعة نتائج
     */
    public function archiveResult(Request $request, $id)
    {
        $result = Result::findOrFail($id);
        $result->update(['archived' => true]);
        return response()->json(['success' => true, 'message' => 'تم أرشفة النتائج بنجاح']);
    }

    /**
     * استعادة مجموعة نتائج من الأرشفة
     */
    public function unarchiveResult(Request $request, $id)
    {
        $result = Result::findOrFail($id);
        $result->update(['archived' => false]);
        return response()->json(['success' => true, 'message' => 'تم استعادة النتائج بنجاح']);
    }

    /**
     * حذف مجموعة نتائج بالكامل (مع جميع الدرجات)
     */
    public function deleteResultGroup($id)
    {
        $result = Result::findOrFail($id);
        $result->studentScores()->delete();
        $result->delete();
        return response()->json(['success' => true, 'message' => 'تم حذف النتائج بالكامل']);
    }

    /**
     * حذف/أرشفة/استعادة متعدد
     */
    public function bulkAction(Request $request)
    {
        $action = $request->input('action'); // archive, unarchive, delete
        $ids = $request->input('ids', []);

        if (empty($ids) || !in_array($action, ['archive', 'unarchive', 'delete'])) {
            return response()->json(['error' => 'بيانات غير صالحة'], 400);
        }

        try {
            $count = 0;
            foreach ($ids as $id) {
                $result = Result::find($id);
                if (!$result) continue;

                switch ($action) {
                    case 'archive':
                        $result->update(['archived' => true]);
                        break;
                    case 'unarchive':
                        $result->update(['archived' => false]);
                        break;
                    case 'delete':
                        $result->studentScores()->delete();
                        $result->delete();
                        break;
                }
                $count++;
            }

            $messages = [
                'archive' => "تم أرشفة {$count} مجموعة",
                'unarchive' => "تم استعادة {$count} مجموعة",
                'delete' => "تم حذف {$count} مجموعة",
            ];

            return response()->json(['success' => true, 'message' => $messages[$action]]);

        } catch (\Exception $e) {
            Log::error('خطأ في العملية الجماعية: ' . $e->getMessage());
            return response()->json(['error' => 'حدث خطأ'], 500);
        }
    }
}