<!-- ======= [ إستامبة الهيدر السحابية الديناميكية الموحدة لكافة المدارس ] ======= -->
<div class="sticky top-0 z-50 shadow-md">
    
    <!-- 1. شريط معلومات الاتصال العلوي (يتغير ديناميكياً لكل مدرسة) -->
    <div class="bg-[#610000] text-white text-xs py-2.5 border-b border-white/10">
        <div class="max-w-[1280px] mx-auto px-4 flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-5 font-bold">
                <span class="flex items-center gap-1.5"><i data-lucide="phone" class="w-4 h-4 text-red-300"></i> {{ $schoolDetails['phone'] }}</span>
                <span class="flex items-center gap-1.5"><i data-lucide="mail" class="w-4 h-4 text-red-300"></i> {{ $schoolDetails['email'] }}</span>
                <span class="hidden sm:flex items-center gap-1.5 text-[11px] bg-white/10 px-2.5 py-1 rounded text-red-100 shadow-inner">
                    <i data-lucide="school" class="w-3.5 h-3.5"></i> {{ $schoolDetails['name'] }}
                </span>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ $schoolDetails['facebook_url'] }}" target="_blank" class="hover:text-red-300 transition-colors"><i data-lucide="facebook" class="w-4 h-4"></i></a>
                <a href="https://youtube.com" target="_blank" class="hover:text-red-300 transition-colors"><i data-lucide="youtube" class="w-4 h-4"></i></a>
            </div>
        </div>
    </div>

    <!-- 2. شريط اسم المدرسة وشعارها ومربع الإعلان المتمركز هندسياً -->
    <header class="bg-white border-b border-gray-100 py-6">
        <div class="max-w-[1280px] mx-auto px-4 flex flex-wrap md:flex-nowrap items-center justify-between gap-6">
            
            <!-- لوجو واسم المدرسة يتغير سحابياً برمشة عين -->
            <div class="flex items-center gap-4 shrink-0 min-w-[320px]">
                <div class="w-16 h-16 bg-gradient-to-br from-[#610000] to-[#8a1414] rounded-full flex items-center justify-center shadow-lg border-2 border-red-100/40">
                    <i data-lucide="book-open" class="w-8 h-8 text-white"></i>
                </div>
                <div>
                    <h1 class="text-xl md:text-2xl font-black text-[#610000] tracking-wide leading-tight">{{ $schoolDetails['name'] }}</h1>
                    <p class="text-gray-400 text-xs font-extrabold mt-1 tracking-wide">{{ $schoolDetails['settings']['hero_subtitle'] }}</p>
                </div>
            </div>

            <!-- مربع الإعلان المتمركز في السنتر المطلق لاحتمال إضافة رموز بعده -->
            <div class="flex-1 flex justify-center items-center px-2">
                <div class="w-full max-w-xl relative h-14 rounded-2xl overflow-hidden group shadow-md border border-gray-100 transition-transform hover:scale-[1.01] duration-300">
                    <img src="{{ $schoolDetails['settings']['banner_image'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-85" alt="Banner Ad">
                    <div class="absolute inset-0 bg-gradient-to-l from-[#610000]/80 via-[#610000]/40 to-transparent flex items-center justify-end pr-5">
                        <span class="text-white font-extrabold text-xs md:text-sm tracking-wide">{{ $schoolDetails['settings']['banner_title'] }}</span>
                    </div>
                    <div class="absolute top-1.5 left-1.5 bg-black/50 backdrop-blur-sm text-white text-[8px] px-1.5 py-0.5 rounded-md font-bold tracking-wider">AD</div>
                </div>
            </div>

            <!-- المساحة المجهزة لأزرار لوحة التحكم أو رموز الدارك مود على اليسار -->
            <div class="flex items-center gap-2 shrink-0 min-w-[120px] justify-end">
                <a href="?view=dashboard" class="h-11 px-5 bg-[#009688] hover:bg-[#00796b] text-white text-xs font-black rounded-xl shadow-md transition-all flex items-center gap-1.5">
                    <i data-lucide="lock" class="w-4 h-4"></i>
                    <span>لوحة التحكم</span>
                </a>
            </div>
        </div>
    </header>

    <!-- 3. شريط الناف بار الرئيسي (الـ الروابط تدعم الـ Tenant ديناميكياً) -->
    <nav class="bg-[#2A374E] text-white border-b-4 border-[#610000]">
        <div class="max-w-[1280px] mx-auto px-4 flex items-center h-14">
            <div class="flex items-center h-full text-xs font-black divide-x divide-white/10 divide-x-reverse tracking-wide">
                <a href="/{{ $tenant }}" class="px-5 h-full flex items-center bg-white/5 text-white border-b-4 border-red-400">الرئيسية</a>
                <a href="#welcome" class="px-5 h-full flex items-center hover:bg-white/5 text-slate-200 transition-colors">من نحن</a>
                <a href="#services" class="px-5 h-full flex items-center hover:bg-white/5 text-slate-200 transition-colors">الخدمات الإلكترونية</a>
                <a href="#news_section" class="px-5 h-full flex items-center hover:bg-white/5 text-slate-200 transition-colors">أحدث الأخبار</a>
                <a href="#gallery_section" class="px-5 h-full flex items-center hover:bg-white/5 text-slate-200 transition-colors">معرض الصور</a>
                
                <!-- مكون الـ Dropdown للحياة الطلابية المستقل بالكامل -->
                <div class="relative group h-full">
                    <a href="{{ route('student.life', ['tenant' => $tenant]) }}" class="px-5 h-full flex items-center text-amber-300 hover:bg-white/5 transition-colors gap-1 focus:outline-none cursor-pointer">
                        <i data-lucide="sparkles" class="w-4 h-4"></i>
                        <span>الحياة الطلابية</span>
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform group-hover:rotate-180"></i>
                    </a>
                    <div class="absolute right-0 top-14 w-52 bg-white rounded-b-2xl shadow-2xl border border-slate-100 py-2 text-gray-700 hidden group-hover:block animate-fade-in z-50">
                        <a href="/{{ $tenant }}/search" class="px-4 py-3 hover:bg-amber-50/60 hover:text-[#610000] flex items-center gap-2 border-b border-slate-50 transition-colors font-bold">
                            <i data-lucide="graduation-cap" class="w-4 h-4 text-emerald-500"></i> نتائج الطلاب والشهادات
                        </a>
                        <a href="/{{ $tenant }}/schedule" class="px-4 py-3 hover:bg-amber-50/60 hover:text-[#610000] flex items-center gap-2 border-b border-slate-50 transition-colors font-bold">
                            <i data-lucide="calendar" class="w-4 h-4 text-amber-500"></i> جدول الحصص الدراسي
                        </a>
                        <a href="/{{ $tenant }}/library" class="px-4 py-3 hover:bg-amber-50/60 hover:text-[#610000] flex items-center gap-2 transition-colors font-bold">
                            <i data-lucide="library" class="w-4 h-4 text-red-500"></i> المكتبة الرقمية والمراجع
                        </a>
                    </div>
                </div>

                <a href="#contact_map_section" class="px-5 h-full flex items-center hover:bg-white/5 text-slate-200 transition-colors">اتصل بنا</a>
            </div>
        </div>
    </nav>

    <!-- 4. شريط عاجل الفخم العريض المتكرر لكل مدرسة بأخبارها الخاصة -->
    <section class="bg-red-50 border-b border-red-100 overflow-hidden flex items-center h-14 shadow-inner">
        <div class="bg-red-600 text-white shrink-0 h-full px-6 text-sm font-black flex items-center gap-2 shadow-xl z-10">
            <i data-lucide="megaphone" class="w-5 h-5 text-amber-200 animate-bounce"></i>
            <span class="tracking-widest text-base">عاجل</span>
        </div>
        <div class="overflow-hidden flex-1 relative h-full flex items-center bg-red-50/40">
            <div class="animate-news-ticker text-xs md:text-sm font-black text-gray-900 tracking-wide">
                @foreach($schoolDetails['news'] as $newsItem)
                    <span class="inline-block mx-8">
                        <span class="text-[#610000] font-black ml-1.5 text-base">◆</span>
                        {{ $newsItem['title'] }}
                        <span class="text-red-200 font-normal mx-5 text-sm">|</span>
                    </span>
                @endforeach
            </div>
        </div>
    </section>
</div>