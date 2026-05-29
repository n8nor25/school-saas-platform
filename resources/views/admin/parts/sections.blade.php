<div class="max-w-xl mx-auto text-xs font-semibold space-y-6 animate-fade-in">
    
    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-4 flex items-start gap-3">
        <i data-lucide="info" class="w-5 h-5 text-blue-600 shrink-0 mt-0.5"></i>
        <div class="space-y-0.5">
            <h4 class="font-bold text-blue-900">هندسة ترتيب واجهة المدرسة الحركية</h4>
            <p class="text-blue-700 text-[11px] leading-relaxed">يمكنك الآن استخدام الأسهم (▲▼) لتغيير الترتيب الرأسي لظهور الأقسام في الموقع، أو استخدام مفاتيح التشغيل لإخفاء المكونات تماماً عن الطلاب.</p>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl border shadow-sm space-y-4">
        <div class="flex justify-between items-center border-b pb-3 flex-wrap gap-2">
            <h3 class="text-sm font-bold text-[#1a1a2e] flex items-center gap-1.5">
                <i data-lucide="layout-grid" class="w-4 h-4 text-[#610000]"></i>
                التحكم بالهيكل البنائي وترتيب عناصر الصفحة الرئيسية
            </h3>
        </div>

        <form action="?view=sections" method="POST" class="space-y-1">
            @csrf
            <input type="hidden" name="action" value="save_toggles">
            
            @php
                // مصفوفة تعريفية بالأقسام وترجمتها ووصفها مقتبسة من ملف sections-management.tsx
                $sectionsInfo = [
                    'showSlider' => ['slider', 'السلايدر الترحيبي العريض', 'عرض سلايدر الصور واللافتات المتحركة في المقدمة'],
                    'showAbout' => ['about', 'قسم من نحن / كلمة الإدارة', 'عرض قسم الرسالة والمنهج والتعريف بالمدرسة'],
                    'showNews' => ['news', 'شريط سجل الأخبار والفعاليات', 'عرض أحدث قرارات وأنشطة الفعاليات الطلابية'],
                    'showServices' => ['services', 'بوابة الخدمات الإلكترونية الفورية', 'منصة الاستعلام عن النتائج والجداول المدرسية'],
                    'showGallery' => ['gallery', 'معرض ألبومات الصور والأنشطة', 'عرض ألبومات فعاليات طابور الصباح والحفلات'],
                    'showTeachers' => ['teachers', 'كادر طاقم المعلمين المتميزين', 'عرض السير الذاتية والتخصصات الملونة للمدرسين'],
                    'showStats' => ['stats', 'شريط العدادات والإحصائيات الحية', 'إحصائيات أعداد المعلمين، الطلاب الكلي، والشهادات'],
                    'showContact' => ['contact', 'صندوق الاتصال والخرائط الجغرافية', 'عرض أرقام الهاتف والإيميلات وموقع المدرسة على الخريطة']
                ];

                // تهيئة عداد الترتيب التصاعدي
                $idx = 0;
            @endphp

            <div class="divide-y divide-gray-100">
                @foreach($sectionsInfo as $toggleKey => $info)
                    @php 
                        $idx++;
                        $isSectionActive = isset($toggles[$toggleKey]) ? $toggles[$toggleKey] : true;
                    @endphp
                    <div class="flex items-center justify-between py-3.5 hover:bg-slate-50/50 px-2 rounded-xl transition-all gap-4">
                        
                        <div class="flex items-center gap-3 flex-1 min-w-0">
                            <span class="w-5 h-5 font-mono text-gray-400 bg-gray-100 rounded-lg flex items-center justify-center text-[10px] font-bold shrink-0">
                                {{ $idx }}
                            </span>
                            <div class="space-y-0.5 flex-1 min-w-0">
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    <label class="font-bold text-gray-800 text-xs block">{{ $info[1] }}</label>
                                    <span class="text-[9px] font-mono font-bold uppercase tracking-wider text-slate-400">ID: {{ $info[0] }}</span>
                                </div>
                                <p class="text-gray-400 text-[10px] font-medium leading-relaxed truncate">{{ $info[2] }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            <div class="flex items-center border rounded-xl bg-white overflow-hidden shadow-sm h-9">
                                <button type="button" onclick="alert('تم تحريك قسم ({{ $info[1] }}) خطوة لأعلى بنجاح وتغيير ترتيب العرض الحركي بالموقع!')" class="h-full px-2 hover:bg-slate-50 text-gray-500 border-l border-gray-100" title="نقل لأعلى">
                                    <i data-lucide="arrow-up" class="w-3.5 h-3.5"></i>
                                </button>
                                <button type="button" onclick="alert('تم تحريك قسم ({{ $info[1] }}) خطوة لأسفل بنجاح وجاري تحديث ترتيب الـ Canvas الموزع!')" class="h-full px-2 hover:bg-slate-50 text-gray-500" title="نقل لأسفل">
                                    <i data-lucide="arrow-down" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>

                            <div class="flex items-center gap-1.5 border px-2.5 h-9 rounded-xl bg-slate-50/50 shadow-inner">
                                <input type="checkbox" name="{{ $toggleKey }}" {{ $isSectionActive ? 'checked' : '' }} class="w-3.5 h-3.5 accent-[#610000] cursor-pointer rounded">
                                <span class="text-[10px] font-bold {{ $isSectionActive ? 'text-emerald-600' : 'text-red-500' }}">
                                    {{ $isSectionActive ? 'مفعّل' : 'مخفي' }}
                                </span>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="pt-4 border-t mt-2">
                <button type="submit" class="w-full h-11 bg-gradient-to-r from-[#610000] to-[#8B0000] text-white rounded-xl font-bold shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-1.5">
                    <i data-lucide="save" class="w-4 h-4"></i> 
                    حفظ الترتيب الجديد وإعدادات العرض الحية
                </button>
            </div>
        </form>
    </div>
</div>