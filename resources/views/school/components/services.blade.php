<section id="services" class="space-y-6">
    <div class="border-r-4 border-[#009688] pr-3">
        <h3 class="text-lg md:text-xl font-black text-[#2A374E] tracking-wide">منصة الخدمات الإلكترونية للطلاب وأولياء الأمور</h3>
        <p class="text-gray-400 text-xs mt-0.5 font-bold">بوابتك الرقمية الشاملة لإدارة ومتابعة المسيرة التعليمية لأبنائنا حياً</p>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 text-right font-bold">
        
        <!-- 🟢 كارت 1: نتائج الامتحانات الطلابية -->
        <a href="/{{ $tenant }}/search" class="premium-glow bg-white p-6 rounded-2xl border border-gray-100/80 shadow-md hover:border-emerald-300 flex flex-col justify-between h-48 relative overflow-hidden group">
            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 text-white rounded-xl flex items-center justify-center shadow-lg"><i data-lucide="clipboard-list" class="w-5 h-5"></i></div>
            <div class="space-y-1">
                <h4 class="font-black text-gray-800 text-sm group-hover:text-emerald-600 transition-colors tracking-wide">نتائج الامتحانات الطلابية</h4>
                <p class="text-gray-400 text-[11px] font-bold line-clamp-2 leading-relaxed">استعلم فوراً عن درجات الشهادات الفصلية والمجموع الكلي لكافة المواد.</p>
            </div>
        </a>
        
        <!-- 🟢 كارت 2: بوابة الحياة الطلابية والذكاء الاصطناعي -->
        <a href="{{ route('student.life', ['tenant' => $tenant]) }}" class="premium-glow bg-white p-6 rounded-2xl border border-gray-100/80 shadow-md hover:border-purple-300 flex flex-col justify-between h-48 relative overflow-hidden group">
            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-xl flex items-center justify-center shadow-lg"><i data-lucide="sparkles" class="w-5 h-5"></i></div>
            <div class="space-y-1">
                <h4 class="font-black text-gray-800 text-sm group-hover:text-purple-600 transition-colors tracking-wide">بوابة الحياة الطلابية والذكاء الاصطناعي</h4>
                <p class="text-gray-400 text-[11px] font-bold line-clamp-2 leading-relaxed">استخدم المساعد الذكي للمواد والمؤقتات الدراسية المتقدمة لزيادة الفهم.</p>
            </div>
        </a>
        
        <!-- 🟢 كارت 3: تصحيح ارتباط كارت جداول الحصص والامتحانات ليتوجه لصفحة الجداول الصريحة -->
        <a href="/{{ $tenant }}/schedule" class="premium-glow bg-white p-6 rounded-2xl border border-gray-100/80 shadow-md hover:border-amber-300 flex flex-col justify-between h-48 relative overflow-hidden group cursor-pointer">
            <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-amber-600 text-white rounded-xl flex items-center justify-center shadow-lg"><i data-lucide="calendar" class="w-5 h-5"></i></div>
            <div class="space-y-1">
                <h4 class="font-black text-gray-700 text-sm group-hover:text-amber-600 transition-colors tracking-wide">جداول الحصص والامتحانات والمجموعات</h4>
                <p class="text-gray-400 text-[11px] font-bold line-clamp-2 leading-relaxed">تابع توزيع الحصص اليومي والأسبوعي ومواعيد اختبارات الكنترول والشهر يدوياً.</p>
            </div>
        </a>

        <!-- 🟢 كارت 4: بوابة ومجتمع المكتبة الرقمية والمراجع المخصصة -->
        <a href="/{{ $tenant }}/library" class="hidden-service-card hidden premium-glow bg-white p-6 rounded-2xl border border-gray-100 shadow-md hover:border-red-300 flex flex-col justify-between h-48 group cursor-pointer animate-fade-in">
            <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 text-white rounded-xl flex items-center justify-center shadow-lg"><i data-lucide="library" class="w-5 h-5"></i></div>
            <div class="space-y-1">
                <h4 class="font-black text-gray-700 text-sm group-hover:text-red-600 transition-colors tracking-wide">المكتبة الرقمية والمراجع التعليمية</h4>
                <p class="text-gray-400 text-[11px] font-bold line-clamp-2 leading-relaxed">تصفح وحمل ملخصات الوزارة المعتمدة ومراجعات لجان الشهادات بصيغة PDF فوراً.</p>
            </div>
        </a>
    </div>

    <div class="flex justify-center pt-2">
        <button type="button" onclick="toggleMoreServicesGrid()" class="h-11 px-6 bg-white hover:bg-slate-50 text-gray-600 hover:text-gray-900 border border-gray-200 font-extrabold text-xs rounded-2xl shadow-sm transition-all flex items-center gap-1.5 transform active:scale-95">
            <i data-lucide="plus-circle" id="toggleServicesIcon" class="w-4 h-4 text-[#009688]"></i>
            <span id="toggleServicesText">عرض المزيد من خدمات البوابة الإلكترونية</span>
        </button>
    </div>
</section>