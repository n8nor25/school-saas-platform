<section id="news_section" class="space-y-6">
    <div class="border-r-4 border-red-500 pr-3">
        <h3 class="text-lg font-black text-[#2A374E] tracking-wide">أحدث الأخبار والفعاليات والأنشطة المدرسية</h3>
        <p class="text-gray-400 text-xs mt-0.5 font-bold">تغطية برشمية مستمرة وحية لكافة المحافل والإعلانات الرسمية للمنصة</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 font-bold">
        @foreach($schoolDetails['news'] as $idx => $newsItem)
            <!-- إظهار أول 3 أخبار تلقائياً، وإخفاء البقية خلف الكلاس التفاعلي -->
            <div class="premium-glow bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden group hover:border-red-200 flex flex-col justify-between h-52 transition-all duration-300 {{ $idx >= 3 ? 'hidden-news-card hidden animate-fade-in' : '' }}">
                <div class="p-5 space-y-3 flex flex-col justify-between h-full">
                    <div class="flex items-center justify-between text-[10px] text-gray-400 font-extrabold">
                        <span class="bg-[#610000]/10 text-[#610000] px-2.5 py-0.5 rounded-lg border border-red-100/30">{{ $newsItem['category'] }}</span>
                        <span><i data-lucide="calendar" class="w-3.5 h-3.5 inline ml-0.5"></i> {{ $newsItem['date'] }}</span>
                    </div>
                    <h4 class="font-bold text-gray-800 text-xs leading-relaxed group-hover:text-[#610000] transition-colors line-clamp-3 tracking-wide flex-1 mt-2">{{ $newsItem['title'] }}</h4>
                    <span class="text-[10px] text-red-400/80 font-bold flex items-center gap-0.5 mt-2 group-hover:translate-x-1 transition-transform">اقرأ تفاصيل الخبر <i data-lucide="chevron-left" class="w-3 h-3"></i></span>
                </div>
            </div>
        @endforeach
    </div>

    @if(count($schoolDetails['news']) > 3)
        <div class="flex justify-center pt-2">
            <button type="button" onclick="toggleMoreNewsGrid()" class="h-11 px-6 bg-white hover:bg-slate-50 text-gray-600 hover:text-gray-900 border border-gray-200 font-extrabold text-xs rounded-2xl shadow-sm transition-all flex items-center gap-1.5 transform active:scale-95">
                <i data-lucide="plus-circle" id="toggleNewsIcon" class="w-4 h-4 text-red-600"></i>
                <span id="toggleNewsText">عرض المزيد من أخبار وفعاليات المدرسة</span>
            </button>
        </div>
    @endif
</section>