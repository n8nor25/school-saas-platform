<div class="space-y-6 text-xs font-semibold animate-fade-in">
    
    <div class="bg-white rounded-2xl border p-5 shadow-sm space-y-4">
        <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2">
            <i data-lucide="upload" class="text-[#610000] w-4 h-4"></i>
            رفع نتائج وتدقيق كشوف درجات جديدة
        </h3>
        
        <form action="?view=results" method="POST" class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">
            @csrf
            <input type="hidden" name="action" value="preview_upload">
            <div>
                <label class="text-gray-600 block mb-1.5">اختر الصف الدراسي</label>
                <select name="gradeName" required class="w-full h-11 px-3 bg-gray-50 border rounded-xl focus:outline-none focus:border-[#610000]">
                    @foreach($grades as $g)
                        <option value="{{ is_array($g) ? $g['name'] : $g }}">{{ is_array($g) ? $g['name'] : $g }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-gray-600 block mb-1.5">اختر الفصل الدراسي (الترم)</label>
                <select name="term" required class="w-full h-11 px-3 bg-gray-50 border rounded-xl focus:outline-none focus:border-[#610000]">
                    <option value="الفصل الأول">الفصل الأول</option>
                    <option value="الفصل الثاني">الفصل الثاني</option>
                </select>
            </div>
            <div>
                <label class="text-gray-600 block mb-1.5">كشف الدرجات المعتمد (Excel)</label>
                <input type="file" required accept=".xlsx, .xls" class="w-full h-11 p-1 bg-gray-50 border rounded-xl focus:outline-none focus:border-[#610000]">
            </div>
            <div class="sm:col-span-3">
                <button type="submit" class="h-11 px-6 bg-[#610000] hover:bg-[#8B0000] text-white rounded-xl flex items-center gap-1.5 shadow-sm transition-all">
                    <i data-lucide="file-spreadsheet" class="w-4 h-4"></i> 
                    تحليل وفحص ملف كشف الطلاب الدراسي
                </button>
            </div>
        </form>
    </div>

    @if(session()->has('preview_students'))
        <div class="bg-white rounded-2xl border p-5 shadow-sm space-y-3">
            <div class="flex items-center justify-between border-b pb-2">
                <h3 class="text-sm font-bold text-emerald-600 flex items-center gap-1.5">
                    <i data-lucide="check-circle-2" class="w-4 h-4"></i> 
                    معاينة النتائج المستخرجة وتدقيق المواد الدراسية
                </h3>
                <div class="flex gap-2">
                    <span class="bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-full font-bold">{{ session('preview_grade') }}</span>
                    <span class="bg-blue-50 text-blue-700 px-2.5 py-1 rounded-full font-bold">{{ session('preview_term') }}</span>
                </div>
            </div>
            
            <div class="overflow-x-auto rounded-xl border">
                <table class="w-full text-right divide-y divide-gray-100">
                    <thead class="bg-gray-50 font-bold text-gray-700">
                        <tr>
                            <th class="p-2.5">رقم الجلوس</th>
                            <th class="p-2.5">اسم الطالب</th>
                            <th class="p-2.5">اللغة العربية</th>
                            <th class="p-2.5">اللغة الإنجليزية</th>
                            <th class="p-2.5">الرياضيات</th>
                            <th class="p-2.5">العلوم</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 font-semibold text-gray-600">
                        @foreach(session('preview_students') as $stud)
                            <tr class="hover:bg-slate-50">
                                <td class="p-2.5 font-mono text-blue-600 font-bold">{{ $stud['seatNumber'] }}</td>
                                <td class="p-2.5 text-gray-900 font-bold">{{ $stud['studentName'] }}</td>
                                <td class="p-2.5">{{ $stud['arabic'] }}</td>
                                <td class="p-2.5">{{ $stud['english'] }}</td>
                                <td class="p-2.5">{{ $stud['math'] }}</td>
                                <td class="p-2.5">{{ $stud['science'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <form action="?view=results" method="POST" class="flex gap-2 pt-2">
                @csrf
                <input type="hidden" name="action" value="save_results">
                <input type="hidden" name="gradeName" value="{{ session('preview_grade') }}">
                <input type="hidden" name="term" value="{{ session('preview_term') }}">
                <button type="submit" class="h-10 px-5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold flex items-center gap-1 shadow-md">
                    <i data-lucide="save" class="w-4 h-4"></i> اعتماد الكشف وحفظ النتائج نهائياً
                </button>
                <a href="?view=results" class="h-10 px-4 border rounded-xl hover:bg-gray-50 flex items-center font-bold">إلغاء المعاينة</a>
            </form>
        </div>
    @endif

    <div class="bg-white rounded-2xl border shadow-sm p-4 space-y-3">
        <div class="flex items-center justify-between flex-wrap gap-2 border-b pb-3">
            <h3 class="text-sm font-bold text-gray-800 flex items-center gap-1.5">
                <i data-lucide="file-spreadsheet" class="text-[#610000] w-4 h-4"></i> 
                كشوف النتائج المحفوظة حالياً بالنظام
            </h3>
            <div class="flex items-center gap-2 font-bold">
                <button onclick="location.href='?view=results&archived={{ $showArchived ? 'false' : 'true' }}'" class="h-9 px-3 border rounded-xl flex items-center gap-1.5 transition-all {{ $showArchived ? 'bg-amber-600 text-white border-amber-600 shadow-sm' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    <i data-lucide="archive" class="w-4 h-4"></i> 
                    <span>{{ $showArchived ? 'إخفاء الأرشيف' : 'سجلات الأرشيف' }}</span>
                    @if($archivedResultsCount > 0 && !$showArchived)
                        <span class="bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded-full text-[10px]">{{ $archivedResultsCount }}</span>
                    @endif
                </button>
                <button id="bulk-delete-results-btn" onclick="executeBulkResultsDelete()" class="h-9 px-3 bg-red-50 text-red-600 border border-red-200 rounded-xl flex items-center gap-1.5 hidden shadow-sm">
                    <i data-lucide="trash-2" class="w-4 h-4"></i> <span>حذف المحدد الجماعي</span>
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-right divide-y divide-gray-100 font-semibold">
                <thead class="bg-gray-50 text-gray-700 font-bold">
                    <tr>
                        <th class="p-3"><input type="checkbox" id="check-all-results" onclick="toggleAllResultsCheckboxes(this)" class="rounded border-gray-300 w-4 h-4 cursor-pointer"></th>
                        <th class="p-3">الصف الدراسي</th>
                        <th class="p-3">الترم الدراسي</th>
                        <th class="p-3">عدد الطلاب الكلي</th>
                        <th class="p-3 text-center">إجراءات التحكم</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-600">
                    @foreach($filteredResults as $res)
                        <tr class="hover:bg-slate-50/60 transition-colors {{ $res['archived'] ? 'opacity-50 bg-gray-50' : '' }}">
                            <td class="p-3"><input type="checkbox" value="{{ $res['id'] }}" onclick="syncResultsBulkBtn()" class="result-row-box rounded border-gray-300 w-4 h-4 cursor-pointer"></td>
                            <td class="p-3"><span class="bg-slate-100 text-gray-700 px-2.5 py-0.5 rounded border font-bold">{{ $res['gradeName'] }}</span></td>
                            <td class="p-3"><span class="bg-blue-50 text-blue-700 px-2.5 py-0.5 rounded border border-blue-100">{{ $res['term'] }}</span></td>
                            <td class="p-3 font-bold font-mono text-gray-900">{{ $res['studentCount'] }} طالب مقيد</td>
                            <td class="p-3 flex items-center justify-center gap-1">
                                <form action="?view=results&archived={{ $showArchived?'true':'false' }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="action" value="toggle_archive_result">
                                    <input type="hidden" name="id" value="{{ $res['id'] }}">
                                    <input type="hidden" name="target_state" value="{{ $res['archived'] ? 'false' : 'true' }}">
                                    <button type="submit" class="p-2 {{ $res['archived'] ? 'text-emerald-600 hover:bg-emerald-50' : 'text-amber-500 hover:bg-amber-50' }} rounded-lg" title="{{ $res['archived'] ? 'استعادة' : 'أرشفة' }}">
                                        <i data-lucide="{{ $res['archived'] ? 'archive-restore' : 'archive' }}" class="w-4 h-4"></i>
                                    </button>
                                </form>
                                <form action="?view=results" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من حذف كشف الدرجات هذا نهائياً؟')">
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

<form id="bulk-delete-results-form" action="?view=results" method="POST" class="hidden">
    @csrf
    <input type="hidden" name="action" value="bulk_delete_results">
    <input type="hidden" id="bulk-results-ids" name="ids" value="">
</form>

<script>
    function toggleAllResultsCheckboxes(master) {
        document.querySelectorAll('.result-row-box').forEach(box => box.checked = master.checked);
        syncResultsBulkBtn();
    }
    function syncResultsBulkBtn() {
        const checked = document.querySelectorAll('.result-row-box:checked');
        const btn = document.getElementById('bulk-delete-results-btn');
        if (checked.length > 0) {
            btn.classList.remove('hidden');
            btn.querySelector('span').innerText = `حذف الكشوف المحددة (${checked.length})`;
        } else {
            btn.classList.add('hidden');
        }
    }
    function executeBulkResultsDelete() {
        let ids = [];
        document.querySelectorAll('.result-row-box:checked').forEach(box => ids.push(box.value));
        if (confirm(`هل أنت متأكد من حذف عدد ${ids.length} كشوف نتائج دفعة واحدة نهائياً؟`)) {
            document.getElementById('bulk-results-ids').value = ids.join(',');
            document.getElementById('bulk-delete-results-form').submit();
        }
    }
</script>