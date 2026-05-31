<div class="space-y-6 text-xs font-semibold">

    {{-- رفع الملف --}}
    <div class="bg-white rounded-2xl border p-5 shadow-sm">
        <h3 class="font-bold text-sm text-gray-700 mb-4">📤 رفع كشوف النتائج</h3>
        <form id="uploadForm" action="{{ route('admin.results.upload', ['tenant' => $tenant]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 mb-1">الصف الدراسي</label>
                    <input type="text" name="grade_name" class="w-full border rounded-lg px-3 py-2 text-xs" placeholder="مثال: الأول الإعدادي" required value="{{ old('grade_name') }}">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 mb-1">الفصل</label>
                    <select name="term" class="w-full border rounded-lg px-3 py-2 text-xs" required>
                        <option value="الفصل الأول">الفصل الأول</option>
                        <option value="الفصل الثاني">الفصل الثاني</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 mb-1">ملف النتائج</label>
                    <input type="file" name="file" class="w-full border rounded-lg px-3 py-1.5 text-xs" accept=".xlsx,.xls,.csv,.json,.txt" required>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-red-600 text-white rounded-lg px-4 py-2 text-xs font-bold hover:bg-red-700 transition-colors">رفع الملف</button>
                </div>
            </div>
        </form>

        @if(session('success'))
            <div class="mt-3 p-3 bg-green-50 border border-green-200 rounded-lg text-green-700 text-xs">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mt-3 p-3 bg-red-50 border border-red-200 rounded-lg text-red-700 text-xs">{{ session('error') }}</div>
        @endif
    </div>

    {{-- قواعد الحساب --}}
    <details class="bg-white rounded-2xl border shadow-sm">
        <summary class="p-4 text-gray-500 cursor-pointer text-xs font-bold">📋 قواعد حساب المجموع</summary>
        <div class="px-5 pb-4 text-xs text-gray-600 space-y-1">
            <p><strong>تُحسب:</strong> عربي + إنجليزي + اجتماعيات + جبر + هندسة + علوم</p>
            <p><strong>لا تُحسب:</strong> دين • فنية • حاسب</p>
        </div>
    </details>

    {{-- جدول المعاينة --}}
    <div id="preview-section" style="display:none" class="bg-white rounded-2xl border p-5 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <h3 class="font-bold text-sm text-gray-700">👁️ معاينة البيانات</h3>
            <div class="flex gap-2">
                <button onclick="saveResults()" class="bg-green-600 text-white rounded-lg px-4 py-1.5 text-xs font-bold hover:bg-green-700">💾 حفظ الكل</button>
                <button onclick="clearPreview()" class="border rounded-lg px-4 py-1.5 text-xs font-bold hover:bg-gray-50">✖ إلغاء</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-xs">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="border px-2 py-2">#</th>
                        <th class="border px-2 py-2">رقم الجلوس</th>
                        <th class="border px-2 py-2">اسم الطالب</th>
                        <th class="border px-2 py-2">عربي</th>
                        <th class="border px-2 py-2">إنجليزي</th>
                        <th class="border px-2 py-2">اجتماعيات</th>
                        <th class="border px-2 py-2">جبر</th>
                        <th class="border px-2 py-2">هندسة</th>
                        <th class="border px-2 py-2 bg-blue-700">رياضيات</th>
                        <th class="border px-2 py-2">علوم</th>
                        <th class="border px-2 py-2 bg-amber-600">المجموع</th>
                        <th class="border px-2 py-2 bg-gray-500">دين</th>
                        <th class="border px-2 py-2 bg-gray-500">فنية</th>
                        <th class="border px-2 py-2 bg-gray-500">حاسب</th>
                        <th class="border px-2 py-2">إجراء</th>
                    </tr>
                </thead>
                <tbody id="preview-tbody"></tbody>
            </table>
        </div>
    </div>

    {{-- إدارة مجموعات النتائج (أرشفة/حذف/استعادة) --}}
    <div class="bg-white rounded-2xl border p-5 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <h3 class="font-bold text-sm text-gray-700">📁 إدارة مجموعات النتائج</h3>
        </div>

        {{-- أزرار الإجراءات الجماعية --}}
        <div class="flex flex-wrap gap-2 mb-3">
            <button onclick="bulkAction('archive')" class="bg-amber-500 text-white rounded-lg px-3 py-1.5 text-xs font-bold hover:bg-amber-600">📦 أرشفة المحدد</button>
            <button onclick="bulkAction('unarchive')" class="bg-green-500 text-white rounded-lg px-3 py-1.5 text-xs font-bold hover:bg-green-600">♻️ استعادة المحدد</button>
            <button onclick="bulkAction('delete')" class="bg-red-600 text-white rounded-lg px-3 py-1.5 text-xs font-bold hover:bg-red-700">🗑️ حذف المحدد</button>
        </div>

        {{-- فلتر الأرشفة --}}
        <div class="flex gap-2 mb-3">
            <button onclick="filterGroups('all')" id="filter-all" class="border rounded-lg px-3 py-1 text-xs font-bold bg-gray-800 text-white">الكل</button>
            <button onclick="filterGroups('active')" id="filter-active" class="border rounded-lg px-3 py-1 text-xs font-bold hover:bg-green-50">نشطة</button>
            <button onclick="filterGroups('archived')" id="filter-archived" class="border rounded-lg px-3 py-1 text-xs font-bold hover:bg-amber-50">مؤرشفة</button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-xs">
                <thead>
                    <tr class="bg-gray-700 text-white">
                        <th class="border px-2 py-2"><input type="checkbox" id="selectAll" onchange="toggleSelectAll()"></th>
                        <th class="border px-2 py-2">الصف</th>
                        <th class="border px-2 py-2">الفصل</th>
                        <th class="border px-2 py-2">عدد الطلاب</th>
                        <th class="border px-2 py-2">الحالة</th>
                        <th class="border px-2 py-2">إجراءات</th>
                    </tr>
                </thead>
                <tbody id="groups-tbody">
                    @forelse($resultGroups as $rg)
                        <tr class="hover:bg-gray-50 group-row" data-archived="{{ $rg->archived ? '1' : '0' }}" data-id="{{ $rg->id }}">
                            <td class="border px-2 py-2"><input type="checkbox" class="group-check" value="{{ $rg->id }}"></td>
                            <td class="border px-2 py-2 font-bold">{{ $rg->grade_name }}</td>
                            <td class="border px-2 py-2">{{ $rg->term }}</td>
                            <td class="border px-2 py-2 num-en">{{ $rg->studentScores()->count() }}</td>
                            <td class="border px-2 py-2">
                                @if($rg->archived)
                                    <span class="bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full text-[10px] font-bold">مؤرشفة</span>
                                @else
                                    <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-[10px] font-bold">نشطة</span>
                                @endif
                            </td>
                            <td class="border px-2 py-2 whitespace-nowrap">
                                <button onclick="viewGroup({{ $rg->id }})" class="text-blue-500 hover:underline text-[11px]">👁️ عرض</button>
                                @if($rg->archived)
                                    <button onclick="unarchiveGroup({{ $rg->id }})" class="text-green-500 hover:underline text-[11px]">♻️ استعادة</button>
                                @else
                                    <button onclick="archiveGroup({{ $rg->id }})" class="text-amber-500 hover:underline text-[11px]">📦 أرشفة</button>
                                @endif
                                <button onclick="deleteGroup({{ $rg->id }})" class="text-red-500 hover:underline text-[11px]">🗑️ حذف</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="border px-2 py-4 text-center text-gray-400">لا توجد مجموعات نتائج</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- جدول النتائج المحفوظة --}}
    <div id="saved-section" class="bg-white rounded-2xl border p-5 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <h3 class="font-bold text-sm text-gray-700">📊 تفاصيل النتائج</h3>
            <span id="current-group-name" class="text-gray-400 text-xs"></span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-xs">
                <thead>
                    <tr class="bg-red-700 text-white">
                        <th class="border px-2 py-2">#</th>
                        <th class="border px-2 py-2">رقم الجلوس</th>
                        <th class="border px-2 py-2">اسم الطالب</th>
                        <th class="border px-2 py-2">عربي</th>
                        <th class="border px-2 py-2">إنجليزي</th>
                        <th class="border px-2 py-2">اجتماعيات</th>
                        <th class="border px-2 py-2">جبر</th>
                        <th class="border px-2 py-2">هندسة</th>
                        <th class="border px-2 py-2 bg-blue-700">رياضيات</th>
                        <th class="border px-2 py-2">علوم</th>
                        <th class="border px-2 py-2 bg-amber-600">المجموع</th>
                        <th class="border px-2 py-2 bg-gray-500">دين</th>
                        <th class="border px-2 py-2 bg-gray-500">فنية</th>
                        <th class="border px-2 py-2 bg-gray-500">حاسب</th>
                        <th class="border px-2 py-2">إجراء</th>
                    </tr>
                </thead>
                <tbody id="saved-tbody">
                    <tr><td colspan="15" class="border px-2 py-4 text-center text-gray-400">اضغط 👁️ عرض على أي مجموعة لعرض تفاصيلها</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- نافذة تعديل المعاينة --}}
<div class="modal fade" id="editPreviewModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title text-sm font-bold">تعديل بيانات الطالب</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body text-xs">
                <input type="hidden" id="edit_preview_index">
                <div class="row g-2">
                    <div class="col-4"><label class="form-label text-[11px] font-bold">رقم الجلوس</label><input type="text" class="form-control form-control-sm" id="edit_preview_seatNumber"></div>
                    <div class="col-8"><label class="form-label text-[11px] font-bold">اسم الطالب</label><input type="text" class="form-control form-control-sm" id="edit_preview_studentName"></div>
                </div>
                <div class="row g-2 mt-1">
                    <div class="col-3"><label class="form-label text-[11px] font-bold">عربي</label><input type="number" step="0.5" class="form-control form-control-sm" id="edit_preview_arabic" oninput="calcTotal()"></div>
                    <div class="col-3"><label class="form-label text-[11px] font-bold">إنجليزي</label><input type="number" step="0.5" class="form-control form-control-sm" id="edit_preview_english" oninput="calcTotal()"></div>
                    <div class="col-3"><label class="form-label text-[11px] font-bold">اجتماعيات</label><input type="number" step="0.5" class="form-control form-control-sm" id="edit_preview_social_studies" oninput="calcTotal()"></div>
                    <div class="col-3"><label class="form-label text-[11px] font-bold">علوم</label><input type="number" step="0.5" class="form-control form-control-sm" id="edit_preview_science" oninput="calcTotal()"></div>
                </div>
                <div class="row g-2 mt-1">
                    <div class="col-3"><label class="form-label text-[11px] font-bold">جبر</label><input type="number" step="0.5" class="form-control form-control-sm" id="edit_preview_algebra" oninput="calcTotal()"></div>
                    <div class="col-3"><label class="form-label text-[11px] font-bold">هندسة</label><input type="number" step="0.5" class="form-control form-control-sm" id="edit_preview_geometry" oninput="calcTotal()"></div>
                    <div class="col-3"><label class="form-label text-[11px] font-bold bg-blue-100 rounded px-1">رياضيات</label><input type="text" class="form-control form-control-sm bg-blue-50 font-bold" id="edit_preview_math" readonly></div>
                    <div class="col-3"><label class="form-label text-[11px] font-bold bg-amber-100 rounded px-1">المجموع</label><input type="text" class="form-control form-control-sm bg-amber-50 font-bold" id="edit_preview_total" readonly></div>
                </div>
                <hr class="my-2">
                <div class="row g-2">
                    <div class="col-4"><label class="form-label text-[11px] text-gray-400">دين (لا يضاف)</label><input type="number" step="0.5" class="form-control form-control-sm" id="edit_preview_religion"></div>
                    <div class="col-4"><label class="form-label text-[11px] text-gray-400">فنية (لا يضاف)</label><input type="number" step="0.5" class="form-control form-control-sm" id="edit_preview_art"></div>
                    <div class="col-4"><label class="form-label text-[11px] text-gray-400">حاسب (لا يضاف)</label><input type="number" step="0.5" class="form-control form-control-sm" id="edit_preview_computer"></div>
                </div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">إلغاء</button><button type="button" class="btn btn-sm btn-primary" onclick="submitPreviewEdit()">حفظ</button></div>
        </div>
    </div>
</div>

{{-- نافذة تعديل المحفوظ --}}
<div class="modal fade" id="editSavedModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title text-sm font-bold">تعديل نتيجة محفوظة</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body text-xs">
                <input type="hidden" id="edit_saved_id">
                <div class="row g-2">
                    <div class="col-4"><label class="form-label text-[11px] font-bold">رقم الجلوس</label><input type="text" class="form-control form-control-sm" id="edit_saved_seatNumber"></div>
                    <div class="col-8"><label class="form-label text-[11px] font-bold">اسم الطالب</label><input type="text" class="form-control form-control-sm" id="edit_saved_studentName"></div>
                </div>
                <div class="row g-2 mt-1">
                    <div class="col-3"><label class="form-label text-[11px] font-bold">عربي</label><input type="number" step="0.5" class="form-control form-control-sm" id="edit_saved_arabic" oninput="calcSavedTotal()"></div>
                    <div class="col-3"><label class="form-label text-[11px] font-bold">إنجليزي</label><input type="number" step="0.5" class="form-control form-control-sm" id="edit_saved_english" oninput="calcSavedTotal()"></div>
                    <div class="col-3"><label class="form-label text-[11px] font-bold">اجتماعيات</label><input type="number" step="0.5" class="form-control form-control-sm" id="edit_saved_social_studies" oninput="calcSavedTotal()"></div>
                    <div class="col-3"><label class="form-label text-[11px] font-bold">علوم</label><input type="number" step="0.5" class="form-control form-control-sm" id="edit_saved_science" oninput="calcSavedTotal()"></div>
                </div>
                <div class="row g-2 mt-1">
                    <div class="col-3"><label class="form-label text-[11px] font-bold">جبر</label><input type="number" step="0.5" class="form-control form-control-sm" id="edit_saved_algebra" oninput="calcSavedTotal()"></div>
                    <div class="col-3"><label class="form-label text-[11px] font-bold">هندسة</label><input type="number" step="0.5" class="form-control form-control-sm" id="edit_saved_geometry" oninput="calcSavedTotal()"></div>
                    <div class="col-3"><label class="form-label text-[11px] font-bold bg-blue-100 rounded px-1">رياضيات</label><input type="text" class="form-control form-control-sm bg-blue-50 font-bold" id="edit_saved_math" readonly></div>
                    <div class="col-3"><label class="form-label text-[11px] font-bold bg-amber-100 rounded px-1">المجموع</label><input type="text" class="form-control form-control-sm bg-amber-50 font-bold" id="edit_saved_total" readonly></div>
                </div>
                <hr class="my-2">
                <div class="row g-2">
                    <div class="col-4"><label class="form-label text-[11px] text-gray-400">دين (لا يضاف)</label><input type="number" step="0.5" class="form-control form-control-sm" id="edit_saved_religion"></div>
                    <div class="col-4"><label class="form-label text-[11px] text-gray-400">فنية (لا يضاف)</label><input type="number" step="0.5" class="form-control form-control-sm" id="edit_saved_art"></div>
                    <div class="col-4"><label class="form-label text-[11px] text-gray-400">حاسب (لا يضاف)</label><input type="number" step="0.5" class="form-control form-control-sm" id="edit_saved_computer"></div>
                </div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">إلغاء</button><button type="button" class="btn btn-sm btn-primary" onclick="submitSavedEdit()">حفظ</button></div>
        </div>
    </div>
</div>

<script>
    let previewStudents = [];
    let currentResultId = null;
    const tenantSlug = '{{ $tenant ?? "" }}';
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

    function calcTotal() {
        const a = parseFloat(document.getElementById('edit_preview_arabic').value) || 0;
        const e = parseFloat(document.getElementById('edit_preview_english').value) || 0;
        const s = parseFloat(document.getElementById('edit_preview_social_studies').value) || 0;
        const al = parseFloat(document.getElementById('edit_preview_algebra').value) || 0;
        const g = parseFloat(document.getElementById('edit_preview_geometry').value) || 0;
        const sc = parseFloat(document.getElementById('edit_preview_science').value) || 0;
        document.getElementById('edit_preview_math').value = al + g;
        document.getElementById('edit_preview_total').value = a + e + s + al + g + sc;
    }

    function calcSavedTotal() {
        const a = parseFloat(document.getElementById('edit_saved_arabic').value) || 0;
        const e = parseFloat(document.getElementById('edit_saved_english').value) || 0;
        const s = parseFloat(document.getElementById('edit_saved_social_studies').value) || 0;
        const al = parseFloat(document.getElementById('edit_saved_algebra').value) || 0;
        const g = parseFloat(document.getElementById('edit_saved_geometry').value) || 0;
        const sc = parseFloat(document.getElementById('edit_saved_science').value) || 0;
        document.getElementById('edit_saved_math').value = al + g;
        document.getElementById('edit_saved_total').value = a + e + s + al + g + sc;
    }

    function renderPreviewTable() {
        const tbody = document.getElementById('preview-tbody');
        if (!previewStudents || previewStudents.length === 0) { document.getElementById('preview-section').style.display = 'none'; return; }
        document.getElementById('preview-section').style.display = 'block';
        let html = '';
        previewStudents.forEach((s, i) => {
            const al = parseFloat(s.algebra) || 0, g = parseFloat(s.geometry) || 0, math = al + g;
            html += `<tr class="hover:bg-gray-50">
                <td class="border px-2 py-1">${i+1}</td>
                <td class="border px-2 py-1 num-en">${s.seatNumber||''}</td>
                <td class="border px-2 py-1">${s.studentName||''}</td>
                <td class="border px-2 py-1 num-en">${s.arabic??'-'}</td>
                <td class="border px-2 py-1 num-en">${s.english??'-'}</td>
                <td class="border px-2 py-1 num-en">${s.social_studies??'-'}</td>
                <td class="border px-2 py-1 num-en">${s.algebra??'-'}</td>
                <td class="border px-2 py-1 num-en">${s.geometry??'-'}</td>
                <td class="border px-2 py-1 num-en bg-blue-50 font-bold">${math||'-'}</td>
                <td class="border px-2 py-1 num-en">${s.science??'-'}</td>
                <td class="border px-2 py-1 num-en bg-amber-50 font-bold">${s.total??'-'}</td>
                <td class="border px-2 py-1 num-en text-gray-400">${s.religion??'-'}</td>
                <td class="border px-2 py-1 num-en text-gray-400">${s.art??'-'}</td>
                <td class="border px-2 py-1 num-en text-gray-400">${s.computer??'-'}</td>
                <td class="border px-2 py-1"><button onclick="editPreviewStudent(${i})" class="text-blue-500">✏️</button></td>
            </tr>`;
        });
        tbody.innerHTML = html;
    }

    function editPreviewStudent(index) {
        const s = previewStudents[index];
        document.getElementById('edit_preview_index').value = index;
        document.getElementById('edit_preview_seatNumber').value = s.seatNumber||'';
        document.getElementById('edit_preview_studentName').value = s.studentName||'';
        document.getElementById('edit_preview_arabic').value = s.arabic??'';
        document.getElementById('edit_preview_english').value = s.english??'';
        document.getElementById('edit_preview_social_studies').value = s.social_studies??'';
        document.getElementById('edit_preview_algebra').value = s.algebra??'';
        document.getElementById('edit_preview_geometry').value = s.geometry??'';
        document.getElementById('edit_preview_science').value = s.science??'';
        document.getElementById('edit_preview_religion').value = s.religion??'';
        document.getElementById('edit_preview_art').value = s.art??'';
        document.getElementById('edit_preview_computer').value = s.computer??'';
        calcTotal();
        new bootstrap.Modal(document.getElementById('editPreviewModal')).show();
    }

    function submitPreviewEdit() {
        const index = document.getElementById('edit_preview_index').value;
        const al = parseFloat(document.getElementById('edit_preview_algebra').value)||0;
        const g = parseFloat(document.getElementById('edit_preview_geometry').value)||0;
        const a = parseFloat(document.getElementById('edit_preview_arabic').value)||0;
        const e = parseFloat(document.getElementById('edit_preview_english').value)||0;
        const s = parseFloat(document.getElementById('edit_preview_social_studies').value)||0;
        const sc = parseFloat(document.getElementById('edit_preview_science').value)||0;
        previewStudents[index] = {
            seatNumber: document.getElementById('edit_preview_seatNumber').value,
            studentName: document.getElementById('edit_preview_studentName').value,
            arabic: a, english: e, social_studies: s, algebra: al, geometry: g, math: al+g,
            science: sc, religion: document.getElementById('edit_preview_religion').value,
            art: document.getElementById('edit_preview_art').value, computer: document.getElementById('edit_preview_computer').value,
            total: a+e+s+al+g+sc,
        };
        renderPreviewTable();
        bootstrap.Modal.getInstance(document.getElementById('editPreviewModal')).hide();
    }

    function saveResults() {
        if (!confirm('حفظ جميع النتائج؟')) return;
        fetch(`/${tenantSlug}/admin/results/save`, {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json'},
        }).then(r => r.json()).then(data => {
            if (data.success) { alert(data.message); location.reload(); }
            else { alert(data.error || 'خطأ'); }
        });
    }

    function clearPreview() { previewStudents = []; document.getElementById('preview-section').style.display = 'none'; }

    // عرض مجموعة نتائج
    function viewGroup(resultId) {
        currentResultId = resultId;
        fetch(`/${tenantSlug}/admin/results/list?result_id=${resultId}`)
            .then(r => r.json()).then(data => {
                const tbody = document.getElementById('saved-tbody');
                if (!data.results || data.results.length === 0) { tbody.innerHTML = '<tr><td colspan="15" class="border px-2 py-4 text-center text-gray-400">لا توجد نتائج</td></tr>'; return; }
                document.getElementById('current-group-name').textContent = data.results[0]?.student_name ? '' : '';
                let html = '';
                data.results.forEach((s, i) => {
                    const al = parseFloat(s.algebra)||0, g = parseFloat(s.geometry)||0;
                    const math = parseFloat(s.math)||(al+g);
                    html += `<tr class="hover:bg-gray-50">
                        <td class="border px-2 py-1">${i+1}</td>
                        <td class="border px-2 py-1 num-en">${s.seat_number||''}</td>
                        <td class="border px-2 py-1">${s.student_name||''}</td>
                        <td class="border px-2 py-1 num-en">${s.arabic??'-'}</td>
                        <td class="border px-2 py-1 num-en">${s.english??'-'}</td>
                        <td class="border px-2 py-1 num-en">${s.social_studies??'-'}</td>
                        <td class="border px-2 py-1 num-en">${s.algebra??'-'}</td>
                        <td class="border px-2 py-1 num-en">${s.geometry??'-'}</td>
                        <td class="border px-2 py-1 num-en bg-blue-50 font-bold">${math||'-'}</td>
                        <td class="border px-2 py-1 num-en">${s.science??'-'}</td>
                        <td class="border px-2 py-1 num-en bg-amber-50 font-bold">${s.total??'-'}</td>
                        <td class="border px-2 py-1 num-en text-gray-400">${s.religion??'-'}</td>
                        <td class="border px-2 py-1 num-en text-gray-400">${s.art??'-'}</td>
                        <td class="border px-2 py-1 num-en text-gray-400">${s.computer??'-'}</td>
                        <td class="border px-2 py-1 whitespace-nowrap">
                            <button onclick="editSavedStudent(${s.id})" class="text-blue-500">✏️</button>
                            <button onclick="deleteScore(${s.id})" class="text-red-500">🗑️</button>
                        </td>
                    </tr>`;
                });
                tbody.innerHTML = html;
            });
    }

    function editSavedStudent(id) {
        fetch(`/${tenantSlug}/admin/results/list?result_id=${currentResultId}`)
            .then(r => r.json()).then(data => {
                const s = data.results.find(r => r.id == id);
                if (!s) return;
                document.getElementById('edit_saved_id').value = s.id;
                document.getElementById('edit_saved_seatNumber').value = s.seat_number||'';
                document.getElementById('edit_saved_studentName').value = s.student_name||'';
                document.getElementById('edit_saved_arabic').value = s.arabic??'';
                document.getElementById('edit_saved_english').value = s.english??'';
                document.getElementById('edit_saved_social_studies').value = s.social_studies??'';
                document.getElementById('edit_saved_algebra').value = s.algebra??'';
                document.getElementById('edit_saved_geometry').value = s.geometry??'';
                document.getElementById('edit_saved_science').value = s.science??'';
                document.getElementById('edit_saved_religion').value = s.religion??'';
                document.getElementById('edit_saved_art').value = s.art??'';
                document.getElementById('edit_saved_computer').value = s.computer??'';
                calcSavedTotal();
                new bootstrap.Modal(document.getElementById('editSavedModal')).show();
            });
    }

    function submitSavedEdit() {
        const id = document.getElementById('edit_saved_id').value;
        fetch(`/${tenantSlug}/admin/results/${id}`, {
            method: 'PUT',
            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json'},
            body: JSON.stringify({
                seatNumber: document.getElementById('edit_saved_seatNumber').value,
                studentName: document.getElementById('edit_saved_studentName').value,
                arabic: document.getElementById('edit_saved_arabic').value,
                english: document.getElementById('edit_saved_english').value,
                social_studies: document.getElementById('edit_saved_social_studies').value,
                algebra: document.getElementById('edit_saved_algebra').value,
                geometry: document.getElementById('edit_saved_geometry').value,
                science: document.getElementById('edit_saved_science').value,
                religion: document.getElementById('edit_saved_religion').value,
                art: document.getElementById('edit_saved_art').value,
                computer: document.getElementById('edit_saved_computer').value,
            }),
        }).then(r => r.json()).then(data => { if (data.success) { viewGroup(currentResultId); bootstrap.Modal.getInstance(document.getElementById('editSavedModal')).hide(); } });
    }

    function deleteScore(id) {
        if (!confirm('حذف نتيجة هذا الطالب؟')) return;
        fetch(`/${tenantSlug}/admin/results/${id}`, {
            method: 'DELETE', headers: {'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json'},
        }).then(r => r.json()).then(data => { if (data.success) viewGroup(currentResultId); });
    }

    // ========== الأرشفة والاستعادة ==========
    function archiveGroup(id) {
        if (!confirm('أرشفة هذه المجموعة؟')) return;
        fetch(`/${tenantSlug}/admin/results/${id}/archive`, {
            method: 'POST', headers: {'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json'},
        }).then(r => r.json()).then(data => { if (data.success) location.reload(); });
    }

    function unarchiveGroup(id) {
        if (!confirm('استعادة هذه المجموعة من الأرشيف؟')) return;
        fetch(`/${tenantSlug}/admin/results/${id}/unarchive`, {
            method: 'POST', headers: {'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json'},
        }).then(r => r.json()).then(data => { if (data.success) location.reload(); });
    }

    function deleteGroup(id) {
        if (!confirm('⚠️ حذف نهائي! سيتم حذف جميع درجات الطلاب. متأكد؟')) return;
        fetch(`/${tenantSlug}/admin/results-group/${id}`, {
            method: 'DELETE', headers: {'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json'},
        }).then(r => r.json()).then(data => { if (data.success) location.reload(); });
    }

    // ========== تحديد الكل والعمليات الجماعية ==========
    function toggleSelectAll() {
        const checked = document.getElementById('selectAll').checked;
        document.querySelectorAll('.group-check').forEach(cb => cb.checked = checked);
    }

    function getSelectedIds() {
        return Array.from(document.querySelectorAll('.group-check:checked')).map(cb => cb.value);
    }

    function bulkAction(action) {
        const ids = getSelectedIds();
        if (ids.length === 0) { alert('اختر مجموعة واحدة على الأقل'); return; }
        const msgs = {archive: 'أرشفة', unarchive: 'استعادة', delete: 'حذف نهائي'};
        const warning = action === 'delete' ? '⚠️ سيتم حذف جميع البيانات!' : '';
        if (!confirm(`${warning}هل تريد ${msgs[action]} ${ids.length} مجموعة؟`)) return;

        fetch(`/${tenantSlug}/admin/results/bulk`, {
            method: 'POST',
            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json'},
            body: JSON.stringify({action, ids}),
        }).then(r => r.json()).then(data => { if (data.success) location.reload(); else alert(data.error || 'خطأ'); });
    }

    // ========== فلتر الأرشفة ==========
    function filterGroups(type) {
        document.querySelectorAll('.group-row').forEach(row => {
            const archived = row.dataset.archived === '1';
            if (type === 'all') row.style.display = '';
            else if (type === 'active') row.style.display = archived ? 'none' : '';
            else if (type === 'archived') row.style.display = archived ? '' : 'none';
        });
        document.querySelectorAll('#filter-all, #filter-active, #filter-archived').forEach(b => { b.className = 'border rounded-lg px-3 py-1 text-xs font-bold hover:bg-gray-50'; });
        document.getElementById('filter-' + type).className = 'border rounded-lg px-3 py-1 text-xs font-bold bg-gray-800 text-white';
    }

    // تحميل المعاينة بعد رفع ناجح
    @if(session('success'))
        fetch(`/${tenantSlug}/admin/results/preview`)
            .then(r => r.json()).then(data => {
                if (data.students && data.students.length > 0) { previewStudents = data.students; renderPreviewTable(); }
            });
    @endif
</script>