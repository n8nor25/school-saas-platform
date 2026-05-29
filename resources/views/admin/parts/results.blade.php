<div class="space-y-6 text-xs font-semibold animate-fade-in">
    
    <div class="bg-white rounded-2xl border p-5 shadow-sm space-y-4">
        <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2">
            <i data-lucide="upload" class="text-[#610000] w-4 h-4"></i>
            رفع واعتماد كشوف نتائج الامتحانات (Excel / JSON)
        </h3>
        <form action="{{ route('admin.dashboard', ['tenant' => $tenant]) }}?view=results" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">
          @csrf
           <input type="hidden" name="action" value="preview_upload">
        
            <div>
                <label class="text-gray-600 block mb-1.5">اختر الصف الدراسي المستهدف *</label>
                <select name="gradeName" required class="w-full h-11 px-3 bg-gray-50 border rounded-xl focus:outline-none">
                    @foreach(($grades ?? []) as $g)
                        @php $gName = is_array($g) ? $g['name'] : $g; @endphp
                        <option value="{{ $gName }}">{{ $gradeMapping[$gName] ?? $gName }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-gray-600 block mb-1.5">اختر الترم الحالي</label>
                <select name="term" required class="w-full h-11 px-3 bg-gray-50 border rounded-xl focus:outline-none">
                    <option value="الفصل الأول">الفصل الأول</option>
                    <option value="الفصل الثاني">الفصل الثاني</option>
                </select>
            </div>
            <div>
                <label class="text-gray-600 block mb-1.5">ملف كشف الدرجات المعتمد</label>
                <input type="file" name="file" required accept=".xlsx, .xls, .json" class="w-full h-11 p-1 bg-gray-50 border rounded-xl focus:outline-none">
            </div>
            <div class="sm:col-span-3">
                <button type="submit" class="h-11 px-6 bg-[#610000] hover:bg-[#8B0000] text-white rounded-xl font-bold flex items-center gap-1.5 shadow-sm transition-all">
                    <i data-lucide="file-spreadsheet" class="w-4 h-4"></i> 
                    تحليل وفحص محتوى كافة أوراق العمل المرفوعة
                </button>
            </div>
        </form>
    </div>

    @if(session()->has('live_multi_sheets') || session()->has('preview_grade'))
        @php
            $sheets = session()->get('live_multi_sheets', [
                'كشف الصف الثالث الإعدادي (أ)' => [
                    ['seatNumber' => '49463', 'studentName' => 'محمد عبد العزيز محروس', 'arabic' => 50, 'english' => 16, 'socialStudies' => 38, 'math' => 45, 'science' => 35, 'religion' => 19, 'art' => 18, 'computer' => 19, 'total' => 184]
                ]
            ]);
            $pGrade = session('preview_grade', 'grade_3');
            $pTerm = session('preview_term', 'الفصل الأول');
        @endphp
        <div class="bg-white rounded-2xl border p-5 shadow-sm space-y-4 border-emerald-200">
            <div class="flex items-center justify-between border-b pb-2 flex-wrap gap-2">
                <h3 class="text-sm font-bold text-emerald-600 flex items-center gap-1.5">
                    <i data-lucide="layers" class="w-4 h-4"></i> 
                    معاينة وتدقيق النتائج وتحديثها حياً قبل الحفظ النهائي (إجمالي الأوراق: {{ count($sheets) }})
                </h3>
                <span class="bg-slate-100 text-gray-700 px-2.5 py-1.5 rounded-xl font-bold border text-xs">{{ $gradeMapping[$pGrade] ?? $pGrade }} - {{ $pTerm }}</span>
            </div>

            <div class="flex gap-1 overflow-x-auto pb-1 border-b">
                @foreach($sheets as $sheetName => $studentsList)
                    <button type="button" onclick="switchSheetTab('{{ md5($sheetName) }}', this)" class="sheet-tab-btn h-9 px-3 border-b-2 font-bold text-[11px] whitespace-nowrap transition-colors {{ $loop->first ? 'border-[#610000] text-[#610000] bg-red-50/40 rounded-t-lg' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                        <i data-lucide="sheet" class="w-3.5 h-3.5 inline ml-0.5"></i> {{ $sheetName }} ({{ count($studentsList) }})
                    </button>
                @endforeach
            </div>

            @foreach($sheets as $sheetName => $studentsList)
                <div id="sheet-container-{{ md5($sheetName) }}" class="sheet-content-panel space-y-2 {{ $loop->first ? '' : 'hidden' }}">
                    <div class="overflow-x-auto rounded-xl border border-gray-100">
                        <table class="w-full text-right divide-y divide-gray-100 text-xs min-w-[1100px]">
                            <thead class="bg-slate-50 font-bold text-gray-700">
                                <tr>
                                    <th class="p-2.5">رقم الجلوس</th>
                                    <th class="p-2.5">اسم الطالب الكلي</th>
                                    <th class="p-2.5 text-center w-16">عربي</th>
                                    <th class="p-2.5 text-center w-16">نجليزي</th>
                                    <th class="p-2.5 text-center w-16">دراسات</th>
                                    <th class="p-2.5 text-center w-16">رياضيات</th>
                                    <th class="p-2.5 text-center w-16">علوم</th>
                                    <th class="p-2.5 text-center w-16">دين</th>
                                    <th class="p-2.5 text-center w-16">فنية</th>
                                    <th class="p-2.5 text-center w-16">كمبيوتر</th>
                                    <th class="p-2.5 text-center bg-emerald-600 text-white font-bold w-20">المجموع</th>
                                    <th class="p-2.5 text-center">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 font-semibold text-gray-600">
                                @foreach($studentsList as $stud)
                                    <tr class="hover:bg-slate-50/60 transition-colors">
                                        <form action="?view=results" method="POST">
                                            @csrf
                                            <input type="hidden" name="action" value="update_inline_student">
                                            <input type="hidden" name="sheet_name" value="{{ $sheetName }}">
                                            <input type="hidden" name="preview_grade" value="{{ $pGrade }}">
                                            <input type="hidden" name="preview_term" value="{{ $pTerm }}">

                                            <td class="p-2">
                                                <input type="text" name="seatNumber" value="{{ $stud['seatNumber'] }}" readonly class="w-20 h-8 text-center bg-gray-100 border rounded-lg font-bold text-blue-600 focus:outline-none text-[11px]">
                                            </td>
                                            <td class="p-2">
                                                <input type="text" name="studentName" value="{{ $stud['studentName'] }}" required class="w-44 h-8 px-2 border rounded-lg text-gray-900 focus:outline-none focus:border-blue-500 text-[11px]">
                                            </td>
                                            <td class="p-1"><input type="number" name="arabic" value="{{ $stud['arabic'] ?? 0 }}" step="0.5" oninput="calculateInlineRowTotal(this)" class="w-14 h-8 text-center border rounded-lg focus:outline-none font-mono text-[11px]"></td>
                                            <td class="p-1"><input type="number" name="english" value="{{ $stud['english'] ?? 0 }}" step="0.5" oninput="calculateInlineRowTotal(this)" class="w-14 h-8 text-center border rounded-lg focus:outline-none font-mono text-[11px] text-blue-600 font-bold"></td>
                                            <td class="p-1"><input type="number" name="socialStudies" value="{{ $stud['socialStudies'] ?? 0 }}" step="0.5" oninput="calculateInlineRowTotal(this)" class="w-14 h-8 text-center border rounded-lg focus:outline-none font-mono text-[11px]"></td>
                                            <td class="p-1"><input type="number" name="math" value="{{ $stud['math'] ?? 0 }}" step="0.5" oninput="calculateInlineRowTotal(this)" class="w-14 h-8 text-center border rounded-lg focus:outline-none font-mono text-[11px]"></td>
                                            <td class="p-1"><input type="number" name="science" value="{{ $stud['science'] ?? 0 }}" step="0.5" oninput="calculateInlineRowTotal(this)" class="w-14 h-8 text-center border rounded-lg focus:outline-none font-mono text-[11px]"></td>
                                            
                                            <td class="p-1"><input type="number" name="religion" value="{{ $stud['religion'] ?? 0 }}" step="0.5" class="w-14 h-8 text-center border bg-purple-50/20 rounded-lg focus:outline-none font-mono text-[11px]"></td>
                                            <td class="p-1"><input type="number" name="art" value="{{ $stud['art'] ?? 0 }}" step="0.5" class="w-14 h-8 text-center border bg-purple-50/20 rounded-lg focus:outline-none font-mono text-[11px]"></td>
                                            <td class="p-1"><input type="number" name="computer" value="{{ $stud['computer'] ?? 0 }}" step="0.5" class="w-14 h-8 text-center border bg-purple-50/20 rounded-lg focus:outline-none font-mono text-[11px]"></td>
                                            
                                            <td class="p-2 text-center bg-emerald-50 text-emerald-900 font-bold font-mono text-xs">
                                                <input type="text" name="total" value="{{ $stud['total'] ?? 0 }}" readonly class="w-16 h-8 text-center bg-transparent border-0 font-bold text-emerald-700 pointer-events-none">
                                            </td>
                                            
                                            <td class="p-2 flex items-center justify-center gap-1.5 mt-0.5">
                                                <button type="submit" class="p-1.5 text-emerald-600 hover:bg-emerald-50 rounded border border-emerald-200 transition-colors" title="حفظ هذا السطر"><i data-lucide="check" class="w-3.5 h-3.5"></i></button>
                                        </form>
                                                <form action="?view=results" method="POST" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="action" value="delete_student_from_sheet">
                                                    <input type="hidden" name="sheet_name" value="{{ $sheetName }}">
                                                    <input type="hidden" name="seatNumber" value="{{ $stud['seatNumber'] }}">
                                                    <input type="hidden" name="preview_grade" value="{{ $pGrade }}">
                                                    <input type="hidden" name="preview_term" value="{{ $pTerm }}">
                                                    <button type="submit" class="p-1.5 text-red-500 hover:bg-red-50 rounded border border-red-100 transition-colors"><i data-lucide="trash" class="w-3.5 h-3.5"></i></button>
                                                </form>
                                            </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
            
            <form action="?view=results" method="POST" class="flex gap-2 pt-2 border-t">
                @csrf
                <input type="hidden" name="action" value="save_results">
                <input type="hidden" name="gradeName" value="{{ $pGrade }}">
                <input type="hidden" name="term" value="{{ $pTerm }}">
                <button type="submit" class="h-10 px-5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold flex items-center gap-1 shadow-md">
                    <i data-lucide="save" class="w-4 h-4"></i> حفظ النتائج نهائياً ✓
                </button>
                <a href="?view=results" class="h-10 px-4 border rounded-xl hover:bg-gray-50 flex items-center font-bold">إلغاء</a>
            </form>
        </div>
    @endif

    <div class="bg-white rounded-2xl border shadow-sm p-4 space-y-3">
        <h3 class="text-sm font-bold text-gray-800 flex items-center gap-1.5 border-b pb-3">
            <i data-lucide="file-spreadsheet" class="text-[#610000] w-4 h-4"></i> 
            سجل الكشوف المعتمدة لنتائج الامتحانات المدرسية
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full text-right divide-y divide-gray-100 font-semibold text-xs">
                <thead class="bg-gray-50 text-gray-700 font-bold">
                    <tr>
                        <th class="p-3">#</th>
                        <th class="p-3">الصف الدراسي الحالي بالمنصة</th>
                        <th class="p-3">الترم الدراسي</th>
                        <th class="p-3">إجمالي الطلاب المعتمدين</th>
                        <th class="p-3 text-center">حذف كلي</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-600">
                    @foreach(($filteredResults ?? []) as $res)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="p-3 font-mono text-gray-400">{{ $loop->iteration }}</td>
                            <td class="p-3">
                                <span class="bg-[#610000]/5 text-[#610000] px-2.5 py-1 rounded-xl font-bold border border-red-100 text-xs">
                                    {{ $gradeMapping[$res['gradeName']] ?? $res['gradeName'] }}
                                </span>
                            </td>
                            <td class="p-3"><span class="bg-blue-50 text-blue-700 px-2.5 py-0.5 rounded border border-blue-100">{{ $res['term'] }}</span></td>
                            <td class="p-3 font-bold font-mono text-gray-900">{{ $res['studentCount'] }} طالب معتمد</td>
                            <td class="p-3 flex items-center justify-center">
                                <form action="?view=results" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من حذف كشف الدرجات هذا بالكامل؟')">
                                    @csrf
                                    <input type="hidden" name="action" value="delete_result">
                                    <input type="hidden" name="id" value="{{ $res['id'] }}">
                                    <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function switchSheetTab(sheetHash, buttonEl) {
        document.querySelectorAll('.sheet-content-panel').forEach(panel => panel.classList.add('hidden'));
        document.querySelectorAll('.sheet-tab-btn').forEach(btn => {
            btn.classList.remove('border-[#610000]', 'text-[#610000]', 'bg-red-50/40', 'rounded-t-lg');
            btn.classList.add('border-transparent', 'text-gray-500');
        });
        document.getElementById('sheet-container-' + sheetHash).classList.remove('hidden');
        buttonEl.classList.add('border-[#610000]', 'text-[#610000]', 'bg-red-50/40', 'rounded-t-lg');
        if(typeof lucide !== 'undefined') lucide.createIcons();
    }

    function calculateInlineRowTotal(inputElement) {
        const row = inputElement.closest('tr');
        const arabic   = parseFloat(row.querySelector('input[name="arabic"]').value) || 0;
        const english  = parseFloat(row.querySelector('input[name="english"]').value) || 0;
        const social   = parseFloat(row.querySelector('input[name="socialStudies"]').value) || 0;
        const math     = parseFloat(row.querySelector('input[name="math"]').value) || 0;
        const science  = parseFloat(row.querySelector('input[name="science"]').value) || 0;
        
        const grandTotal = arabic + english + social + math + science;
        row.querySelector('input[name="total"]').value = grandTotal.toFixed(1);
    }
</script>