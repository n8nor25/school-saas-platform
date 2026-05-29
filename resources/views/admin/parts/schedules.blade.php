<div class="space-y-6 text-xs font-semibold animate-fade-in">
    
    <div class="bg-white rounded-2xl border p-5 shadow-sm space-y-4">
        <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2"><i data-lucide="calendar" class="text-[#610000] w-4 h-4"></i> إضافة جدول دراسي أو امتحاني جديد للفرع</h3>
        <form action="?view=schedules" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="action" value="add_schedule">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-gray-600 block mb-1.5">عنوان ومسمى الجدول</label>
                    <input type="text" name="title" required placeholder="مثال: جدول اختبارات صفوف الأول الإعدادي..." class="w-full h-11 px-3 border bg-gray-50 rounded-xl text-xs focus:outline-none">
                </div>
                <div>
                    <label class="text-gray-600 block mb-1.5">التصنيف الهيكلي للجدول</label>
                    <select name="category" class="w-full h-11 px-2 bg-gray-50 border rounded-xl text-xs focus:outline-none">
                        <option value="class">جدول فصل مقيد</option>
                        <option value="teacher">جدول توزيع معلمين</option>
                        <option value="daily">جدول إعلاني يومي وطارئ</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="p-3 bg-emerald-50/40 border border-emerald-100 rounded-xl space-y-1">
                    <label class="text-emerald-800 block font-bold">الخيار الأول: ارفع ملف الجدول من جهازك (PDF / صورة)</label>
                    <input type="file" name="uploaded_file" class="w-full h-10 p-1 bg-white border rounded-lg text-xs focus:outline-none">
                </div>
                <div class="p-3 bg-blue-50/40 border border-blue-100 rounded-xl space-y-1">
                    <label class="text-blue-800 block font-bold">الخيار الثاني: أو ضع رابط الملف السحابي مباشرة</label>
                    <input type="text" name="direct_url" placeholder="https://..." class="w-full h-10 px-3 bg-white border rounded-lg text-xs focus:outline-none font-mono" dir="ltr">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-gray-600 block mb-1.5">نوع وحالة النشر</label>
                    <select name="type" class="w-full h-11 px-2 bg-gray-50 border rounded-xl text-xs focus:outline-none">
                        <option value="حالي">جدول حالي ونشط</option>
                        <option value="أرشيف">جدول مؤرشف سابق</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="h-11 px-6 bg-[#610000] hover:bg-[#8B0000] text-white rounded-xl font-bold flex items-center gap-1 shadow-sm"><i data-lucide="plus" class="w-4 h-4"></i> إدراج واعتماد الجدول الجديد</button>
            </div>
        </form>
    </div>

    <div class="flex items-center gap-3 flex-wrap bg-white p-4 rounded-2xl border shadow-sm">
        <i data-lucide="filter" class="w-4 h-4 text-gray-400"></i>
        <span class="text-gray-700 text-xs font-bold">تصفية سريعة للجداول:</span>
        <select onchange="location.href='?view=schedules&filter_category=' + this.value" class="h-10 px-3 border bg-gray-50 rounded-xl text-xs font-bold focus:outline-none">
            <option value="all" {{ ($filterCategory ?? 'all') === 'all' ? 'selected' : '' }}>عرض جميع الجداول المدرسية</option>
            <option value="class" {{ ($filterCategory ?? '') === 'class' ? 'selected' : '' }}>جداول الفصول</option>
            <option value="teacher" {{ ($filterCategory ?? '') === 'teacher' ? 'selected' : '' }}>جداول المعلمين</option>
            <option value="daily" {{ ($filterCategory ?? '') === 'daily' ? 'selected' : '' }}>الجداول اليومية والطارئة</option>
        </select>

        <button onclick="location.href='?view=schedules&archived={{ $showArchived ? 'false' : 'true' }}'" class="h-10 px-3 border rounded-xl flex items-center gap-1.5 bg-white text-gray-700 font-bold hover:bg-gray-50">
            <i data-lucide="archive" class="w-4 h-4 text-amber-500"></i>
            <span>{{ $showArchived ? 'إخفاء الجداول المؤرشفة' : 'عرض أرشيف السجلات المدرسية' }}</span>
        </button>
    </div>

    <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
        @if(!isset($filteredSchedules) || count($filteredSchedules) === 0)
            <div class="text-center py-12 text-gray-400">لا توجد جداول تعليمية معروضة حالياً</div>
        @else
            <div class="divide-y divide-gray-100">
                @foreach($filteredSchedules as $schedule)
                    <div class="p-4 flex items-center justify-between gap-4 hover:bg-slate-50/50 transition-colors {{ $schedule['archived'] ? 'bg-gray-50 opacity-60' : '' }}">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#610000]/10 flex items-center justify-center text-[#610000] border border-red-100"><i data-lucide="calendar" class="w-5 h-5"></i></div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-sm leading-normal">{{ $schedule['title'] }}</h4>
                                <div class="flex gap-2 mt-1">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                        @if($schedule['category'] === 'class') جدول فصل @elseif($schedule['category'] === 'teacher') جدول معلم @else جدول يومي وطارئ @endif
                                    </span>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold border bg-slate-100 text-gray-700">{{ $schedule['type'] }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-1 shrink-0">
                            <a href="{{ $schedule['filePath'] }}" target="_blank" class="p-2 text-[#610000] hover:bg-red-50 rounded-lg" title="عرض/تحميل الملف الخارجي"><i data-lucide="external-link" class="w-4 h-4"></i></a>
                            
                            <form action="?view=schedules&archived={{ $showArchived?'true':'false' }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="action" value="toggle_archive_schedule">
                                <input type="hidden" name="id" value="{{ $schedule['id'] }}">
                                <input type="hidden" name="target_state" value="{{ $schedule['archived'] ? 'false' : 'true' }}">
                                <button type="submit" class="p-2 {{ $schedule['archived'] ? 'text-emerald-600 hover:bg-emerald-50' : 'text-amber-500 hover:bg-amber-50' }} rounded-lg" title="{{ $schedule['archived'] ? 'استعادة الجدول' : 'أرشفة السجل' }}">
                                    <i data-lucide="{{ $schedule['archived'] ? 'archive-restore' : 'archive' }}" class="w-4 h-4"></i>
                                </button>
                            </form>

                            <form action="?view=schedules" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من حذف الجدول التعليمي نهائياً؟')">
                                @csrf
                                <input type="hidden" name="action" value="delete_schedule">
                                <input type="hidden" name="id" value="{{ $schedule['id'] }}">
                                <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>