<div class="space-y-6 text-xs font-semibold">
    
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div onclick="location.href='?view=news'" class="bg-white p-4 rounded-2xl border shadow-sm flex items-center gap-4 cursor-pointer hover:shadow-md transition-shadow">
            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 text-white flex items-center justify-center shadow-md">
                <i data-lucide="newspaper" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-gray-400 text-[11px] font-bold">الأخبار المكتوبة</p>
                <p class="text-xl font-bold text-[#1a1a2e] font-mono">{{ $stats['newsCount'] ?? 0 }}</p>
            </div>
        </div>

        <div onclick="location.href='?view=gallery'" class="bg-white p-4 rounded-2xl border shadow-sm flex items-center gap-4 cursor-pointer hover:shadow-md transition-shadow">
            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 text-white flex items-center justify-center shadow-md">
                <i data-lucide="image" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-gray-400 text-[11px] font-bold">معرض الصور</p>
                <p class="text-xl font-bold text-[#1a1a2e] font-mono">{{ $stats['galleryCount'] ?? 0 }}</p>
            </div>
        </div>

        <div onclick="location.href='?view=teachers'" class="bg-white p-4 rounded-2xl border shadow-sm flex items-center gap-4 cursor-pointer hover:shadow-md transition-shadow">
            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 text-white flex items-center justify-center shadow-md">
                <i data-lucide="users" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-gray-400 text-[11px] font-bold">طاقم المعلمين</p>
                <p class="text-xl font-bold text-[#1a1a2e] font-mono">{{ $stats['teachersCount'] ?? 0 }}</p>
            </div>
        </div>

        <div onclick="location.href='?view=results'" class="bg-white p-4 rounded-2xl border shadow-sm flex items-center gap-4 cursor-pointer hover:shadow-md transition-shadow">
            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-rose-500 to-pink-500 text-white flex items-center justify-center shadow-md">
                <i data-lucide="file-bar-chart" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-gray-400 text-[11px] font-bold">النتائج المعتمدة</p>
                <p class="text-xl font-bold text-[#1a1a2e] font-mono">{{ $stats['resultsCount'] ?? 0 }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border p-5 shadow-sm space-y-3">
        <h3 class="font-bold text-xs text-gray-700">إجراءات إدارية سريعة ومباشرة</h3>
        <div class="flex flex-wrap gap-2 text-xs font-bold">
            <a href="?view=news" class="px-4 py-2.5 border rounded-xl hover:bg-slate-50 flex items-center gap-1.5"><i data-lucide="plus" class="w-4 h-4 text-amber-500"></i> إضافة خبر للمدرسة</a>
            <a href="?view=results" class="px-4 py-2.5 border rounded-xl hover:bg-slate-50 flex items-center gap-1.5"><i data-lucide="trending-up" class="w-4 h-4 text-rose-500"></i> رفع كشوف النتائج</a>
            <a href="?view=teachers" class="px-4 py-2.5 border rounded-xl hover:bg-slate-50 flex items-center gap-1.5"><i data-lucide="user-plus" class="w-4 h-4 text-blue-500"></i> إضافة معلم جديد</a>
            <a href="?view=schedules" class="px-4 py-2.5 border rounded-xl hover:bg-slate-50 flex items-center gap-1.5"><i data-lucide="calendar" class="w-4 h-4 text-purple-500"></i> تحديث جدول الحصص</a>
            <a href="?view=settings" class="px-4 py-2.5 border rounded-xl hover:bg-slate-50 flex items-center gap-1.5"><i data-lucide="settings" class="w-4 h-4 text-gray-500"></i> إعدادات المنصة</a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border p-6 text-center shadow-sm max-w-xl mx-auto space-y-3">
        <div class="w-14 h-14 bg-gradient-to-br from-[#610000] to-[#8B0000] text-white flex items-center justify-center rounded-full mx-auto shadow-md">
            <i data-lucide="shield-check" class="w-7 h-7"></i>
        </div>
        <h3 class="text-base font-bold text-gray-800">مرحباً بك في لوحة الإدارة الهيكلية المطورة</h3>
        <p class="text-gray-400 text-xs leading-relaxed max-w-sm mx-auto">
            تم عزل وتفكيك ملفات التحكم بنجاح فائق لحماية السيرفر من البطء وتأمين سرعة معالجة صاروخية للملفات الحية.
        </p>
    </div>

</div>