<section id="gallery_section" class="space-y-6">
    <div class="border-r-4 border-amber-500 pr-3">
        <h3 class="text-lg md:text-xl font-black text-[#2A374E] tracking-wide">معرض الصور والأنشطة المرئية</h3>
        <p class="text-gray-400 text-xs mt-0.5 font-bold">مساحة بصرية توثق إبداعات طلابنا الفنية، الرياضية، والثقافية داخل المدرسة</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 font-bold">
        @php
            // محاكاة مصفوفة صور الكنترول والأنشطة بجودة عالية
            $galleryItems = [
                ['title' => 'تكريم أوائل الطلاب بالشهادة الإعدادية', 'img' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=400'],
                ['title' => 'المعرض الفني السنوي لرسومات المبتكرين', 'img' => 'https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?q=80&w=400'],
                ['title' => 'المباراة الختامية لدوري المدرسة الرياضي', 'img' => 'https://images.unsplash.com/photo-1587280501635-68a0e82cd5ff?q=80&w=400'],
                // 📌 تم تصحيح التعليق هنا برمجياً إلى تعليق PHP سليم لمنع انهيار السيرفر
                ['title' => 'ندوة التوعية البرمجية والذكاء الاصطناعي للناشئين', 'img' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=400'],
                ['title' => 'الرحلة الميدانية السنوية للعلماء الصغار', 'img' => 'https://images.unsplash.com/photo-1564142264741-2708b76c117b?q=80&w=400']
            ];
        @endphp

        @foreach($galleryItems as $idx => $item)
            <div class="premium-glow bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden h-64 relative group {{ $idx >= 3 ? 'hidden-gallery-card hidden animate-fade-in' : '' }}">
                <img src="{{ $item['img'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="Gallery">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent flex flex-col justify-end p-4">
                    <span class="bg-amber-400 text-slate-900 text-[9px] font-black px-2 py-0.5 rounded-md w-fit mb-1.5 shadow">لقطة حية</span>
                    <h4 class="text-white text-xs font-black tracking-wide leading-relaxed line-clamp-2">{{ $item['title'] }}</h4>
                </div>
            </div>
        @endforeach
    </div>

    <div class="flex justify-center pt-2">
        <button type="button" onclick="toggleMoreGalleryGrid()" class="h-11 px-6 bg-white hover:bg-slate-50 text-gray-600 hover:text-gray-900 border border-gray-200 font-extrabold text-xs rounded-2xl shadow-sm transition-all flex items-center gap-1.5 transform active:scale-95">
            <i data-lucide="plus-circle" id="toggleGalleryIcon" class="w-4 h-4 text-amber-500"></i>
            <span id="toggleGalleryText">عرض المزيد من لقطات المعرض المرئي</span>
        </button>
    </div>
</section>